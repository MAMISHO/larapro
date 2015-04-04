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
				<h2>Firmas sin intervencion del usuario</h2>
				
				<div class="group">
					<div class="col width-58 append-02">
						<div class="box">
							<h3 class="box-title"">Firma PDF</h3>
							
							<div class="box-content">
								<p>En este ejemplo se realiza la firma de un documento PDF con formato PDF Signature en el servidor sin la intervencion directa del usuario.</p>
								<p>Para su correcto funcionamiento el certificado debe estar instalado en el servidor.</p>
								
								<p>
									<a class="button" href="?firmarPDF=true">Firma de PDF en servidor usando el objeto Policy</a>
								</p>
							</div>
						</div>
					</div>
					
					<div class="col width-40">
						<div class="box">
							<h3 class="box-title">Métodos utilizados</h3>
							<div class="box-content">
								<ul>
									<li><code>signByServerWithPolicy</code></li>
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
							$documento = Document::newDocument("test.pdf",$datos,MimeType::$PDF,SignatureType::$PDF_PKCS7);
	
							//Creamos el objeto Policy
							$policy = Policy::newPolicy();
							//Indica el tipo de firma (para firmas PDF se usa siempre ATTACHED)
							$policy->typeSign = TypeSign::$ATTACHED;
							//Indica el formato (en este caso digitalizada)
							$policy->typeFormatSign = SignatureType::$PDF_PKCS7;
							
							
//--------------------------------  Inicio - Policy con Imagen
							//Creamos rectangulo
							$rectangle = new Rectangle(120,50,150,300);
							$datosRectangle = $rectangle->getDatosRectangle();
        
							//Creamos imagen
							$filenameImage = "resource/stamp.png";
							$fileImage = fopen($filenameImage, 'r');
							$datosImage = fread($fileImage, filesize($filenameImage));
							fclose($fileImage);
							
							$b64DatosImage = base64_encode($datosImage);
							//Lo agregamos al policy
							$policy->addParameter(PolicyParams::$DIGITAL_SIGN_IMAGE_STAMPER, urlencode($b64DatosImage);
							$policy->addParameter(PolicyParams::$DIGITAL_SIGN_PAGE, -1);
							$policy->addParameter(PolicyParams::$DIGITAL_SIGN_RECTANGLE, $datosRectangle);
//--------------------------------  Fin - Policy con Imagen
							

							//firmamos el documento							
							$idFirma = $viafirmaClient->signByServerWithPolicy($policy,$documento,$certAlias,$certPass);
							

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