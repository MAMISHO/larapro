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
		
        $idFirma=$viafirmaClient->prepareFirmaWithTypeFileAndFormatSign("prueba.txt",MimeType::$XML,"datos de prueba",SignatureType::$XADES);
		// Url de retorno a la aplicación (tras el proceso de firma)
		$viafirmaClient->solicitarFirma($idFirma,$VIAFIRMA_RETURN_TO_URL);
	}catch(Exception $exception){
		echo "<pre>".$exception."</pre>";
	}
?>


