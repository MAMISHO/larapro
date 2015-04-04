<?php
	/**
	* Ejemplo de integración con Viafirma.
	* @version viafirma-client-php 1.0
	*/
	 if ($_GET["QRB"] == true) {
		header("Content-type:image/png");
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
			$imagen = $viafirmaClient->buildInfoQRBarCode($idFirma);
			$imagen=base64_decode($imagen);
			print $imagen;
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
				<h2>Metodos de utilidad</h2>
				
				<div class="group">
					<div class="col width-58 append-02">
						<div class="box">
							<h3 class="box-title">Generar Resguardo con QRBarCode</h3>
							<div class="box-content">
								<p>En este ejemplo se realiza la firma de un documento y se recupera el resguardo de la firma con codigo de seguimiento QR.</p>
								<p>
									<a class="button" target=_blank href="?QRB=true">Generar resguardo QRB</a>
								</p>
							</div>
						</div>
					</div>
					
					<div class="col width-40">
						<div class="box">
							<h3 class="box-title">Métodos utilizados</h3>
							<div class="box-content">
								<ul>
									<li><code>signByServerWithTypeFileAndFormatSign</code></li>
									<li><code>buildInfoQRBarCode</code></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<p><a href="./">&larr; Volver</a></p>
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