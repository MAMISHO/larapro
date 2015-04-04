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
				<h2>Firmas con intervención del usuario</h2>
				
				<p>La firma se realizará a través del applet de Viafirma, siendo necesaria la intervención del usuario para completar el proceso de firma</p>
				
				<div class="group">
					<div class="col width-49 append-01">
						<div class="box">
							<h3 class="box-title">Firmas simples</h3>
				
							<div class="box-content">
								<ul>
									<li><a href="openidUserSignatureXML.php">Firmar documento XML en formato XAdES</a></li>
									<li><a href="openidUserSignaturePDF.php">Firmar documento PDF en formato PDF Signature</a></li>
									<li><a href="openidUserSignatureDigitalized.php">Firmar documento PDF usando firma Digitalizada</a></li>
									
									<li><a href="userSignaturePDFWithQRStamp.php">Firmar documento PDF en formato PDF Signature con el QRCode de custodia como sello de firma</a></li>
									<li><a href="openidUserPreviousSignature.php">Firmar documento XML que previamente ya ha sido firmado. </a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="group">
					
					
					<div class="col width-49 prepend">
						<div class="box">
							<h3 class="box-title">Firma de varios documentos</h3>
				
							<div class="box-content">
								<ul>
									<li><a href="openidUserSignatureBatch.php">Firmar documentos en lote en formato XAdES</a></li>
									<li><a href="openidUserSignaturePDFLoop.php">Firmar documentos PDF en un solo proceso (en bucle)</a></li>
								</ul>
							</div>
						</div>
						
<!--						<div class="box">-->
<!--							<h3 class="box-title">Firmas de varios documentos en bucle</h3>-->
<!--				-->
<!--							<div class="box-content">-->
<!--								<ul>-->
<!--									<p><a href="porHacer">Firmar varios documentos en firmas independientes y una sola transacción en formato XAdES</a></p>-->
<!--								</ul>-->
<!--							</div>-->
<!--						</div>-->
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
					<small>Version 0.php</small>
				</p>
			</div>
		</div>
	</div>
	</body>
</html>

