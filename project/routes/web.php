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
Route::get('/pick_role', 'HomeController@pick');
Route::post('/login_with_role', 'HomeController@pickRole');

//Proyecto
Route::get('/indexProyecto', 'ProyectoController@index');
Route::get('proyecto/create', 'ProyectoController@create');
Route::post('proyecto', 'ProyectoController@store'); 
Route::get('proyecto/{proyecto}/edit', 'ProyectoController@edit');
Route::post('proyecto/update/{proyecto}', 'ProyectoController@update');
Route::post('proyecto/delete/{proyecto}','ProyectoController@delete');
Route::get('proyecto/{proyecto}/info' ,'ProyectoController@info');

//Persona
Route::get('persona/index', 'PersonaController@index');
Route::get('persona/create', 'PersonaController@create');
Route::post('persona', 'PersonaController@store'); 
Route::get('persona/persona/create', 'PersonaController@create');

//Estudiante
Route::get('estudiante/index', 'EstudianteController@index');

//Hito
Route::get('/indexHito', 'HitoController@index');
Route::get('hito/create', 'HitoController@create');
Route::post('hito', 'HitoController@store');
Route::get('hito/{hito}/info' ,'HitoController@info');
Route::post('hito/delete/{hito}','HitoController@delete');
Route::get('hito/{hito}/edit', 'HitoController@edit');
Route::post('hito/update/{hito}', 'HitoController@update');

//Tarea
Route::get('/indexTarea', 'TareaController@index');
Route::get('tarea/create', 'TareaController@create');
Route::post('tarea', 'TareaController@store');
Route::get('tarea/{tarea}/info' ,'TareaController@info');
Route::post('tarea/delete/{tarea}','TareaController@delete');
Route::get('tarea/{tarea}/edit', 'TareaController@edit');
Route::post('tarea/update/{tarea}', 'TareaController@update');
Route::post('/fechas' ,'TareaController@fechas');

//Entregable
Route::get('/indexEntregable', 'EntregableController@index');
Route::get('entregable/{tarea}/create', 'EntregableController@create');
Route::post('entregable', 'EntregableController@store');
Route::get('entregable/{entregable}/info', 'EntregableController@info');
Route::get('entregable/create2', 'EntregableController@create2');
Route::get('entregable/{entregable}/edit', 'EntregableController@edit');
Route::post('entregable/update/{entregable}', 'EntregableController@update');
Route::post('entregable/delete/{entregable}','EntregableController@delete');
Route::get('entregable/{entregable}/Descargar', 'EntregableController@descargar');



//PRofesorGuia
Route::get('/indexProfesorGuia', 'ProfesorGuiaController@index');
Route::get('profesorguia/estudiantes', 'ProfesorGuiaController@estudiantes');
Route::get('profesorguia/proyecto/create', 'ProyectoController@create');
Route::post('proyecto', 'ProyectoController@store'); 

//Repositorio
Route::get('indexRepositorio','RepositorioController@index');