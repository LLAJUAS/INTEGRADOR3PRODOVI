<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Cliente\PagoClienteController;
use App\Http\Controllers\FacebookPostController;


Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Autenticación con Google
Route::prefix('api')->group(function () {
    Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])
        ->name('auth.google.redirect');
        
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])
        ->name('auth.google.callback');
});

// Rutas del cliente
Route::middleware('auth')->group(function () {
    Route::get('/clientes/home', [ClienteController::class, 'home'])->name('clientes.home');
    Route::get('/clientes/dashboard', [ClienteController::class, 'dashboard'])->name('clientes.dashboard');
    Route::get('/clientes/brief', [ClienteController::class, 'brief'])->name('clientes.brief');
    
    // Rutas de pago del cliente
    Route::get('/clientes/pago/{plan}', [PagoClienteController::class, 'show'])->name('clientes.pago');
    Route::post('/pago/procesar/{plan}', [PagoClienteController::class, 'procesarPago'])->name('pago.procesar');
});

//ESTADO PAGO
Route::get('/clientes/estado-pago', [PagoClienteController::class, 'estadoPago'])
    ->name('clientes.pago.estado')
    ->middleware('auth');

// Rutas de administrador
Route::prefix('administrador')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('administrador.dashboard');
    })->name('administrador.dashboard');

    // Gestión de pagos
    Route::prefix('pagos')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PagoAdminController::class, 'index'])
             ->name('administrador.pagos.index');
             
        Route::get('/realizados', [\App\Http\Controllers\Admin\PagoAdminController::class, 'pagosRealizados'])
             ->name('administrador.pagos.realizados');
             
        // Ruta actualizada para pagos pendientes físicos
        Route::get('/pendientes-fisicos', [\App\Http\Controllers\Admin\PagoAdminController::class, 'pagosPendientesFisicos'])
             ->name('administrador.pagos.pendientes-fisicos'); // Nombre actualizado
             
        Route::get('/finalizados-sin-renovacion', [\App\Http\Controllers\Admin\PagoAdminController::class, 'pagosFinalizadosSinRenovacion'])
             ->name('administrador.pagos.finalizados');
             
        Route::post('/aprobar/{pago}', [\App\Http\Controllers\Admin\PagoAdminController::class, 'aprobarPagoFisico'])
             ->name('administrador.pagos.aprobar');
             
        // Nuevas rutas para cancelar y reactivar suscripciones
        Route::put('/cancelar/{pago}', [\App\Http\Controllers\Admin\PagoAdminController::class, 'cancelarSuscripcion'])
             ->name('administrador.pagos.cancelar');
             
        Route::put('/reactivar/{pago}', [\App\Http\Controllers\Admin\PagoAdminController::class, 'reactivarSuscripcion'])
             ->name('administrador.pagos.reactivar');
    });
    
    // Gestión de planes
    Route::resource('planes', 'App\Http\Controllers\Admin\PlanController')
        ->except(['show'])
        ->names([
            'index' => 'administrador.planes.index',
            'create' => 'administrador.planes.create',
            'store' => 'administrador.planes.store',
            'edit' => 'administrador.planes.edit',
            'update' => 'administrador.planes.update',
            'destroy' => 'administrador.planes.destroy'
        ]);
    
    Route::get('/planes/caracteristica-form', [\App\Http\Controllers\Admin\PlanController::class, 'caracteristicaForm'])
         ->name('administrador.planes.caracteristica-form');
});



// Rutas de gestión de usuarios
Route::get('/usuarios', [\App\Http\Controllers\Admin\UserController::class, 'index'])
     ->name('administrador.usuarios.index');
     
Route::delete('/usuarios/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])
     ->name('administrador.usuarios.destroy');

// Rutas de gestión de usuarios eliminados
Route::get('/usuarios/eliminados', [\App\Http\Controllers\Admin\UserController::class, 'deletedUsers'])
     ->name('administrador.usuarios.eliminados');
     
Route::patch('/usuarios/restore/{user}', [\App\Http\Controllers\Admin\UserController::class, 'restore'])
     ->name('administrador.usuarios.restore');



