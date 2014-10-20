<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    return View::make('inicio');
});

Route::group(array('prefix' => 'entrada'), function()
{
    Route::get('/', function()
    {
        return View::make('entrada');
    });
    
    //Nueva Entrada a partir de Orden de Compra
    Route::get('/info/{id?}','EntradaController@info');
    Route::get('/nueva', 'EntradaController@nueva');
    Route::post('/nueva/articulos', 'EntradaController@selArticulos');
    Route::post('/crear', 'EntradaController@crearEntrada');
    
});

Route::get('/prueba', function()
{
     return 'Prueba';
});
