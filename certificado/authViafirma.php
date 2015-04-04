<?php
session_start();
	$_SESSION['token'] = $_GET['token'];
	try {

	    // 1) Importación de clases necesarias
		include_once("./viafirma/includes.php");
	    
	    // 2) Inicialización del cliente, indicando la Url de su aplicación como parámetro
	    // echo $appId;
	    // dd($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL, $appId, $appPassword);
		ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest",
			"http://localhost/certificado/", $appId, $appPassword);
	    
	    // 3) Obtener instancia del Cliente de Viafirma
		$viafirmaClient = ViafirmaClientFactory::getInstance();
	    
	    // 4) Invocación de método concreto
		$viafirmaClient->solicitarAutenticacion("http://localhost/certificado/authResponse.php");

	}catch(Exception $exception){

		echo "<pre>".$exception."</pre>";

	}
	
	// echo $_SESSION['token'];

	// session_destroy();
?>