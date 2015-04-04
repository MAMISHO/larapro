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
		
		$pemname = "resource/xnoccio.pem";
		$fpem = fopen($pemname, 'r');
		$pem = fread($fpem, filesize($pemname));
		fclose($fpem);
		
		//Creamos document		
		$doc = Document::newDocument("test.pdf",$datos,MimeType::$PDF,SignatureType::$DIGITALIZED_SIGN);
		
		//Creamos Policy
		$policy = Policy::newPolicy();
		$policy->typeSign = TypeSign::$ATTACHED;
		//Indica el formato (en este caso digitalizada)
		$policy->typeFormatSign = SignatureType::$DIGITALIZED_SIGN;
		//Indica el color de fondo de la pantalla
//		$policy->addParameter(PolicyParams::$DIGITALIZED_SIGN_BACK_COLOUR, "#0000FF");
		//Indica el color de la firma de la pantalla
		$policy->addParameter(PolicyParams::$DIGITALIZED_SIGN_COLOUR, "#FF0000");
		//Indica el texto de ayuda que aparece en la pantalla 
		$policy->addParameter(PolicyParams::$DIGITALIZED_SIGN_HELP_TEXT, "Texto de ayuda aportado por el integrador");
		//Logo a mostrar
//		$policy->addParameter(PolicyParams::$DIGITALIZED_SIGN_LOGO, logoStamp);
		//Rectangulo donde se fija la firma
		$policy->addParameter(PolicyParams::$DIGITALIZED_SIGN_RECTANGLE, new Rectangle(400,60,160,120));
		//Biometric alias - pass son utilizados para firmar los datos biometricos en servidor (el alias debe existir en el servidor) 
		$policy->addParameter(PolicyParams::$DIGITALIZED_SIGN_BIOMETRIC_ALIAS, "xnoccio");
	    $policy->addParameter(PolicyParams::$DIGITALIZED_SIGN_BIOMETRIC_PASS, "12345");
		$policy->addParameter(PolicyParams::$DIGITALIZED_SIGN_ALIAS, "xnoccio");
	    $policy->addParameter(PolicyParams::$DIGITALIZED_SIGN_PASS, "12345");
	    //Clave publica en formato pem con la que cifrar los datos biometricos, si no se indica no se cifran
	    $policy->addParameter(PolicyParams::$DIGITALIZED_SIGN_BIOMETRIC_CRYPTO_PEM, $pem);
	    //Pagina donde insertar la firma, -1 para la ultima pagina, si no se indica, en iOS se permitirá seleccionar la pagina/s manualmente, en Topaz se pondrá en la última página
	    $policy->addParameter(PolicyParams::$DIGITALIZED_SIGN_PAGE, -1); 

		//Preparamos la firma
		$idFirma=$viafirmaClient->prepareSignWithPolicy($policy,$doc);
		//$idFirma=$viafirmaClient->prepareSignWithPolicy("exampleSign.pdf",MimeType::$PDF,$datos,SignatureType::$DIGITALIZED_SIGN);
		
		//Solicitamos dicha firma
		$viafirmaClient->solicitarFirma($idFirma,$VIAFIRMA_RETURN_TO_URL);
	}catch(Exception $exception){
		echo "<pre>".$exception."</pre>";
	}
?>


