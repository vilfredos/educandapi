<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalificarController extends Controller
{

    public function index()
    {
        // Obtener estudiantes
        $estudiantes = DB::table('users')->where('name', 'not like', '%profesor%')->get();
        $ids_estudiantes = $estudiantes->pluck('id')->toArray();
    
        // Obtener notas de la tabla rubrica
        $notas = DB::table('rubrica')->whereIn('id_user', $ids_estudiantes)->get(['id_user', 'nota']);
    
        // Obtener la suma de las notas por estudiante de la tabla nota_estudiantes
        $notas_estudiantes = DB::table('nota_estudiantes')
            ->whereIn('id_user', $ids_estudiantes)
            ->select('id_user', DB::raw('SUM(nota) as suma_nota_estudiantes'))
            ->groupBy('id_user')
            ->get()
            ->keyBy('id_user');
    
        // Obtener la suma de las notas por post de la tabla rubrica_post
        $suma_nota_rubrica_post = DB::table('rubrica_post')
            ->sum('nota');
    
        // Pasar los datos a la vista
        return view('calificar', compact('estudiantes', 'notas', 'notas_estudiantes', 'suma_nota_rubrica_post'));
    }
    
    /*
    public function calificar($id)
{
    // Ejemplo de datos de estudiantes
    $estudiantes = [
        1 => ['nombre' => 'Estudiante 1'],
        2 => ['nombre' => 'Estudiante 2'],
        // Agrega más estudiantes según sea necesario
    ];

    // Encuentra el estudiante por id en la matriz
    $estudiante = isset($estudiantes[$id]) ? $estudiantes[$id] : null;

    if ($estudiante) {
        return view('calificar_estudiante', compact('estudiante'));
    } else {
        // Maneja el caso cuando el estudiante no se encuentra
        return redirect('/')->with('error', 'Estudiante no encontrado');
    }
}*/
    public function store(Request $request)
    {
        // Asignar puntajes a las rúbricas
        $participacionPuntaje = [
            'excelente' => 25, // Participa activamente
            'bueno' => 20, // Participa de forma regular
            'aceptable' => 10, // Participa de forma limitada
            'bajo' => 0, // No participa
        ];

        $calidadAportesPuntaje = [
            'excelente' => 25, // Excelente dominio
            'bueno' => 20, // Buen dominio
            'aceptable' => 10, // Limitado
            'bajo' => 0, // Inexistente o irrelevante
        ];

        $interaccionPuntaje = [
            'excelente' => 20, // Interacción enriquecedora
            'bueno' => 15, // Adecuada
            'aceptable' => 5, // Limitada
            'bajo' => 0, // No interactúa
        ];

        $organizacionPuntaje = [
            'excelente' => 15, // Clara y organizada
            'bueno' => 10, // Clara pero con alguna falta de estructura
            'aceptable' => 5, // Poco clara y desorganizada
            'bajo' => 0, // Confusa y desordenada
        ];

        $reglasForoPuntaje = [
            'excelente' => 15, // Respeta el 100%
            'bueno' => 10, // Respeta el 75%
            'aceptable' => 5, // Respeta el 50%
            'bajo' => 0, // No respeta el 50%
        ];

        // Obtener las entradas del request
        $participacion = $request->input('participacion');
        $calidad_aportes = $request->input('calidad_aportes');
        $interaccion = $request->input('interaccion');
        $organizacion = $request->input('Organización');
        $reglas = $request->input('Reglas');

        // Calcular la nota total
        $notaTotal = $participacionPuntaje[$participacion] +
            $calidadAportesPuntaje[$calidad_aportes] +
            $interaccionPuntaje[$interaccion] +
            $organizacionPuntaje[$organizacion] +
            $reglasForoPuntaje[$reglas];

        // Actualizar o insertar en la tabla 'rubrica'
        DB::table('rubrica')->updateOrInsert(
            ['id_user' => $request->input('id_user')],
            [
                'Participacion_activa' => $request->input('participacion'),
                'Calidad_aportes' => $request->input('calidad_aportes'),
                'Interaccion_companeros' => $request->input('interaccion'),
                'Organizacion_presentacion' => $request->input('Organización'),
                'Reglas_foro' => $request->input('Reglas'),
                'nota' => $notaTotal
            ]
        );

        /* Actualizar o insertar la nota en la tabla 'nota_estudiantes'
        DB::table('nota_estudiantes')->updateOrInsert(
            ['id_user' => $request->input('id_user')],
            ['nota' => $notaTotal]
        );*/

        return redirect()->route('calificar');
    }
}
