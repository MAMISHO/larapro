<?php
session_start();
	$_SESSION['_token'] = $_POST['_token'];
	$_SESSION['convocatoria'] = $_POST['convocatoria'];
	$_SESSION['location'] = $_POST['location'];
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
	    

	    //Lectura del PDF
		$filename = $_POST['location'];
		$file = fopen($filename, 'r');
		$datos = fread($file, filesize($filename));
		fclose($file);

		// echo $_POST['location'];
		// echo $datos;

		//Creamos documento
		$pfd_name = split('/pdfs', $_POST['location']);
		$documento = Document::newDocument('fichero.pdf', $datos, MimeType::$PDF, SignatureType::$PADES_BASIC);
		

		//Creamos el objeto Policy
		$policy = Policy::newPolicy();
		//Indica el tipo de firma (para firmas PDF se usa siempre ATTACHED)
		$policy->typeSign = TypeSign::$ATTACHED;
		//Indica el formato (en este caso digitalizada)
		$policy->typeFormatSign = SignatureType::$PADES_BASIC;


	//-------------------------------  Inicio - Policy con Imagen
		//Rectangle justo en el final de la página
		$rectangle = new Rectangle(40,10,75,550);
		$datosRectangle = $rectangle->getDatosRectangle();
	        
	        //Creamos policy
		//Pagina donde se insertará el sello, -1 para elegir la última página
		$policy->addParameter(PolicyParams::$DIGITAL_SIGN_PAGE, "1");
		//Rectangle donde colocar el sello
		$policy->addParameter(PolicyParams::$DIGITAL_SIGN_RECTANGLE, $datosRectangle);
		
	        //Indica a Adobe reader que debe esconder la imagen de validación (la marca verde, naranja o roja sobre la imagen de sello)
	        $policy->addParameter(PolicyParams::$DIGITAL_SIGN_STAMPER_HIDE_STATUS, "true");
		//Opcional, texto que aparecerá en el sello. Por defecto aparece: Digitally signed by: [CN]
		$policy->addParameter(PolicyParams::$DIGITAL_SIGN_STAMPER_TEXT, "Firmado por [CN] con DNI [SERIALNUMBER] trabajador de [O] en el departamento de [OU]");
		
	        //Tipo del sello. "QR-BAR-H" para tipo QRCode
		$policy->addParameter(PolicyParams::$DIGITAL_SIGN_STAMPER_TYPE, "QR-BAR-H");

	//--------------------------------  Fin - Policy con Imagen


		//firmamos el documento			
	$idtemporal = $viafirmaClient->prepareSignWithPolicy($policy,$documento);
	$_SESSION['idtemporal'] = $idtemporal;
	$viafirmaClient->solicitarFirma($idtemporal,"http://localhost/certificado/authResponse.php");

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