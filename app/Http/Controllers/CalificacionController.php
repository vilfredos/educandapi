<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalificacionController extends Controller
{
    public function mostrarCalificaciones()
    {
        $posts = DB::table('post')->get();

        $estudiantes = DB::table('users')
            ->where('name', 'NOT LIKE', '%profesor%')
            ->select('id', 'name')
            ->get();

        $rubricas = DB::table('rubrica_post')->get();

        return view('calificar_post', compact('posts', 'estudiantes', 'rubricas'));
    }

    public function guardarCalificaciones(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|integer|exists:users,id',
            'notas' => 'required|array',
            'notas.*' => 'integer|min:0',
            'id_post' => 'required|integer|exists:post,id_post',
        ]);
    
        $idUser = $data['id_user'];
        $idPost = $data['id_post'];
        $totalNota = array_sum($data['notas']);
    
        // Actualizar o insertar la nota sumada en la base de datos
        DB::table('nota_estudiantes')->updateOrInsert(
            [
                'id_user' => $idUser,
                'id_post' => $idPost
            ],
            [
                'nota' => $totalNota
            ]
        );
    
        return redirect()->route('calificar_post')->with('success', 'Calificaciones guardadas exitosamente');
    }
    
}
