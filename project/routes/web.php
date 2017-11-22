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


Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

//Proyecto
Route::get('/index', 'ProyectoController@index');
Route::get('proyecto/create', 'ProyectoController@create');
Route::post('proyecto', 'ProyectoController@store'); 
Route::get('proyecto/{proyecto}/edit', 'ProyectoController@edit');
Route::post('proyecto/update/{proyecto}', 'ProyectoController@update');
Route::post('proyecto/delete/{proyecto}','ProyectoController@delete');

//Persona
Route::get('persona/index', 'PersonaController@index');
Route::get('persona/create', 'PersonaController@create');
Route::post('persona', 'PersonaController@store'); 