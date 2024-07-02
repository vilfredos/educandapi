<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = DB::table('categoria')->get();
        
        foreach ($categorias as $categoria) {
            $categoria->posts = DB::table('post')
                ->where('id_categoria', $categoria->id_categoria)
                ->get();
        }
    
        // Obtener anuncios
        $anuncios = DB::table('anuncios')
            ->join('users', 'anuncios.id_user', '=', 'users.id')
            ->select('anuncios.*', 'users.name')
            ->get();
    
        return view('pagina_central', [
            'categorias' => $categorias,
            'anuncios' => $anuncios
        ]);
    }
}
