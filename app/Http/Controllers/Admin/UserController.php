<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todos los roles para el select
        $roles = Role::all();
        
        // Consulta base con relaciones
        $query = User::with(['roles', 'suscripciones']);
        
        // Filtrar por nombre si se proporciona
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Filtrar por rol si se selecciona
        if ($request->has('role') && !empty($request->role)) {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('roles.id', $request->role);
            });
        }
        
        // Filtrar por estado
        if ($request->has('status') && !empty($request->status)) {
            switch ($request->status) {
                case 'admin':
                    $query->whereHas('roles', function($q) {
                        $q->where('nombre_rol', 'Administrador');
                    });
                    break;
                    
                case 'active':
                    $query->whereHas('suscripciones', function($q) {
                        $q->where('estado', 'activa')
                          ->where('fecha_fin', '>', now());
                    })->whereDoesntHave('roles', function($q) {
                        $q->where('nombre_rol', 'Administrador');
                    });
                    break;
                    
                case 'inactive':
                    $query->whereHas('suscripciones', function($q) {
                        $q->where('estado', '!=', 'activa')
                          ->orWhere('fecha_fin', '<', now());
                    })->whereDoesntHave('roles', function($q) {
                        $q->where('nombre_rol', 'Administrador');
                    });
                    break;
                    
                case 'no_plan':
                    $query->doesntHave('suscripciones')
                          ->whereDoesntHave('roles', function($q) {
                              $q->where('nombre_rol', 'Administrador');
                          });
                    break;
            }
        }
        
        // Ordenar y paginar
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('administrador.usuarios.index', compact('users', 'roles'));
    }

    public function destroy($id)
    {
        try {
            $user = User::with(['roles', 'suscripciones'])->findOrFail($id);
            
            // Eliminar suscripciones relacionadas primero
            if ($user->suscripciones->isNotEmpty()) {
                $user->suscripciones()->delete();
            }
            
            // Eliminar relaciones de roles
            if ($user->roles->isNotEmpty()) {
                $user->roles()->detach();
            }
            
            // Eliminar el usuario
            $user->delete();
            
            return redirect()->route('administrador.usuarios.index')
                ->with('success', 'Usuario eliminado correctamente');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }


    public function deletedUsers()
    {
        $users = User::onlyTrashed()->with(['roles', 'suscripciones' => function($query) {
            $query->withTrashed();
        }])->orderBy('deleted_at', 'desc')->paginate(10);
        
        return view('administrador.usuarios.eliminados', compact('users'));
    }

    public function restore($id)
    {
        try {
            $user = User::onlyTrashed()->findOrFail($id);
            
            // Restaurar suscripciones relacionadas si existen
            if ($user->suscripciones()->withTrashed()->exists()) {
                $user->suscripciones()->withTrashed()->restore();
            }
            
            // Restaurar el usuario
            $user->restore();
            
            return redirect()->route('administrador.usuarios.eliminados')
                ->with('success', 'Usuario restaurado correctamente');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al restaurar el usuario: ' . $e->getMessage());
        }
    }
}