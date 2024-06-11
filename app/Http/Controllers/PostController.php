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


    /*VERSION_2*/
    public function show($id)
    {
        $post = DB::table('post')
            ->join('users', 'post.id_usuario', '=', 'users.id')
            ->where('post.id_post', $id)
            ->select('post.*', 'users.name as user_name')
            ->first();

        $comentarios = DB::table('comentario')
            ->join('users', 'comentario.user_id', '=', 'users.id')
            ->where('comentario.id_post', $id)
            ->whereNull('comentario.parent_id')
            ->select('comentario.*', 'users.name as user_name')
            ->get();

        $replies = DB::table('comentario')
            ->join('users', 'comentario.user_id', '=', 'users.id')
            ->where('comentario.id_post', $id)
            ->whereNotNull('comentario.parent_id')
            ->select('comentario.*', 'users.name as user_name')
            ->get();


        $rubricas = DB::table('rubrica_post')
            ->where('id_post', $id)
            ->get();

        return view('post_show', compact('post', 'comentarios', 'replies', 'rubricas'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'texto' => 'required|string|max:255',
            'user_id' => 'required|integer',
        ]);
        $parent_id = $request->input('parent_id', null);

        DB::table('comentario')->insert([
            'id_post' => $id,
            'texto' => $request->input('texto'),
            'user_id' => $request->input('user_id'),
            'parent_id' => $parent_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('post_show', $id);
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'texto' => 'required',
        ]);

        DB::table('comentario')->insert([
            'texto' => $request->texto,
            'user_id' => $request->user_id,
            'id_post' => $id,
        ]);

        return back()->with('success', 'Tu comentario ha sido publicado con éxito.');
    }
    private function getCommentsWithReplies($comentarios)
    {
        foreach ($comentarios as $comentario) {
            $replies = DB::table('comentario')
                ->join('users', 'comentario.user_id', '=', 'users.id')
                ->select('comentario.*', 'users.name')
                ->where('parent_id', $comentario->id)
                ->get();

            if ($replies->isNotEmpty()) {
                $comentario->replies = $this->getCommentsWithReplies($replies);
            } else {
                $comentario->replies = [];
            }
        }
        return $comentarios;
    }
    public function showPost($postId, $parent_id = null)
    {
        // Obtener el post por su ID
        $post = DB::table('posts')->where('id', $postId)->first();

        // Obtener los comentarios del post
        $comentarios = DB::table('comentarios')->where('id_post', $postId)->get();

        // Retornar la vista con los datos
        return view('post.show', compact('post', 'comentarios', 'parent_id'));
    }
    public function registrar(Request $request)
    {
        DB::table('post')->insert([
            'title' => $request->title,
            'body' => $request->body,
            'id_usuario' => $request->user_id,
            'id_categoria' => 1,
            // Aquí puedes agregar todos los campos que necesites
        ]);

        return back()->with('success', 'Tu post ha sido creado con éxito.');
    }
    public function mostrarFormulario()
    {
        return view('crear_post');
    }
    public function registrar_anuncio(Request $request)
    {
        DB::table('anuncios')->insert([
            'Texto' => $request->texto,
            'id_user' => $request->user_id,
            // Aquí puedes agregar todos los campos que necesites
        ]);

        return back()->with('success', 'Tu post ha sido creado con éxito.');
    }
}
