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

//Fechas y Estadisticas de inicio
Route::get('/', 'PedidosController@index');
Route::get('/{mes}/{ano}', function () {
});

//URLS y Formularios Datos Prestashop
Route::get('/insertar-prestashop', 'InsertarPrestashopController@index');
Route::post('/insertar-prestashop', 'InsertarPrestashopController@insertar');

//URLS y Formularios Tiendas fisicas
Route::get('/insertar-fisicas', 'InsertarFisicasController@index');
Route::post('/insertar-fisicas', 'InsertarFisicasController@insertar');

//URLS y Formularios Suscriptores
Route::get('/insertar-suscriptores', 'InsertarSuscriptoresController@index');
Route::post('/insertar-suscriptores', 'InsertarSuscriptoresController@insertar');

//URLS y Formularios Muestras
Route::get('/insertar-muestras', 'InsertarMuestrasController@index');
Route::post('/insertar-muestras', 'InsertarMuestrasController@insertar');






/*Route::get('/', function () {
    return view('admin_template');
});*/

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


