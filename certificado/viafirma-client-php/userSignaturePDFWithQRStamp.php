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
				<h2>Firmas con intervencion del usuario</h2>
				
				<div class="group">
					<div class="col width-58 append-02">
						<div class="box">
							<h3 class="box-title"">Firma PDF</h3>
							
							<div class="box-content">
								<p>En este ejemplo se realiza la firma de un documento PDF con formato PADES_BASIC con sello de firma utilizando código QR.</p>
								
								<p>
									<a class="button" href="?firmarPDF=true">Firma de PDF con sello QR</a>
								</p>
							</div>
						</div>
					</div>
					
					<div class="col width-40">
						<div class="box">
							<h3 class="box-title">Métodos utilizados</h3>
							<div class="box-content">
								<ul>
									<li><code>prepareSignWithPolicy</code></li>
									<li><code>Parámetros de Policy:</code></li>
									<ul style="margin-left:25px;">
										<li><code>DIGITAL_SIGN_PAGE</code></li>
										<li><code>DIGITAL_SIGN_RECTANGLE</code></li>
										<li><code>DIGITAL_SIGN_STAMPER_HIDE_STATUS</code></li>
										<li><code>DIGITAL_SIGN_STAMPER_TEXT</code></li>
										<li><code>DIGITAL_SIGN_STAMPER_TYPE</code></li>
									</ul>									
									<li><code>solicitarFirma</code></li>
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
					if ($_GET["firmarPDF"] == true) {
						try {
							include_once("viafirma/includes.php");
					        // Inicializamos cliente con URL en la que se encuentra el servicio de Viafirma y url pública de la aplicación 
							ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL);
							$viafirmaClient = ViafirmaClientFactory::getInstance();
							
							//Obtenemos el fichero a firmar (en este ejemplo se utiliza uno obtenido de la carpeta resource)
							$filename = "resource/exampleSign.pdf";
							$file = fopen($filename, 'r');
							$datos = fread($file, filesize($filename));
							fclose($file);
	
							//Creamos documento		
							$documento = Document::newDocument("test.pdf",$datos,MimeType::$PDF,SignatureType::$PADES_BASIC);
	
							//Creamos el objeto Policy
							$policy = Policy::newPolicy();
							//Indica el tipo de firma (para firmas PDF se usa siempre ATTACHED)
							$policy->typeSign = TypeSign::$ATTACHED;
							//Indica el formato (en este caso digitalizada)
							$policy->typeFormatSign = SignatureType::$PADES_BASIC;
							
//--------------------------------  Inicio - Policy con Imagen
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
							$viafirmaClient->solicitarFirma($idtemporal,$VIAFIRMA_RETURN_TO_URL);			
							

							echo "<div class=\"box\"> <h2 class=\"box-title\">Ejemplo</h2> <div class=\"box-content\">";
							echo "<p><strong>Tipo de firma: </strong>PDF Signature<br/>";
							echo "<strong>Id de firma:</strong>$idFirma<br/></p>";
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