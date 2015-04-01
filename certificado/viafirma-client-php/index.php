<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php include_once("viafirma/config/config.inc.php"); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Viafirma - Kit para desarrolladores</title>
		
		<link rel="stylesheet" href="css/framework.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
	</head>
	<body>
		<div id="wrapper">
			<h1 id="header"><a href="."><img src="images/content/logo.png" alt="Viafirma" /></a></h1>
			
			<div id="content">
				<p class="message">La aplicación de ejemplo está actualmente configurada para utilizar el servicio<br /><strong><?php echo $VIAFIRMA_SERVICE_URL ?></strong></p>
			<div class="group">
					<div class="col width-49 append-01">
						<div class="box">
							<h2 class="box-title">Autenticación</h2>
							
							<div class="box-content">
								<ul>
									<li><a href="openidLogin.php" title="Autenticar al usuario con Viafirma">Autenticar al usuario con Viafirma</a></li>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="col width-49 prepend-01">
						<div class="box">
							<h2 class="box-title">Firma</h2>
							
							<div class="box-content">
								<ul>
									<li><a href="signatureUser.php" title="Firmar documento con intervencion del usuario">Firmar documento con intervenci&oacute;n del usuario</a></li>
									<li><a href="signatureServer.php" title="Firmar documento sin intervencion del usuario">Firmar documento sin intervenci&oacute;n del usuario</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="box">
					<h2 class="box-title">Métodos de utilidad</h2>
					
					<div class="box-content">
						<ul>
							<li><a href="openidBulidInfoQRBarCode.php" title="Resguardo de seguimiento QR">Generar resguardo de seguimiento con codigo QR</a></li>
							<li><a href="openidCheckSignedDocumentValidity.php" title="Comprobar validez de firma">Comprobar la validez de una firma</a></li>
							<li><a href="openidDocumentoCustodiado.php" title="Recuperar documento custodiado">Recuperar documento custodiado</a></li>
<!--							<li><a href="test.php" title="Ejemplos del API">Ejemplos del API</a></li>-->
						</ul>
					</div>
				</div>
				
				<div class="box">
					
					
					<div class="box-content">
						<p style='font-size:x-small; text-align:justify;'><strong style='font-size:small;'>NOTA:</strong> En este ejemplo se utliza la clase <code>ViafirmaClientFactory.class.php</code> como factoria para facilitar
			 la llamada a los métodos que ofrece el API REST de Viafirma. En ella se encuentran las distintas funcionalidades necesarias para la firma y autenticación en cualquier aplicación q se integre con Viafirma.</p>
					</div>
				</div>
			</div>
			<div id="footer">
				<p class="left">
					Acceda a <a href="http://www.viafirma.com">Viafirma</a> o consulte más información técnica en <a href="http://developers.viafirma.com/">Viafirma Developers</a> 
				</p>
				<p>
					<small>Version Kit <?php echo $VIAFIRMA_CLIENT_VERSION ?></small>
				</p>
			</div>
		</div>



<!--<p id="pie">2010 Viafirma.-->
<!--vers�n Client: <strong><php echo $VIAFIRMA_CLIENT_VERSION ?></strong><br/>-->

<!--Path OpenId FileStore: <php echo $pathTemporalOpenIDFileStore ?><br/>-->
<!--OpenId Rand Source: <php echo $authOpenIDRandSource ?><br/>-->
<!--App Id: <php echo $appId ?><br/>-->
<!--Proxy : <php echo $proxyHost ?><br/>-->
<!--Proxy Port: <php echo $proxyPort ?><br/>-->
<!--Ccul Enable: <php echo function_exists('curl_init')==true?"Yes":"false"; ?><br/>-->
<!-- <php -->

<!--if (version_compare(phpVersion(), '5.3.0') >= 0) {-->
<!--    echo '<strong>La version php no es compatible con el cliente Viafirma, rango compatible: 5.0.0-5.3.0</strong>:  ';-->
<!--}else{-->
<!--   echo '<strong>Versi�n php compatible</strong>: ';-->
<!--}-->
<!-- ?>-->
<!--<php echo phpVersion() ?><br/>-->
<!--</p>-->
</body>
</html>