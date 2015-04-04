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
<?php

global $aliasCertificado,$aliasPass;

include_once("./viafirma/includes.php");
$id=$_GET["id"];
$prueba=$_GET["prueba"];

//Inicializamos el cliente
ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest", $APPLICATION_URL);
//Recuperamos la instancia del cliente
$viafirmaClient = ViafirmaClientFactory::getInstance();

//Alias y contrase�a del certificado para firma en servidor (Instalado en el cacerts del servidor)
$aliasCertificado=$certAlias;
$passCertificado=$certPass;

if($prueba=="lotes"){
	//Preparamos la estructura contenedora de la firma en lotes
	$idLote=$viafirmaClient->iniciarFirmaEnLotes(SignatureType::$XADES);
	//Anadimos 2 documentos al al lote
	$viafirmaClient->addDocumentoFirmaEnLote($idLote,"prueba.txt",MimeType::$BINARY,"ContenidoPrueba");
	$viafirmaClient->addDocumentoFirmaEnLote($idLote,"prueba.txt",MimeType::$BINARY,"ContenidoPrueba");
	//Finalmente firmamos los 2 documentos en servidor. Esta firma tambien se puede realizar mediante salto OpenID (Firma en cliente como se realiza en openidSignature.php)
	$idFinal=$viafirmaClient->signByServerEnLotes($idLote,$aliasCertificado,$passCertificado);
	echo "Firma realizada correctamente.<br/>ID: ".$idFinal;
}else if($prueba=="MultiFirmarAnterior"){
	if($id==''){
		echo "Se requiere indicar un identificador de firma para realizar esta operaci�n";
	}else{
		$viafirmaClient->signPreviousSignature($id,$VIAFIRMA_RETURN_TO_URL);	
	}
}else if($prueba=="FirmaServidor"){
	$idFinal=$viafirmaClient->signByServerWithTypeFileAndFormatSign("prueba.txt",MimeType::$BINARY,"ContenidoPrueba",SignatureType::$XADES,$aliasCertificado,$passCertificado);
	echo "Firma realizada correctamente.<br/>ID: ".$idFinal;
}else if($prueba=="getOriginalDocument"){
	if($id==''){
		echo "Se requiere indicar un identificador de firma para realizar esta operaci�n";
	}else{
		$documento=$viafirmaClient->getOriginalDocument($id);
		print_r($documento);
	}
}else if($prueba=="checkSignedDocumentValidity"){
	if($id==''){
		echo "Se requiere indicar un identificador de firma para realizar esta operaci�n";
	}else{
		$firmado=$viafirmaClient->getDocumentoCustodiado($id);
		$firmado=$viafirmaClient->checkSignedDocumentValidity($firmado);
		echo $firmado;
//		?"Documento valido":"Documento NO valido";
	}
}else if($prueba=="checkOrignalDocumentSigned"){
	if($id==''){
		echo "Se requiere indicar un identificador de firma para realizar esta operaci�n";
	}else{
		$firmaInfo=$viafirmaClient->checkOrignalDocumentSigned("ContenidoPrueba",$id);
		echo print_r($firmaInfo);
	}
}else if($prueba=="getSignInfo"){
	if($id==''){
		echo "Se requiere indicar un identificador de firma para realizar esta operaci�n";
	}else{
		$firmaInfo=$viafirmaClient->getSignInfo($id);
		echo print_r($firmaInfo);
	}
}else if($prueba=="getDocumentoCustodiado"){
	if($id==''){
		echo "Se requiere indicar un identificador de firma para realizar esta operaci�n";
	}else{
		echo "<a href='./requestManager.php?documentoFirmado&idFirma=".$id."'>Descargue su documento firmado</a>";
	}
}
?>
<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do-->
<!--eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad-->
<!--minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--ex ea commodo consequat. Duis aute irure dolor in reprehenderit in-->
<!--voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur-->
<!--sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt-->
<!--mollit anim id est laborum.</p>-->
</div>
</div>
<p id="pie">2010 Viafirma. vers�n Client: <strong><?=$VIAFIRMA_CLIENT_VERSION ?></strong><br />
Path OpenId FileStore: <?=$pathTemporalOpenIDFileStore ?><br />
OpenId Rand Source: <?php echo $authOpenIDRandSource ?><br />
App Id: <?php echo $appId ?><br />
Proxy : <?php echo $proxyHost ?><br />
Proxy Port: <?php echo $proxyPort ?><br />
Ccul Enable: <?php echo function_exists('curl_init')==true?"Yes":"false"; ?><br />
<?php
if (version_compare(phpVersion(), '5.3.0') >= 0) {
	echo '<strong>La version php no es compatible con el cliente Viafirma, rango compatible: 5.0.0-5.3.0</strong>:  ';
}else{
	echo '<strong>Versi�n php compatible</strong>: ';
}
?><?php echo phpVersion() ?><br />
</p>

</body>
</html>



