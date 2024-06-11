<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RubricaController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'descripcionCalificar.*' => 'required|string',
            'nota.*' => 'required|integer',
        ]);

        // Insertar el nuevo post
        $postId = DB::table('post')->insertGetId([
            'id_usuario' => Auth::user()->id,
            'title' => $request->titulo,
            'body' => $request->descripcion,
            'id_categoria' => 1, // Ajusta según sea necesario
        ]);

        // Insertar las rúbricas asociadas al post
        $rubricas = [];
        foreach ($request->descripcionCalificar as $key => $descripcion) {
            $rubricas[] = [
                'id_post' => $postId,
                'description' => $descripcion,
                'nota' => $request->nota[$key],
            ];
        }
        DB::table('rubrica_post')->insert($rubricas);

        return redirect()->route('pagina_central')->with('success', 'Post y rúbrica creados correctamente.');
    }  //
}
