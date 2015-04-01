<?php

include_once("./viafirma/includes.php");

//Se intenta recuperar un documento firmado
if(isset($_GET["documentoFirmado"])){
	$idFirma=$_GET["idFirma"];
	$viafirmaClient=ViafirmaClientFactory::getInstance();
	$documentoFirmado=$viafirmaClient->getDocumentoCustodiado($idFirma);
	header("Content-type: application/octet-stream");
	header("Content-Disposition: filename=\"".$idFirma."\"");
	echo $documentoFirmado;
}
