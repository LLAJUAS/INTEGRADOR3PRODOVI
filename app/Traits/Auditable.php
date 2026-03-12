<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            $model->logAudit('create');
        });

        static::updated(function ($model) {
            $model->logAudit('update');
        });

        static::deleted(function ($model) {
            $model->logAudit('delete');
        });
    }

    protected function logAudit($action)
    {
        // No registrar si estamos corriendo desde consola (ej. migraciones/seeders)
        if (app()->runningInConsole()) return;

        $oldValues = $action === 'update' ? $this->getOriginal() : null;
        $newValues = $action === 'delete' ? null : $this->getAttributes();

        // Limpiar campos sensibles o innecesarios si se desea
        if ($oldValues) unset($oldValues['updated_at']);
        if ($newValues) unset($newValues['updated_at']);

        try {
            AuditLog::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'action' => $action,
                'auditable_type' => get_class($this),
                'auditable_id' => $this->getKey(),
                'old_values' => $oldValues,
                'new_values' => $newValues,
                'ip_address' => Request::ip()
            ]);
        } catch (\Exception $e) {
            // Silencioso para no bloquear la ejecución principal
        }
    }
}
