<?php
	error_reporting (5); 
	/**
	* Ejemplo de integración con Viafirma.
	* @version viafirma-client-php 1.0
	*/
	if ($_GET["firmarPrev"] == true) {
		try {
			include_once("viafirma/includes.php");
	        // URL en la que se encuentra el servicio de Viafirma y url pública de la aplicación 
			ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL);
			$viafirmaClient = ViafirmaClientFactory::getInstance();
			//$viafirmaClient->printConfig();
			
			$filename = "resource/prueba.xml";
			$file = fopen($filename, 'r');
			$datos = fread($file, filesize($filename));
			fclose($file);
			
			//Subimos el documento
			$idFirma = $viafirmaClient->signByServerWithTypeFileAndFormatSign("documentoFirmado.xml",MimeType::$XML,$datos,SignatureType::$XADES,$certAlias,$certPass);
			$viafirmaClient->signPreviousSignature($idFirma,$VIAFIRMA_RETURN_TO_URL);
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
			<h1 id="header"><a href="."><img src="images/content/logo.png" alt="Viafirma" /></a></h1>
			
			<div id="content">
				<h2>Firmas con intervención del usuario</h2>
				<div class="group">
					<div class="col width-58 append-02">
						<div class="box">
							<h3 class="box-title">Firma XML previamente firmado</h3>
							<div class="box-content">
								<p><p>En este ejemplo, se vuelve a firmar un documento XML con formato XAdES en Viafirma con la intervención directa del usuario.</p>
								<p>Para su correcto funcionamiento el certificado debe estar instalado en el servidor.</p>
								
								<p>
									<a class="button" href="?firmarPrev=true">Iniciar firma de documento XML con formato XAdES</a>
								</p>
							</div>
						</div>
					</div>
					<div class="col width-40">
						<div class="box">
							<h3 class="box-title">Métodos utilizados</h3>
							<div class="box-content">
								<ul>
									<li>signByServerWithTypeFileAndFormatSign</li>
									<li>signPreviousSignature</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<p>
					<a href="./signatureServer.php">&larr; Volver</a>
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