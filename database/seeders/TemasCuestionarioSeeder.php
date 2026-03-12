<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TemasCuestionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear temas del cuestionario
        $temas = [
            ['nombre_tema' => 'Sobre la empresa', 'descripcion_tema' => 'Información básica sobre tu empresa', 'orden' => 1],
            ['nombre_tema' => 'Producto o servicio', 'descripcion_tema' => 'Detalles sobre lo que ofreces', 'orden' => 2],
            ['nombre_tema' => 'Clientes y público objetivo', 'descripcion_tema' => 'Información sobre tus clientes', 'orden' => 3],
            ['nombre_tema' => 'Competencia', 'descripcion_tema' => 'Información sobre tus competidores', 'orden' => 4],
            ['nombre_tema' => 'Marketing actual', 'descripcion_tema' => 'Tus estrategias de marketing actuales', 'orden' => 5],
            ['nombre_tema' => 'Ventas', 'descripcion_tema' => 'Información sobre tus ventas', 'orden' => 6],
            ['nombre_tema' => 'Problemas actuales', 'descripcion_tema' => 'Desafíos que enfrentas actualmente', 'orden' => 7],
            ['nombre_tema' => 'Objetivos', 'descripcion_tema' => 'Tus metas y objetivos', 'orden' => 8],
            ['nombre_tema' => 'Recursos', 'descripcion_tema' => 'Recursos disponibles para marketing', 'orden' => 9],
        ];

        $temasIds = [];
        foreach ($temas as $tema) {
            $id = DB::table('temas_cuestionario')->insertGetId([
                'nombre_tema' => $tema['nombre_tema'],
                'descripcion_tema' => $tema['descripcion_tema'],
                'orden' => $tema['orden'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $temasIds[$tema['nombre_tema']] = $id;
        }

        // Crear preguntas del cuestionario
        $preguntas = [
            // Sobre la empresa
            ['tema' => 'Sobre la empresa', 'pregunta' => '¿A qué se dedica la empresa?', 'orden' => 1],
            ['tema' => 'Sobre la empresa', 'pregunta' => '¿Cuál es la historia breve de la empresa? (¿cómo y por qué nació?)', 'orden' => 2],
            ['tema' => 'Sobre la empresa', 'pregunta' => '¿Qué objetivo principal tiene la empresa hoy?', 'orden' => 3],
            
            // Producto o servicio
            ['tema' => 'Producto o servicio', 'pregunta' => '¿Qué productos o servicios ofrecen?', 'orden' => 1],
            ['tema' => 'Producto o servicio', 'pregunta' => '¿Qué problema o necesidad del cliente solucionan?', 'orden' => 2],
            ['tema' => 'Producto o servicio', 'pregunta' => '¿Qué es lo que más valoran los clientes de su producto/servicio?', 'orden' => 3],
            ['tema' => 'Producto o servicio', 'pregunta' => '¿Cuál es su precio promedio?', 'orden' => 4],
            
            // Clientes y público objetivo
            ['tema' => 'Clientes y público objetivo', 'pregunta' => '¿Quiénes son sus clientes principales? (edad, lugar, tipo de persona)', 'orden' => 1],
            ['tema' => 'Clientes y público objetivo', 'pregunta' => '¿Por qué sus clientes eligen su empresa y no otra?', 'orden' => 2],
            ['tema' => 'Clientes y público objetivo', 'pregunta' => '¿Qué quejas, dudas o necesidades tienen comúnmente sus clientes?', 'orden' => 3],
            
            // Competencia
            ['tema' => 'Competencia', 'pregunta' => '¿Cuáles son sus principales competidores?', 'orden' => 1],
            ['tema' => 'Competencia', 'pregunta' => '¿Qué hacen mejor sus competidores?', 'orden' => 2],
            ['tema' => 'Competencia', 'pregunta' => '¿En qué sienten que ustedes son mejores que ellos?', 'orden' => 3],
            
            // Marketing actual
            ['tema' => 'Marketing actual', 'pregunta' => '¿En qué redes sociales están presentes?', 'orden' => 1],
            ['tema' => 'Marketing actual', 'pregunta' => '¿Qué tipo de contenido publican y cuál les funciona mejor?', 'orden' => 2],
            ['tema' => 'Marketing actual', 'pregunta' => '¿Realizan publicidad pagada? (Facebook Ads, TikTok Ads, etc.)', 'orden' => 3],
            
            // Ventas
            ['tema' => 'Ventas', 'pregunta' => '¿Cómo llegan los clientes a ustedes? (RRSS, WhatsApp, recomendaciones, tienda física)', 'orden' => 1],
            ['tema' => 'Ventas', 'pregunta' => '¿Cuál es su promedio de ventas mensuales? (no requiere exacto, puede ser aproximado)', 'orden' => 2],
            ['tema' => 'Ventas', 'pregunta' => '¿Qué productos/servicios venden más y cuáles menos?', 'orden' => 3],
            
            // Problemas actuales
            ['tema' => 'Problemas actuales', 'pregunta' => '¿Qué dificultades enfrentan actualmente para atraer clientes o vender más?', 'orden' => 1],
            ['tema' => 'Problemas actuales', 'pregunta' => '¿Qué procesos o áreas creen que se pueden mejorar?', 'orden' => 2],
            
            // Objetivos
            ['tema' => 'Objetivos', 'pregunta' => '¿Qué metas quieren lograr en los próximos 6–12 meses?', 'orden' => 1],
            ['tema' => 'Objetivos', 'pregunta' => '¿Qué les gustaría mejorar: ventas, alcance, imagen, redes sociales u otro?', 'orden' => 2],
            
            // Recursos
            ['tema' => 'Recursos', 'pregunta' => '¿Con qué presupuesto aproximado cuentan para marketing mensual?', 'orden' => 1],
            ['tema' => 'Recursos', 'pregunta' => '¿Quién o quiénes se encargan actualmente del marketing o redes sociales?', 'orden' => 2],
        ];

        foreach ($preguntas as $pregunta) {
            DB::table('preguntas_cuestionario')->insert([
                'tema_id' => $temasIds[$pregunta['tema']],
                'pregunta' => $pregunta['pregunta'],
                'orden' => $pregunta['orden'],
                'tipo_respuesta' => 'texto_largo',
                'requerido' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}