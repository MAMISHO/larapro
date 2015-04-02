<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', 'WelcomeController@index');
Route::get('/', 'PrincipalController@index');

Route::get('/home', 'HomeController@index');
Route::get('/home/mis/examenes', 'HomeController@misExamenes');
Route::post('/home/examen', 'HomeController@nuevoExamen');
Route::post('/home/examen/calificar', 'HomeController@calificarExamen');
Route::get('/crear/examen', 'HomeController@crearExamen');
Route::post('/crear/nuevo/examen', 'HomeController@crearNuevoExamen');

//certificado digital
Route::get('/cerfificado', 'CertificadoController@index');
Route::post('/home/examen/firmado', 'CertificadoController@examenFirmado');
Route::post('/home/documento', 'CertificadoController@obtenerDocumento');


Route::get('/alumno', 'HomeController@examenesAlumno');//ver examenes del alumno
Route::get('/examen', 'HomeController@alumnosExamen');//ver alumnos del examen
// Route::post('/home/examen', array('before' => 'csrf', function()
// {
//     return 'You gave a valid CSRF token!';
// }));

Route::get('/tablaClaves/descargar', 'TablaClavesController@descargar');

Route::get('/tablaClaves/ver', 'TablaClavesController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
