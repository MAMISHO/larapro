<?php namespace App\Http\Controllers;

class CertificadoController extends Controller {

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
		// $this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
			// try {

			//     // 1) Importación de clases necesarias
			//     $APPLICATION_URL="http://localhost/larapro/public/certificado";
			//     // dd($APPLICATION_URL);
			// 	// include_once("viafirma/includes.php");
			// 	include_once($APPLICATION_URL."viafirma/includes.php");
			    
			//     // 2) Inicialización del cliente, indicando la Url de su aplicación como parámetro
			//     dd($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL, $appId, $appPassword);
			// 	ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest",
			// 		"http://localhost/larapro/public/certificado/", $appId, $appPassword);
			    
			//     // 3) Obtener instancia del Cliente de Viafirma
			// 	$viafirmaClient = ViafirmaClientFactory::getInstance();
			    
			//     // 4) Invocación de método concreto
			// 	$viafirmaClient->metodoConcreto(xxxxx);

			// }catch(Exception $exception){

			// 	echo "<pre>".$exception."</pre>";

			// }
		return redirect('/larapro/public/');
	}

}