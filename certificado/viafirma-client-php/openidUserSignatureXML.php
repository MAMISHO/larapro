<?php
	error_reporting (5); 
	/**
	* Ejecemplo de integración con Viafirma.
	* @version viafirma-client-php 1.0
	*/
	if ($_GET["firmarXML"] == true) {
		try {
			include_once("./viafirma/includes.php");
	        // URL en la que se encuentra el servicio de Viafirma y url pública de la aplicación 
			ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL);
			$viafirmaClient = ViafirmaClientFactory::getInstance();
			//$viafirmaClient->printConfig();
	
			// Cargamos el archivo
			$filename = "resource/prueba.xml";
			$file = fopen($filename, 'r');
			$datos = fread($file, filesize($filename));
			fclose($file);
			
			// Subimos el documento a viafirma
	        $idFirma=$viafirmaClient->prepareFirmaWithTypeFileAndFormatSign("pruebaFirma.xml",MimeType::$XML,$datos,SignatureType::$XADES);
			// Url de retorno a la aplicación (tras el proceso de firma)
			$viafirmaClient->solicitarFirma($idFirma,$VIAFIRMA_RETURN_TO_URL);
		}catch(Exception $exception){
			echo "<pre>".$exception."</pre>";
		}
		
		}else if ($_GET["firmarXMLDSIG"] == true) {
		try {
			include_once("./viafirma/includes.php");
	        // URL en la que se encuentra el servicio de Viafirma y url pública de la aplicación 
			ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL);
			$viafirmaClient = ViafirmaClientFactory::getInstance();
			//$viafirmaClient->printConfig();
	
			// Cargamos el archivo
			$filename = "resource/prueba2.xml";
			$file = fopen($filename, 'r');
			$datos = fread($file, filesize($filename));
			fclose($file);
			
			//Creamos documento		
			$documento = Document::newDocument("test.xml",$datos,'text/XML','XMLDSIG');
	
			//Creamos el objeto Policy
			$policy = Policy::newPolicy();
			//Indica el tipo de firma (para firmas PDF se usa siempre ATTACHED)
			$policy->typeSign = TypeSign::$DETACHED;
			//Indica el formato (en este caso digitalizada)
			$policy->typeFormatSign = 'XMLDSIG';
			//Añadimos parametro de la referencia al fichero firmado
			$policy->addParameter(PolicyParams::$DETACHED_REFERENCE_URL, "http://viafirma.com/download/prueba2.xml");
			
			// Preparamos la firma
			$idFirma = $viafirmaClient->prepareSignWithPolicy($policy,$documento);	        
			// Url de retorno a la aplicación (tras el proceso de firma)
			$viafirmaClient->solicitarFirma($idFirma,$VIAFIRMA_RETURN_TO_URL);
		}catch(Exception $exception){
			echo "<pre>".$exception."</pre>";
		}
	}else{
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Viafirma - Kit para desarrolladores</title>
		
		<link rel="stylesheet" href="css/framework.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
	</head>
	<body>
		<div id="wrapper">
			<h1 id="header"><a href="./"><img src="images/content/logo.png" alt="Viafirma" /></a></h1>
			
			<div id="content">
				<h2>Firmas con intervención del usuario</h2>
				
				<div class="group">
					<div class="col width-53 append-02">
						<div class="box">
							<h3 class="box-title">Firma XML</h3>
							<div class="box-content">
								<p>En este ejemplo se realiza la firma de un documento XML con formato XAdES en Viafirma con la intervención directa del usuario.</p>
								
								<p>
									<a class="button" href="?firmarXML=true">Firmar documento XML en formato XAdES</a><br/><br/>
									<a class="button" href="?firmarXMLDSIG=true">Firmar documento XML en formato XMLDSIG</a>
								</p>
							</div>
						</div>
					</div>
					
					<div class="col width-45">
						<div class="box">
							<h3 class="box-title">Métodos utilizados</h3>
							<div class="box-content">
								<ul>
									<li><code>prepareFirmaWithTypeFileAndFormatSign</code></li>
									<li><code>solicitarFirma</code></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<p>
					<a href="signatureUser.php">&larr; Volver</a>
				</p>
			</div>
			<div id="footer">
				<p class="left">
					Acceda a <a href="http://www.viafirma.com">Viafirma</a> o consulte más información técnica en <a href="http://developers.viafirma.com/">Viafirma Developers</a> 
				</p>
				<p>
					<small>Version 0.php</small>
				</p>
			</div>
		</div>
	</body>
</html>

<?php }?>