<?php

	try {
		include_once("./viafirma/includes.php");
	    // Rutas donde tendremos la libreria y el fichero de idiomas.
		require_once('./tcpdf/tcpdf.php');
		// Crear el documento
		$pdf= new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		//Aplicamos operaciones de modificación
		//Cerramos y damos salida al fichero PDF
		
		



		ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL."/rest",
			"http://localhost/certificado/", $appId, $appPassword);
	    
	    


	    // 3) Obtener instancia del Cliente de Viafirma
		$viafirmaClient = ViafirmaClientFactory::getInstance();
	    
		$idFirma = $_GET['id_firma'];
	    $documentoFirmado=$viafirmaClient->getDocumentoCustodiado($idFirma);
	    // echo $documentoFirmado;

	    $_SESSION['documento'] = $documentoFirmado;
	    $pdf->Output('nombre.pdf', 'D');

	    ?>
<!-- <html>
<head>
	<title>Prueba</title>
	
</head>
<body>
	<form action="http://localhost/larapro/public/home/documento" method="POST" name="formulario">
		
			<input type="hidden" name="documento" value="<?=$documentoFirmado?>">
			<input type="hidden" name="_token" value="<?=$_GET['token']?>">
	</form> -->

	<!--<script type="text/javascript">
		//document.formulario.submit();
	</script>
</body>
</html>-->

<?php 

	}catch(Exception $exception){

		echo "<pre>".$exception."</pre>";

	}
	
	// echo $_SESSION['token'];

	// session_destroy();
?>