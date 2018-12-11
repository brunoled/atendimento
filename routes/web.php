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
});
/* Rotas Atendimento */

Route::get('/', 'ControladorAtendimento@indexView');

Route::get('/ocorrencia/{id}', 'ControladorOcorrencia@indexView');

Route::get('/search', 'ControladorAtendimento@search');


/* Rotas Painel Administrativo */

Route::get('/adm/causas', 'ControladorCausa@indexView');

Route::get('/adm/prioridades', 'ControladorPrioridade@indexView');

Route::get('/adm/tipo-atd', 'ControladorTipoAtd@indexView');

Route::get('/adm/subtipo', 'ControladorSubCausa@indexView');
