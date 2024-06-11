<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = DB::table('Categoria')->get();
        
        foreach ($categorias as $categoria) {
            $categoria->posts = DB::table('Post')
                ->where('id_categoria', $categoria->id_categoria)
                ->get();
        }
    
        // Obtener anuncios
        $anuncios = DB::table('Anuncios')
            ->join('users', 'Anuncios.id_user', '=', 'users.id')
            ->select('Anuncios.*', 'users.name')
            ->get();
    
        return view('pagina_central', [
            'categorias' => $categorias,
            'anuncios' => $anuncios
        ]);
    }
}
