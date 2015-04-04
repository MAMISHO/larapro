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
				<h2>Sellado de Tiempo sin intervención del usuario</h2>
				<div class="group">
					<div class="col width-58 append-02">
						<div class="box">
							<h3 class="box-title">Firma XML</h3>
							<div class="box-content">
									<p> Este ejemplo, genera un sello de tiempo en crudo para el conjunto de datos indicado.<br>
								<p class="button">
									<a href="?tsa=true">Generar TSA para datos de ejemplo</a>
								</p>
							</div>
						</div>
					</div>
					<div class="col width-40">
						<div class="box">
							<h3 class="box-title">Métodos utilizados</h3>
							<div class="box-content">
								<ul>
									<li>tsaRequest</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<?php
					error_reporting (5); 
					/**
					* Ejemplo de integración con Viafirma.
					* @version viafirma-client-php 1.0
					*/
					if ($_GET["tsa"] == true) {
						try {
							include_once("viafirma/includes.php");
					        // URL en la que se encuentra el servicio de Viafirma y url pública de la aplicación 
							ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL);
							$viafirmaClient = ViafirmaClientFactory::getInstance();
							//$viafirmaClient->printConfig();
							
							// Recuperamos los datos a sellar
							$filename = "resource/prueba.xml";
							$file = fopen($filename, 'r');
							$datos = fread($file, filesize($filename));
							fclose($file);
							
							//Subimos el documento
							$tsaResponse = $viafirmaClient->tsaRequest($datos);
							echo "<div class=\"box\"> <h2 class=\"box-title\">Resultado</h2> <div class=\"box-content\">";
							echo "<p>";
							echo base64_encode($tsaResponse);
							echo "</p>";
							echo "</div></div>";
						}catch(Exception $exception){
							echo "<pre>".$exception."</pre>";
						}
					}
				?>
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