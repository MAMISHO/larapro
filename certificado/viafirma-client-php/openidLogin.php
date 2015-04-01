<?php
	/**
	* Ejemplo de integracion con Viafirma.
	* @version viafirma-client-php 2.4.3
	*/
	if ($_GET["login"] == true) {
		try {
			include_once("./viafirma/includes.php");
	        // URL en la que se encuentra el servicio de Viafirma y url publica de la aplicacion 
			ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL, $APPLICATION_URL);
			$viafirmaClient = ViafirmaClientFactory::getInstance();
			//$viafirmaClient->printConfig();
			// Url de retorno a la aplicacion (tras el proceso de autenticacion)
			$viafirmaClient->solicitarAutenticacion($VIAFIRMA_RETURN_TO_URL);
			
		}catch(Exception $exception){
			echo "<pre>".$exception."</pre>";
		}
	}else{
?>
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
				<h2>Autenticar al usuario</h2>
				
				<div class="group">
					<div class="col width-63 append-02">
						<div class="box">
							<h3 class="box-title">Autenticación del usuario con Viafirma</h3>
							<div class="box-content">
								<p>En este ejemplo se realiza la autenticación del usuario a través de Viafirma con la intervención directa del usuario.</p>
						
								<p>
									<a class="button" href="?login=true">Autenticar al usuario con Viafirma</a>
								</p>
							</div>
						</div>
					</div>
					
					<div class="col width-35">
						<div class="box">
							<h3 class="box-title">Métodos utilizados</h3>
							
							<div class="box-content">
								<ul>
									<li><code>solicitarAutenticacion</code></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<p>
					<a href="./index.php">&larr; Inicio</a>
				</p> 
			</div>
			
			<div id="footer">
				<p class="left">
					Acceda a <a href="http://www.viafirma.com">Viafirma</a> o consulte más información técnica en <a href="http://developers.viafirma.com/">Viafirma Developers</a> 
				</p>
			</div>
		</div>
	</body>
</html>
<?php }?>