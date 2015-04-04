<?php
	/**
	* Ejecemplo de integración con Viafirma.
	* @version viafirma-client-php 1.0
	*/
	try {
		include_once("./viafirma/includes.php");
        // URL en la que se encuentra el servicio de Viafirma y url pública de la aplicación 
		ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL);
		$viafirmaClient = ViafirmaClientFactory::getInstance();
		//$viafirmaClient->printConfig();
		//Subimos el documento
		
		$filename = "exampleSign.pdf";
		$file = fopen($filename, 'r');
		$datos = fread($file, filesize($filename));
		fclose($file);
		
		 $idFirma=$viafirmaClient->prepareFirmaWithTypeFileAndFormatSign("exampleSign.pdf",MimeType::$PDF,$datos,SignatureType::$PDF_PKCS7);
		// Url de retorno a la aplicación (tras el proceso de firma)
		$viafirmaClient->solicitarFirma($idFirma,$VIAFIRMA_RETURN_TO_URL);
	}catch(Exception $exception){
		echo "<pre>".$exception."</pre>";
	}
?>


