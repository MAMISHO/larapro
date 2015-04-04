<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Viafirma - Kit para desarrolladores</title>
		
		<link rel="stylesheet" href="css/framework.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
	</head>
	<body>
		<div id="wrapper">
			<h1 id="header"><a href="./"><img src="images/content/logo.png" alt="Viafirma" /></a></h1>
			
			<div id="content">
				<h2>Firmas sin intervención del usuario</h2>
				<p>Las firmas realizadas sin intervención del usuario son realizadas a través del servidor.</p>
				<p>Para el correcto funcionamiento de los siguientes ejemplos, el certificado debe estar instalado en el servidor.</p>
				
				<div class="group">
					<div class="col width-49 append-01">
						<div class="box">
							<h3 class="box-title">Firmas simples</h3>
							<div class="box-content">
								<ul>
									<p><a href="openidServerSignatureXML.php">Firmar documento XML en formato XAdES</a></p>
									<p><a href="openidServerSignaturePDF.php">Firmar documento PDF en formato PDF Signature</a></p>
									<p><a href="serverSignaturePDFWithPolicy.php">Firmar documento PDF en formato PKCS_7 usando el objeto Policy</a></p>
<!--									<p><a href="porHacer">Firmar documento PDF en formato PDF Signature con imagen de sello</a></p>-->
								</ul>
							</div>
						</div>
					</div>
					
					<div class="col width-49 prepend-01">
						<div class="box">
							<h3 class="box-title">Firmas en lote</h3>
							<div class="box-content">
								<ul>
									<li><a href="openidServerSignatureBatch.php">Firmar documentos en lote en formato XAdES</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col width-49 prepend-01">
						<div class="box">
							<h3 class="box-title">TSA bajo nivel</h3>
							<div class="box-content">
								<ul>
									<li><a href="tsaraw.php">Ejemplo de TSA simple (solo TSA sin firma)</a></li>
								</ul>
							</div>
						</div>
					</div>
					
				</div>
				
				<p>
					<a href="./">&larr; Inicio</a>
				</p> 
			</div>
			
			<div id="footer">
				<p class="left">
					Acceda a <a href="http://www.viafirma.com">Viafirma</a> o consulte más información técnica en <a href="http://developers.viafirma.com/">Viafirma Developers</a> 
				</p>
				<p>
					<a href="../apiExamples/">Listado de métodos</a> - <small>Version 0.6</small>
				</p>
			</div>
		</div>
	</body>
</html>