<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Cliente\PagoClienteController;
use App\Http\Controllers\FacebookPostController;
use App\Http\Controllers\SocialSimulatorController;
use App\Http\Controllers\Admin\AdminAnaliticasController;

use App\Http\Controllers\ChatbotController;

Route::get('/chatbot', [ChatbotController::class, 'mostrarVista'])->name('chatbot.vista');


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
    Route::get('/clientes/micuenta', [ClienteController::class, 'miCuenta'])->name('clientes.micuenta');
    Route::get('/clientes/brief', [ClienteController::class, 'brief'])->name('clientes.brief');
      // Cambia esta ruta para usar el nuevo controlador
    Route::get('/clientes/analiticas', [App\Http\Controllers\Cliente\ClienteAnaliticasController::class, 'index'])
        ->name('clientes.analiticas');
    Route::get('/clientes/analiticas/exportar-pdf', [App\Http\Controllers\Cliente\ClienteAnaliticasController::class, 'exportarPDF'])
    ->name('clientes.analiticas.exportar-pdf');
    
    // Agrega la ruta para cargar las vistas parciales
    Route::get('/clientes/analiticas/load-view', [App\Http\Controllers\Cliente\ClienteAnaliticasController::class, 'loadView'])
        ->name('clientes.analiticas.load-view');
     
    
    // Rutas de pago del cliente
    Route::get('/clientes/pago/{plan}', [PagoClienteController::class, 'show'])->name('clientes.pago');
    Route::post('/pago/procesar/{plan}', [PagoClienteController::class, 'procesarPago'])->name('pago.procesar');
});

//ESTADO PAGO
Route::get('/clientes/estado-pago', [PagoClienteController::class, 'estadoPago'])
    ->name('clientes.pago.estado')
    ->middleware('auth');

// Rutas de Facebook (sin middleware)
Route::get('/facebook/post', [FacebookPostController::class, 'showForm'])->name('facebook.post.form');
Route::post('/facebook/post', [FacebookPostController::class, 'postToPage'])->name('facebook.post');

// Rutas de administrador
Route::prefix('administrador')->middleware('auth')->group(function () {
      // Rutas para publicaciones
    Route::get('/publicaciones/publicar', [\App\Http\Controllers\Admin\PublicacionController::class, 'index'])
         ->name('administrador.publicaciones.publicar');
         
    Route::get('/dashboard', function () {
        return view('administrador.dashboard');
    })->name('administrador.dashboard');
    // Ruta para el panel de analíticas del administrador
    Route::get('/analiticas', [\App\Http\Controllers\Admin\AdminAnaliticasController::class, 'index'])
        ->name('admin.analiticas.index');

    // Ruta para guardar nueva campaña desde el modal (AJAX)
    Route::post('/analiticas/store-campania', [\App\Http\Controllers\Admin\AdminAnaliticasController::class, 'storeCampania'])
        ->name('admin.analiticas.storeCampania');

    // Ruta para exportar campañas
    Route::get('/analiticas/export-campanias', [\App\Http\Controllers\Admin\AdminAnaliticasController::class, 'exportCampanias'])
        ->name('admin.analiticas.exportCampanias');

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



// Ruta para obtener el plan contratado por el usuario
// Dentro del grupo de rutas con middleware 'auth'
Route::get('/cliente/plan-contratado', [\App\Http\Controllers\Cliente\PlanController::class, 'getPlanContratado'])
    ->name('cliente.plan-contratado');
//CAMPAÑAS
// Gestión de campañas
Route::prefix('campañas')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\CampañasController::class, 'index'])
         ->name('administrador.campañas.index');

    Route::post('/guardar', [\App\Http\Controllers\Admin\CampañasController::class, 'guardar'])
         ->name('administrador.campañas.guardar');
         
    // Nuevas rutas para ver y editar campañas
    Route::get('/{campania}', [\App\Http\Controllers\Admin\CampañasController::class, 'show'])
         ->name('administrador.campañas.show');
         
    Route::get('/{campania}/editar', [\App\Http\Controllers\Admin\CampañasController::class, 'edit'])
         ->name('administrador.campañas.edit');
         
    Route::put('/{campania}', [\App\Http\Controllers\Admin\CampañasController::class, 'update'])
         ->name('administrador.campañas.update');
         
    Route::patch('/{campania}/activar', [\App\Http\Controllers\Admin\CampañasController::class, 'activar'])
         ->name('administrador.campañas.activar');
         



   // Rutas para tareas
Route::prefix('/{campania}/tareas')->group(function () {
    Route::get('/crear', [\App\Http\Controllers\Admin\TareaController::class, 'create'])
         ->name('administrador.tareas.create');
         
    Route::post('/', [\App\Http\Controllers\Admin\TareaController::class, 'store'])
         ->name('administrador.tareas.store');
});

// Otras rutas de tareas
Route::get('/tareas/{tarea}', [\App\Http\Controllers\Admin\TareaController::class, 'show'])
    ->name('administrador.tareas.show');

Route::get('/tareas/{tarea}/edit', [\App\Http\Controllers\Admin\TareaController::class, 'edit'])
    ->name('administrador.tareas.edit');

Route::put('/tareas/{tarea}', [\App\Http\Controllers\Admin\TareaController::class, 'update'])
    ->name('administrador.tareas.update');


    // Rutas para archivos de tareas
// Ruta para mostrar tarea individual
Route::get('/tareas/{tarea}', [\App\Http\Controllers\Admin\TareaController::class, 'show'])
    ->name('administrador.tareas.show');

// Ruta para subir archivos
Route::prefix('/tareas/{tarea}/archivos')->group(function () {
    Route::get('/subir', [\App\Http\Controllers\Admin\TareaArchivoController::class, 'create'])
         ->name('administrador.tareas.archivos.create');
         
    Route::post('/', [\App\Http\Controllers\Admin\TareaArchivoController::class, 'store'])
         ->name('administrador.tareas.archivos.store');
});



// Rutas para comentarios de tareas
Route::prefix('/tareas/{tarea}/comentarios')->group(function () {
    Route::post('/', [\App\Http\Controllers\Admin\TareaComentarioController::class, 'store'])
         ->name('administrador.tareas.comentarios.store');
         
    Route::delete('/{comentario}', [\App\Http\Controllers\Admin\TareaComentarioController::class, 'destroy'])
         ->name('administrador.tareas.comentarios.destroy');
});
Route::put('/tareas/archivos/{archivo}/estado', [\App\Http\Controllers\Admin\TareaArchivoController::class, 'updateEstado'])
     ->name('administrador.tareas.archivos.update-estado');
// Ruta para ver tareas subidas (nueva vista)
Route::get('/tareas/{tarea}/ver-subidas', [\App\Http\Controllers\Admin\TareaArchivoController::class, 'verSubidas'])
     ->name('administrador.tareas.ver-subidas');


// Ruta para el calendario de tareas
// Dentro del grupo de rutas de campañas
Route::get('/{campania}/calendario', [\App\Http\Controllers\Admin\TareaController::class, 'calendario'])
     ->name('administrador.campañas.calendario');
Route::get('/admin/generar-reporte-campanas', [AdminAnaliticasController::class, 'generarReporteCampanas'])
     ->name('admin.generar.reporte.campanas');

});
