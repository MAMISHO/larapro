<?php
	error_reporting (5); 
	/**
	* Ejemplo de integración con Viafirma.
	* @version viafirma-client-php 1.0
	*/
	if ($_GET["firmarPDF"] == true) {
		try {
			include_once("viafirma/includes.php");
	        // URL en la que se encuentra el servicio de Viafirma y url pública de la aplicación 
			ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL);
			$viafirmaClient = ViafirmaClientFactory::getInstance();
			//$viafirmaClient->printConfig();
			
			// Cargamos el archivo
			$filename = "resource/exampleSign.pdf";
			$file = fopen($filename, 'r');
			$datos = fread($file, filesize($filename));
			fclose($file);

			//Subimos el documento al servidor
			$idFirma=$viafirmaClient->prepareFirmaWithTypeFileAndFormatSign("exampleSign.pdf",MimeType::$PDF,$datos,SignatureType::$PDF_PKCS7);
			
			//Iniciamos el proceso de firma
			//Url de retorno a la aplicación (tras el proceso de firma)
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
					<div class="col width-43 append-02">
						<div class="box">
							<h3 class="box-title">Firma PDF</h3>
							
							<div class="box-content">
								<p>En este ejemplo se realiza la firma de un documento PDF con formato PDF Signature en Viafirma con la intervención directa del usuario.</p>
							
								<p>
									<a class="button" href="?firmarPDF=true">Firma de PDF en formato PDF Signature</a>
								</p>
							</div>
						</div>
					</div>
					
					<div class="col width-55">
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
					<a href="./signatureUser.php">&larr; Volver</a>
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
