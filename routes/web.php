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

/**
 * Añade un nuevo usuario
 */
Route::post('/user', function (Request $request) {
    //
});

/**
 * Elimina un usuario existente
 */
Route::delete('/user/{id}', function ($id) {
    //
});
Route::get('/usuarios', function () {
    return view('usuarios');
});
Route::get('/us', 'UsuariosController@index');

Route::get('/dashboard', function(){
    return view('admin_template');
});
