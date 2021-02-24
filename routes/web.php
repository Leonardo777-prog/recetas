<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// buscador de recetas

Route::get('/buscar', 'RecetaController@search')->name('buscar.show');

Route::get('/', 'InicioController@index')->name('inico.index');

Auth::routes();

Route::get('/recetas', 'RecetaController@index')->name('recetas.index');

Route::get('/recetas/create', 'RecetaController@create')->name('recetas.create');

Route::post('/recetas', 'RecetaController@store')->name('recetas.store');

Route::get('/recetas/{receta}', 'RecetaController@show')->name('recetas.show');

Route::get('/recetas/{receta}/edit', 'RecetaController@edit')->name('recetas.edit');

Route::put('/recetas/{receta}', 'RecetaController@update')->name('recetas.update');

Route::delete('/recetas/{receta}', 'RecetaController@destroy')->name('recetas.destroy');

Route::get('/profiles/{profile}', 'ProfileController@show')->name('profiles.show');

Route::get('profiles/{profile}/edit', 'ProfileController@edit')->name('profiles.edit');

Route::put('/profiles/{profile}', 'ProfileController@update')->name('profiles.update');

// almacen los likes

Route::post('/recetas/{receta}', 'LikesController@update')->name('likes.update');

// categorias

Route::get('/categorias/{categoria}', 'CategoriaController@show')->name('categorias.show');
