<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


/*
Route::middleware('/ranking', function () {
    return view('ranking');
})->name('ranking');
*/
/*para ir a post
Route::get('/post', function () {
    return view('post');
})->name('post');
*/


use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::resource('/buscador', RankingController ::class);

Route::get('/buscador/indexa', 'App\Http\Controllers\RankingController@indexa')->name('cliente.indexa');
Route::resource('/buscador', 'App\Http\Controllers\RankingController');

// web.phps


use App\Http\Controllers\PostController;
/*
Route::get('/post', [\App\Http\Controllers\PostController::class, 'showPost'])->name('post');
/*
Route::post('/post/{id_post}/comment', [PostController::class, 'commentPost'])->name('post.comment');

Route::post('/post/storet', [PostController::class, 'store'])->name('post.store');
*/
use App\Http\Controllers\UserController;
Route::get('/user_info', [UserController::class, 'show'])->name('user_info');

Route::get('/ranking', [\App\Http\Controllers\RankingController::class, 'index'])->name('ranking');

/*
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

/**/ 
Route::get('/buscador', [\App\Http\Controllers\RankingController::class, 'buscador_post'])->name('buscador');

//Route::get('/buscador/indexa', 'App\Http\Controllers\RankingController@indexa')->name('cliente.indexa');
//Route::resource('/buscador', 'App\Http\Controllers\RankingController');

/////
/*
Route::get('/pagina_central', function () {
    return view('pagina_central');
})->name('pagina_central');
*/

Route::get('/pagina_central', [\App\Http\Controllers\CategoriaController::class, 'index'])->name('pagina_central');

/*
Route::get('/post_show{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('post_show');
*/
/*
Route::post('/post/{id}/comment', [PostController::class, 'comment'])->name('post.comment');

Route::get('/post_show/{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('post_show');

/*calificar*/ 

Route::get('/calificar', [\App\Http\Controllers\CalificarController::class, 'index'])->name('calificar');

Route::get('/calificar_estudiante/{id}', function ($id) {
    return view('rubrica', ['id' => $id]);
})->name('rubrica');

Route::post('/calificar_estudiante/{id}', [\App\Http\Controllers\CalificarController::class, 'store'])->name('rubrica.store');

use App\Http\Controllers\ComentarioController;

Route::get('/monitorear-comentarios', [ComentarioController::class, 'monitorearComentarios'])->name('comentarios.monitorear');
Route::delete('/comentarios/{id_post}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');
Route::delete('/diccionario/{palabra}', [ComentarioController::class, 'destroyPalabra'])->name('diccionario.destroy');
Route::post('/diccionario', [ComentarioController::class, 'store'])->name('diccionario.store');

Route::get('/estadisticas-usuarios', [ComentarioController::class, 'estadisticasUsuarios'])->name('usuarios.estadisticas');


Route::get('/post/{id}', [PostController::class, 'show'])->name('post_show');
Route::post('/post/{id}/comment', [PostController::class, 'storeComment'])->name('post.comment');
/*
Route::get('post/{postId}/{parent_id?}', 'PostController@showPost')->name('post.show');
*/
Route::post('/registrar_post', [PostController::class, 'registrar'])->name('post.registrar');
Route::get('/crear_post', [PostController::class, 'mostrarFormulario'])->name('crear_post');

Route::post('/post.anuncio', [PostController::class, 'registrar_anuncio'])->name('post.anuncio');

use App\Http\Controllers\RubricaController;

Route::post('/crear_post', [RubricaController::class, 'store'])->name('crear_post');


use App\Http\Controllers\CalificacionController;

Route::get('/calificar_post', [CalificacionController::class, 'mostrarCalificaciones'])->name('calificar_post');
Route::post('/calificar', [CalificacionController::class, 'guardarCalificaciones'])->name('guardar_calificaciones');

use App\Http\Controllers\MoodleController;

Route::get('/course/{id}', [MoodleController::class, 'showCourse']);


use App\Http\Controllers\LTIController;


Route::post('/lti', [LTIController::class, 'launch'])->name('launch');
