<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// definicion de ruta tipo resource de pelicula
// se puede revisar las formas en que se puede acceder a esta ruta con
//php artisan route:list

Route::resource('/peliculas', 'PeliculaController');

Auth::routes();
