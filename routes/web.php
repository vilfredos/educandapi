<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});
/*
Route::get('/ranking', function () {
    return view('ranking');
})->name('ranking');
*/
/*para ir a post*/
Route::get('/post', function () {
    return view('post');
})->name('post');



use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::resource('/buscador', RankingController ::class);

Route::get('/buscador/indexa', 'App\Http\Controllers\RankingController@indexa')->name('cliente.indexa');
Route::resource('/buscador', 'App\Http\Controllers\RankingController');

// web.phps


use App\Http\Controllers\PostController;
Route::get('/post', [\App\Http\Controllers\PostController::class, 'showPost'])->name('post');

Route::post('/post/{id_post}/comment', [PostController::class, 'commentPost'])->name('post.comment');

Route::post('/post/storet', [PostController::class, 'store'])->name('post.store');

use App\Http\Controllers\UserController;
Route::get('/user_info', [UserController::class, 'show'])->name('user_info');

Route::get('/ranking', [\App\Http\Controllers\RankingController::class, 'index'])->name('ranking');

Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

/**/ 
Route::get('/buscador', [\App\Http\Controllers\RankingController::class, 'buscador_post'])->name('buscador');

//Route::get('/buscador/indexa', 'App\Http\Controllers\RankingController@indexa')->name('cliente.indexa');
//Route::resource('/buscador', 'App\Http\Controllers\RankingController');