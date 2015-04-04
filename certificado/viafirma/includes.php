<?php
	// Version del cliente php 2.4.4
	
	//Comprobamos que esta activa la extension php_curl
	if(!function_exists('curl_init')){
		die("<h3>Para el correcto funcionamiento de <b>Viafirma</b>debe tener activada la extension <i>php_curl</i></h3>");
	}
	
	include_once("viafirma/config/config.inc.php");
	include_once("viafirma/classes/ViafirmaClientFactory.class.php");
	include_once("viafirma/classes/UsuarioGenericoViafirma.class.php");
	include_once("viafirma/classes/UserCancelExcepcion.class.php");
	include_once("viafirma/classes/FailureExcepcion.class.php");
	include_once("viafirma/classes/ViafirmaClientResponse.class.php");
	include_once("viafirma/classes/SignatureType.class.php");
	include_once("viafirma/classes/DTOs.class.php");
	include_once("viafirma/classes/Policy.class.php");
	
	//Tenemos que definir la variable Auth_OpenID_RAND_SOURCE con el valor de configuracion
	define("Auth_OpenID_RAND_SOURCE", $authOpenIDRandSource);
	
	//Ahora cargamos las librerias de OpenId
	require_once("viafirma/Auth/OpenID/Consumer.php");
	require_once("viafirma/Auth/OpenID/FileStore.php");
	require_once("viafirma/Auth/OpenID/SReg.php");
	require_once("viafirma/Auth/OpenID/AX.php");
	
?>