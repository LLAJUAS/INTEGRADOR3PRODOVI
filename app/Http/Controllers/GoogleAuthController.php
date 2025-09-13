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
        $googleUser = Socialite::driver('google')->user();
    } catch (Throwable $e) {
        return redirect('/')->with('error', 'Google authentication failed.');
    }

    $user = User::updateOrCreate(
        ['email' => $googleUser->email],
        [
            'name' => $googleUser->name,
            'password' => bcrypt(Str::random(16)), // Contraseña aleatoria segura
            'email_verified_at' => now(),
            'google_id' => $googleUser->id // Opcional: guardar ID de Google
        ]
    );

    Auth::login($user);

  $user = Auth::user();
    $user = User::with('roles')->find($user->id); // asegura la relación

    $userRole = $user->roles->first();


if ($userRole && $userRole->nombre_rol === 'Administrador') {
    return redirect()->route('administrador.dashboard');
}

return redirect()->route('clientes.home');


}
}