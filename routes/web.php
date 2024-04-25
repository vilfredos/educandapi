<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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

/*para ir a user_info*/
Route::get('/user_info', function () {
    return view('user_info');
})->name('user_info');

/*para ir a vista_principal*/
Route::get('/vista_principal', function () {
    return view('vista_principal');
})->name('vista_principal');

use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Auth;

Route::get('/ranking', 'App\Http\Controllers\RankingController@index')->name('ranking');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
