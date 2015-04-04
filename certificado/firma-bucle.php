<?php
session_start();
	$_SESSION['_token'] = $_POST['_token'];
	$tam = $_POST['tam'];
	$documantos = null;
	for ($i=0; $i < $tam; $i++) { 
		$aux = 'pdf'.$i;
		$documentos[$i] = $_POST[$aux];
		// echo $documentos[$i].'<br />';
	}
	// var_dump($documantos);
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
	    
		$id_firmas = "";
		foreach ($documentos as $key => $documento) {
			//Lectura del PDF
			// echo $documento;
			$filename = $documento;
			$file = fopen($filename, 'r');
			$datos = fread($file, filesize($filename));
			fclose($file);

			// echo $_POST['location'];
			// echo $datos;

			// Creamos documento
			$pfd_name = split('anular/', $documento);
			// echo $pfd_name[1];
			$id_firma = $viafirmaClient->prepareFirmaWithTypeFileAndFormatSign("prueba.pdf", $datos, MimeType::$PDF, SignatureType::$XADES);
			// echo $id_firma;
			$id_firmas .= $id_firma;
			if($key < $tam-1){
				$id_firmas .= ';';
			}
			 // echo $id_firmas;
		}
	    
	    // echo $id_firmas;
	    $viafirmaClient->solicitarFirmasIndependientes($id_firmas,"http://localhost/certificado/firmaResponse.php");

	    //Subimos el documento
		// $idFirma = $viafirmaClient->prepareFirmaWithTypeFileAndFormatSign("prueba.txt",
		// MimeType::$BINARY, $datos, SignatureType::$XADES);
		// Url de retorno a la aplicacion (tras el proceso de firma) 
		// $viafirmaClient->solicitarFirma($idFirma,"http://localhost/certificado/authResponse.php");
	    
	    // 4) Invocación de método concreto
		// $viafirmaClient->solicitarAutenticacion("http://localhost/certificado/authResponse.php");

	}catch(Exception $exception){

		echo "<pre>".$exception."</pre>";

	}
	
	// echo $_SESSION['token'];

	// session_destroy();
?>