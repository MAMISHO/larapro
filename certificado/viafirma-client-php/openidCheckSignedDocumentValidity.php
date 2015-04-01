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
				<h2>Comprobación de validez de firma en un documento</h2>
				
				<div class="group">
					<div class="col width-58 append-02">
						<div class="box">
							<h3 class="box-title">Validar firma</h3>
							
							<div class="box-content">
								<p>En este ejemplo se realiza la firma de un documento y se recupera el documento custodiado para posteriormente comprobar que la firma es valida.</p>
							
								<p><a class="button" href="?valido=true">Firma valida</a> <a class="button" href="?noValido=true">Firma NO valida</a></p>
							</div>
						</div>
					</div>
						
					<div class="col width-40">
						<div class="box">
							<h3 class="box-title">Métodos utilizados</h3>
							<div class="box-content">
								<ul>
									<li><code>signByServerWithTypeFileAndFormatSign</code></li>
									<li><code>getDocumentoCustodiado</code></li>
									<li><code>checkSignedDocumentValidity</code></li>
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
	if ($_GET["valido"] == true) {
		try {
			include_once("viafirma/includes.php");
	        // URL en la que se encuentra el servicio de Viafirma y url pública de la aplicación 
			ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL);
			$viafirmaClient = ViafirmaClientFactory::getInstance();
			//$viafirmaClient->printConfig();
			
			$filename = "resource/exampleSign.pdf";
			$file = fopen($filename, 'r');
			$datos = fread($file, filesize($filename));
			fclose($file);
			
			//Subimos el documento
			$idFirma = $viafirmaClient->signByServerWithTypeFileAndFormatSign("documentoFirmado.pdf",MimeType::$PDF,$datos,SignatureType::$PDF_PKCS7,$certAlias,$certPass);
			$datosFirmados = $viafirmaClient->getDocumentoCustodiado($idFirma);
			$info = $viafirmaClient->checkSignedDocumentValidityByFileType($datosFirmados, SignatureType::$PDF_PKCS7);
			
			echo "<div class=\"box\"> <h2 class=\"box-title\">Ejemplo</h2> <div class=\"box-content\">";
			echo "<strong>Id de firma:</strong>$idFirma<br/>";
			echo '<p><strong>¿Esta el documento firmado? </strong>';
			echo $info->FirmaInfoViafirma->signed?"Documento firmado":"Documento NO firmado";
			echo "<br/><strong>¿Es la firma valida?: </strong>";
			echo $info->FirmaInfoViafirma->valid?"Documento valido":"Documento NO valido";
			echo '<br/><strong>firstName </strong>'.$info->FirmaInfoViafirma->firstName;
			echo '<br/><strong>lastName </strong>'.$info->FirmaInfoViafirma->lastName;
			echo '<br/><strong>numberUserId </strong>'.$info->FirmaInfoViafirma->numberUserId;
			echo '<br/><strong>email </strong>'.$info->FirmaInfoViafirma->email;
			echo '<br/><strong>typeCertificate </strong>'.$info->FirmaInfoViafirma->typeCertificate;
			echo '<br/><strong>typeLegal </strong>'.$info->FirmaInfoViafirma->typeLegal;
			echo '<br/><strong>caName </strong>'.$info->FirmaInfoViafirma->caName;
			echo '<br/><strong>properties </strong>'.$info->FirmaInfoViafirma->properties;
			echo '<br/><strong>signTimeStamp </strong>'.$info->FirmaInfoViafirma->signTimeStamp;
			echo '<br/><strong>message </strong>'.$info->FirmaInfoViafirma->message;
			echo '<br/><strong>otherSigners </strong>'.$info->FirmaInfoViafirma->otherSigners;
			echo "</p></div></div>";
		}catch(Exception $exception){
			echo "<pre>".$exception."</pre>";
		}
	}
	
	if ($_GET["noValido"] == true) {
		try {
			include_once("viafirma/includes.php");
	        // URL en la que se encuentra el servicio de Viafirma y url pública de la aplicación 
			ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL);
			$viafirmaClient = ViafirmaClientFactory::getInstance();
			//$viafirmaClient->printConfig();
			
			$filename = "resource/exampleSign.pdf";
			$file = fopen($filename, 'r');
			$datos = fread($file, filesize($filename));
			fclose($file);
			
			//Subimos el documento
			$idFirma = $viafirmaClient->signByServerWithTypeFileAndFormatSign("documentoFirmado.pdf",MimeType::$PDF,$datos,SignatureType::$PDF_PKCS7,$certAlias,$certPass);
			$datosFirmados = $viafirmaClient->getDocumentoCustodiado($idFirma);
			//Comprobamos el mismo documento pero sin firmar 
			$info = $viafirmaClient->checkSignedDocumentValidityByFileType($datos, SignatureType::$PDF_PKCS7);
			echo "<div class=\"box\"> <h2 class=\"box-title\">Ejemplo</h2> <div class=\"box-content\">";
			echo "<strong>Id de firma:</strong>$idFirma<br/>";
			echo '<p><strong>¿Esta el documento firmado? </strong>';
			echo $info->FirmaInfoViafirma->signed?"Documento firmado":"Documento NO firmado";
			echo "<br/><strong>¿Es la firma valida?: </strong>";
			echo $info->FirmaInfoViafirma->valid?"Documento valido":"Documento NO valido";
			echo "</p></div></div>";
			}catch(Exception $exception){
			echo "<pre>".$exception."</pre>";
		}
	}
?>
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