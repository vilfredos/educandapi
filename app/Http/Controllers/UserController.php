<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //public function show()
    public function show()
    {
        $user = Auth::user(); // Obtiene el usuario actualmente autenticado
    
        // Obtiene todos los posts del usuario
        $posts = DB::table('post')
            ->where('id_usuario', $user->id)
            ->get();
    
        // Retorna la vista con la información del usuario y sus posts
        return view('user_info', ['user' => $user, 'posts' => $posts]);
    }
    
}
