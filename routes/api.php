<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::resource('/adm/causas', 'ControladorCausa');

Route::resource('/adm/prioridades', 'ControladorPrioridade');

Route::resource('/adm/tipo-atd', 'ControladorTipoAtd');

Route::resource('/adm/subtipo', 'ControladorSubCausa');

Route::get('/adm/causas/sub/{causaid}', 'ControladorCausa@buscaSub');

Route::resource('/contato', 'ControladorContato');

Route::resource('/atendimento', 'ControladorAtendimento');

Route::resource('/ocorrencia', 'ControladorOcorrencia');

Route::get('/atendimento/search', 'ControladorAtendimento@search');

Route::post('/login', 'ControladorUsuario@login');
