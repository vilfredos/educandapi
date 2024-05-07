<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use HasFactory;

    // ...
    public function showPost()
    {
        // Obtiene todos los posts
        $posts = DB::table('post')->get();
    
        // Para cada post, obtiene los comentarios y el nombre del usuario que hizo cada comentario
        foreach ($posts as $post) {
            $comentarios = DB::table('comentario')
                ->where('id_post', $post->id_post)
                ->get();
    
            foreach ($comentarios as $comentario) {
                $user = DB::table('users')
                    ->where('id', $comentario->user_id)
                    ->first();
                $comentario->name = $user->name;
            }
    
            $post->comentarios = $comentarios;
        }
    
        // Retorna la vista con los posts
        return view('post', ['posts' => $posts]);
    }
    public function commentPost(Request $request, $id_post)
    {
        $user = Auth::user(); // Obtiene el usuario actualmente autenticado
    
        // Valida el texto del comentario
        $request->validate([
            'texto' => 'required',
        ]);
    
        // Inserta el nuevo comentario en la base de datos
        DB::table('comentario')->insert([
            'id_post' => $id_post,
            'texto' => $request->texto,
            'user_id' => $user->id, // Añade el ID del usuario
        ]);
    
        // Redirige al usuario de vuelta a la página de posts
        return redirect()->route('post');
    }
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
    
        // Crear un nuevo post
        $post = [
            'title' => $request->title,
            'body' => $request->body,
            'id_usuario' => auth()->user()->id, // Asegúrate de tener autenticación implementada
        ];
    
        // Guardar el post
        DB::table('post')->insert($post);
    
        // Redirigir al usuario a la página de posts con un mensaje de éxito
        return redirect()->route('post')->with('success', 'Post publicado con éxito');
    } 
    public function destroy($id)
    {
        // Obtiene el post a eliminar
        $post = DB::table('post')->where('id_post', $id)->first();
        // Asegúrate de que el usuario autenticado es el propietario del post antes de eliminarlo
        if (Auth::id() !== $post->id_usuario) {
            return redirect()->back()->with('error', 'No tienes permiso para hacer eso.');
        }
    
        // Elimina el post
        DB::table('post')->where('id_post', $id)->delete();
    
        return redirect()->route('user_info')->with('success', 'Post eliminado con éxito.');
    }


}
