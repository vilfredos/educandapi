<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    //
    public function index()
    {
        $posts = DB::table('post')
            ->join('users', 'users.id', '=', 'post.id_usuario')
            ->select('post.*', 'users.name', DB::raw('(SELECT COUNT(*) FROM comentario WHERE comentario.id_post = post.id_post) as comment_count'))
            ->get();

        return view('ranking', ['posts' => $posts]);
    }
    public function buscador_post(Request $request)
    {
        $texto = trim($request->get('texto'));
        $posts = DB::table('post')
            ->select('title', 'body', 'id_post')
            ->where('title', 'LIKE', '%' . $texto . '%')
            ->orwhere('body', 'LIKE', '%' . $texto . '%')
            ->paginate(10);
        return view('buscador', compact('posts', 'texto'));
    }
}
