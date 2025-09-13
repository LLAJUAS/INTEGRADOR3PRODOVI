<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\RoleUser;
use App\Models\Suscripcion;


class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesar login
   // Procesar login
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        $user = Auth::user();
        
        // Cargar la relación de roles (alternativa segura)
        $userWithRoles = User::with('roles')->find($user->id);
        
        // Verificar si es administrador
        if ($userWithRoles->roles->where('nombre_rol', 'Administrador')->isNotEmpty()) {
            return redirect()->route('administrador.dashboard');
        }
        
        // Verificar suscripción activa
        $tieneSuscripcionActiva = Suscripcion::where('usuario_id', $user->id)
            ->where('estado', 'activa')
            ->where('fecha_fin', '>', now())
            ->exists();
            
        if ($tieneSuscripcionActiva) {
            return redirect()->route('clientes.dashboard');
        }
        
        return redirect()->route('clientes.home');
    }

    return back()->withErrors([
        'email' => 'Las credenciales no coinciden con nuestros registros.',
    ])->onlyInput('email');
}
    // Procesar registro
public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone' => ['required', 'string', 'max:20'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    // Asignar rol "Cliente" automáticamente (rol_id = 2)
    RoleUser::create([
        'role_id' => 2, // Cliente
        'user_id' => $user->id,
    ]);

    // Los nuevos registros siempre van a home (no tienen suscripción)
    return redirect()->route('clientes.home');
}

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}