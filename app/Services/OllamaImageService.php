<?php

namespace App\Services;

use App\Models\Tarea;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class OllamaImageService
{
    /**
     * Genera un texto publicitario (copy) a partir de una imagen y el contexto de la empresa/campaña.
     *
     * @param int $tareaId
     * @return string|null
     */
    public function generateCopyFromImage(int $tareaId): ?string
    {
        // 1. Obtener la tarea con TODAS las relaciones necesarias
        // Usamos 'with' para evitar múltiples consultas a la base de datos (problema N+1)
        $tarea = Tarea::with([
            'archivos' => function($query) {
                $query->where('estado', 'aprobado');
            },
            'campania.cliente.empresas' // Cargamos la campaña, el cliente y sus empresas
        ])->findOrFail($tareaId);

        $imagen = $tarea->archivos->first();

        if (!$imagen) {
            Log::error("No se encontró un archivo aprobado para la tarea ID: {$tareaId}");
            return 'Error: No se encontró una imagen aprobada para analizar.';
        }

        // 2. Validar que el archivo sea una imagen
        $extensionesValidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array(strtolower($imagen->extension), $extensionesValidas)) {
            Log::error("El archivo aprobado para la tarea ID: {$tareaId} no es una imagen válida.");
            return 'Error: El archivo seleccionado no es una imagen válida.';
        }

        // 3. Leer la imagen y convertirla a base64
        try {
            $disk = Storage::disk('public');

            if (!$disk->exists($imagen->ruta_archivo)) {
                Log::error("El archivo no existe en el disco 'public' para la tarea ID: {$tareaId}. Ruta buscada: " . $imagen->ruta_archivo);
                return 'Error: El archivo de imagen no se encuentra en el servidor.';
            }

            $imageData = $disk->get($imagen->ruta_archivo);
            $base64Image = base64_encode($imageData);

        } catch (\Exception $e) {
            Log::error("No se pudo leer la imagen para la tarea ID: {$tareaId}. Error: " . $e->getMessage());
            return 'Error: No se pudo procesar el archivo de imagen.';
        }

        // --- NUEVO: PASO 4. Construir el contexto a partir de los datos del cliente ---
        $contextoAdicional = "";
        $empresa = $tarea->campania?->cliente?->empresas?->first(); // Usamos operadores de nulidad segura para evitar errores

        if ($empresa) {
            $contextoAdicional = <<<EOT
            ---
            **CONTEXTO IMPORTANTE DE LA EMPRESA Y CAMPAÑA:**
            
            **Nombre de la Empresa:** {$empresa->nombre_empresa}
            **Tipo de Empresa:** {$empresa->tipo_empresa}
            
            **Resumen Ejecutivo de la Empresa:**
            {$empresa->resumen_ejecutivo}
            
            **Campaña Actual:** {$tarea->campania->nombre}
            **Descripción de la Campaña:** {$tarea->campania->descripcion}
            ---
            EOT;
        }

        // 5. Construir el prompt para la IA, ahora incluyendo el contexto
        $prompt = <<<EOT
        Eres un experto copywriter de redes sociales. Tu tarea es crear 3 opciones de texto publicitario (copy) altamente personalizados y efectivos.

        Se te proporcionará una imagen y, muy importante, un contexto detallado sobre la empresa y la campaña para la que estás escribiendo. Debes usar AMBOS elementos (la imagen y el contexto) para generar el copy.

        {$contextoAdicional}

        **INSTRUCCIONES:**
        1. Analiza la imagen detenidamente.
        2. Lee y comprende el contexto de la empresa y la campaña.
        3. Basado en ambos, genera 3 opciones de copy que se alineen perfectamente con la marca, el producto/servicio y los objetivos de la campaña.
        4. El tono debe ser coherente con la información del resumen ejecutivo.
        5. Incluye hashtags relevantes si es apropiado.

        **EJEMPLO DE RESPUESTA:**
        1. ¡Desliza para descubrir la magia! ✨ Nuestro nuevo producto está aquí para iluminar tu día. #Nuevo #Lanzamiento
        2. ¿Buscas algo único? Esta es tu respuesta. Calidad y diseño que te enamorarán. ❤️ #Moda #Estilo
        3. Transforma tu rutina con este imprescindible. ¡No te quedes sin el tuyo! 🚀 #Imprescindible #Oferta

        Responde ÚNICAMENTE con las 3 opciones de copy, numeradas del 1 al 3. No añadas ningún otro texto.
        EOT;

        // 6. Preparar la petición
        $payload = [
            'model' => 'deepseek-v3.1:671b', // Seguimos usando el modelo que te funciona
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt,
                ]
            ],
            'images' => [$base64Image],
            'stream' => false,
        ];

        Log::info('Payload enriquecido enviado a Ollama (Tarea ID: ' . $tareaId . ')', $payload);

        // 7. Hacer la llamada a la API de Ollama
        $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.ollama.key'),
                'Content-Type' => 'application/json',
            ])
            ->withOptions([
                'verify' => false,
            ])
            ->timeout(180)
            ->post(config('services.ollama.url'), $payload);

        // 8. Procesar la respuesta
        if ($response->successful()) {
            $data = $response->json();
            return $data['message']['content'] ?? 'No se pudo generar el copy.';
        } else {
            Log::error('Error en la API de Ollama para análisis de imagen: ' . $response->body());
            return 'Hubo un error para analizar la imagen.';
        }
    }
}