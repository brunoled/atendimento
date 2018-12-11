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

/* Rotas Painel Administrativo */

Route::get('/adm', function () {
    return view('index');
})->middleware('auth');
/* Rotas Atendimento */

Route::get('/', 'ControladorAtendimento@indexView')->middleware('auth');

Route::get('/ocorrencia/{id}', 'ControladorOcorrencia@indexView')->middleware('auth');

Route::get('/search', 'ControladorAtendimento@search')->middleware('auth');


/* Rotas Painel Administrativo */

Route::get('/adm/causas', 'ControladorCausa@indexView')->middleware('auth');

Route::get('/adm/prioridades', 'ControladorPrioridade@indexView')->middleware('auth');

Route::get('/adm/tipo-atd', 'ControladorTipoAtd@indexView')->middleware('auth');

Route::get('/adm/subtipo', 'ControladorSubCausa@indexView')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
