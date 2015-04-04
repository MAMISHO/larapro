<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php include_once("viafirma/config/config.inc.php"); ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Ejemplo</title>
	<style type="text/css" media="screen">
		@import url('css/screen.css');
	</style>
	
	<!--[if IE]>
		<link rel="stylesheet" href="css/stylesIE.css" type="text/css" media="screen" />
	<![endif]-->
	
	<!--[if lte IE 6]>
		<link rel="stylesheet" href="css/stylesIE6.css" type="text/css" media="screen" />
	<![endif]-->
	
	<!--[if gte IE 7]>
		<link rel="stylesheet" href="css/stylesIE7.css" type="text/css" media="screen" />
	<![endif]-->
</head>
<body>
<div id="global">
		<div id="cabecera">
			<h1>Ejemplo</h1>
		</div>
		<div id="cuerpo">
			<h2>Ejemplo de pruebas con PHP</h2>
			<form id="form1" action="testAction.php" method="get">
			<p>
				ID:<input type="text" name="id" />
			</p>
<?php 
			include_once("viafirma/includes.php");
			ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL);
			$viafirmaClient = ViafirmaClientFactory::getInstance();
			
			echo "1 ".$viafirmaClient->getMaxSizeDocument();

			echo "<br/><br/>$maxSizeMegabytes<br/><br/>";
			
			$viafirmaClient->setMaxSizeMbDocument(10);
			
			echo "2 ".$viafirmaClient->getMaxSizeDocument();
			?>
			<p>
<!--				<label><input type="radio" name="prueba" value="FirmaServidor" />Firma en servidor</label><br/>-->
				<label><input type="radio" name="prueba" value="lotes" />Firma En lotes en servidor</label><br/>
				<label><input type="radio" name="prueba" value="getDocumentoCustodiado" />Recuperar firmado (*)</label><br/>
				<label><input type="radio" name="prueba" value="MultiFirmarAnterior" />Multifirmar firma anterior (*)</label><br/>
				<label><input type="radio" name="prueba" value="getOriginalDocument" />Recuperar Original (*)</label><br/>
				<label><input type="radio" name="prueba" value="checkSignedDocumentValidity" />Comprobar Firmado (*)</label><br/>
				<label><input type="radio" name="prueba" value="checkOrignalDocumentSigned" />Comprobar Original (*)</label><br/>
				<label><input type="radio" name="prueba" value="getSignInfo" />Recuperar Info (*)</label>
			</p>
			<p>
				<input type="submit" value="Probar" />
			</p>
			</form>			
			<p>(*) Requieren un ID de firma para su funcionamiento</p>
		</div>
</div>
<p id="pie">2010 Viafirma.
vers�n Client: <strong><?php echo $VIAFIRMA_CLIENT_VERSION ?></strong><br/>
Path OpenId FileStore: <?php echo $pathTemporalOpenIDFileStore ?><br/>
OpenId Rand Source: <?php echo $authOpenIDRandSource ?><br/>
App Id: <?php echo $appId ?><br/>
Proxy : <?php echo $proxyHost ?><br/>
Proxy Port: <?php echo $proxyPort ?><br/>
Ccul Enable: <?php echo function_exists('curl_init')==true?"Yes":"false"; ?><br/>
<?php 
if (version_compare(phpVersion(), '5.3.0') >= 0) {
    echo '<strong>La version php no es compatible con el cliente Viafirma, rango compatible: 5.0.0-5.3.0</strong>:  ';
}else{
   echo '<strong>Versi�n php compatible</strong>: ';
}
?>
<?php echo phpVersion() ?><br/>
</p>

</body>
</html>