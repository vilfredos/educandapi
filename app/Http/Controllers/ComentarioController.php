<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComentarioController extends Controller
{
    public function monitorearComentarios()
    {
        // Obtener todas las malas palabras del diccionario
        $malasPalabras = DB::table('diccionario')->pluck('malas palabras')->toArray();
    
        // Obtener los comentarios que contienen malas palabras
        $comentarios = DB::table('comentario')
            ->join('post', 'comentario.id_post', '=', 'post.id_post')
            ->join('users', 'comentario.user_id', '=', 'users.id')
            ->join('categoria', 'post.id_categoria', '=', 'categoria.id_categoria')
            ->select('comentario.id_post', 'comentario.texto', 'users.name', 'users.email', 'post.title as post_title', 'categoria.titulo as categoria_title')
            ->where(function($query) use ($malasPalabras) {
                foreach ($malasPalabras as $palabra) {
                    $query->orWhere('comentario.texto', 'LIKE', '%' . $palabra . '%');
                }
            })
            ->get();
            $malaP = DB::table('diccionario')->pluck('malas palabras')->toArray();
        return view('monitorear', compact('comentarios','malasPalabras'));
    }

    public function destroy(Request $request, $id_post)
    {
        $texto = $request->input('texto');
    
        DB::table('comentario')
            ->where('id_post', $id_post)
            ->where('texto', $texto)
            ->delete();
    
        return redirect()->route('comentarios.monitorear')->with('success', 'Comentario eliminado con éxito');
    }
    public function destroyPalabra($palabra)
    {
        DB::table('diccionario')
            ->where('malas palabras', $palabra)
            ->delete();
    
        return redirect()->route('comentarios.monitorear')->with('success', 'Palabra eliminada con éxito');
    }
    public function store(Request $request)
    {
        $nueva_palabra = $request->input('nueva_palabra');
    
        DB::table('diccionario')->insert([
            'malas palabras' => $nueva_palabra
        ]);
    
        return redirect()->route('comentarios.monitorear')->with('success', 'Palabra agregada con éxito');
    }

    
    public function estadisticasUsuarios(Request $request)
    {
        // Obtener estadísticas generales
        $total_posts = DB::table('post')->count();
        $total_comentarios = DB::table('comentario')->count();
    
        // Consulta para obtener estadísticas de cada usuario
        $query = DB::table('users')
            ->leftJoin('comentario', 'users.id', '=', 'comentario.user_id')
            ->leftJoin('post', 'comentario.id_post', '=', 'post.id_post')
            ->leftJoin('categoria', 'post.id_categoria', '=', 'categoria.id_categoria')
            ->select(
                'users.id',
                'users.name',
                'post.title as post_title',
                'categoria.titulo as categoria_title',
                'comentario.texto as comentario_texto',
                DB::raw('COUNT(DISTINCT post.id_post) as posts_creados'),
                DB::raw('COUNT(DISTINCT comentario.id_post) as posts_comentados'),
                DB::raw('COUNT(comentario.texto) as total_comentarios')
            )
            ->where('users.name', 'not like', '%profesor%')
            ->groupBy('users.id', 'users.name', 'post.title', 'categoria.titulo', 'comentario.texto');
    
        if ($request->filled('user_id')) {
            $query->where('users.id', $request->input('user_id'));
        }
    
        if ($request->filled('name')) {
            $query->where('users.name', 'like', '%' . $request->input('name') . '%');
        }
    
        $estadisticas = $query->get();
    
        // Calcular estadísticas específicas por usuario
        $usuarios_estadisticas = [];
        foreach ($estadisticas as $estadistica) {
            if (!isset($usuarios_estadisticas[$estadistica->id])) {
                $usuarios_estadisticas[$estadistica->id] = [
                    'name' => $estadistica->name,
                    'posts_creados' => 0,
                    'posts_comentados' => 0,
                    'total_comentarios' => 0,
                    'comentarios' => []
                ];
            }
            $usuarios_estadisticas[$estadistica->id]['posts_creados'] += $estadistica->posts_creados;
            $usuarios_estadisticas[$estadistica->id]['posts_comentados'] += $estadistica->posts_comentados;
            $usuarios_estadisticas[$estadistica->id]['total_comentarios'] += $estadistica->total_comentarios;
            $usuarios_estadisticas[$estadistica->id]['comentarios'][] = [
                'comentario_texto' => $estadistica->comentario_texto,
                'post_title' => $estadistica->post_title,
                'categoria_title' => $estadistica->categoria_title
            ];
        }
    
        return view('estadisticas', compact('usuarios_estadisticas', 'total_posts', 'total_comentarios'));
    }
}