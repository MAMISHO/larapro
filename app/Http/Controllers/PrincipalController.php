<?php namespace App\Http\Controllers;

class PrincipalController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Principal Controller
	|--------------------------------------------------------------------------
	|
	| Este controlador tiene el flujo principal del modelo de negocio
	| y las vistas
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('principal');
	}

}