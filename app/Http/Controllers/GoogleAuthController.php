<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Throwable;
use App\Models\RoleUser;


class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
public function callback()
{
    try {
        // Crear un cliente Guzzle con verificación SSL deshabilitada
        $guzzleClient = new \GuzzleHttp\Client([
            'curl' => [
                CURLOPT_SSL_VERIFYPEER => false,
            ],
        ]);
        
        // Establecer este cliente en el driver de Socialite
        $socialite = Socialite::driver('google')->setHttpClient($guzzleClient);
        $googleUser = $socialite->user();
        
        // Resto de tu código permanece igual
        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(Str::random(16)),
                'email_verified_at' => now(),
                'google_id' => $googleUser->getId()
            ]
        );

        // Asignar rol si es nuevo
        if (!$user->roles()->exists()) {
            RoleUser::updateOrCreate(
                ['user_id' => $user->id],
                ['role_id' => 2] // Cliente
            );
        }

        Auth::login($user);

        // Guardar Security Log: Login Exitoso con Google
        \App\Models\SecurityLog::create([
            'user_id' => $user->id,
            'event_type' => 'login_success',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'details' => ['method' => 'google_oauth', 'email' => $user->email]
        ]);

        $user = Auth::user();
        $user = User::with('roles')->find($user->id);

        $userRole = $user->roles->first();

        if ($userRole && $userRole->nombre_rol === 'Administrador') {
            return redirect()->route('administrador.dashboard');
        }

        return redirect()->route('clientes.home');
        
    } catch (Throwable $e) {
        return redirect('/')->with('error', 'Google authentication failed: ' . $e->getMessage());
    }
}
}