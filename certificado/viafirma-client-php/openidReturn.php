<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--<html>-->
<!--	<head>-->
<!--		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
<!--		<title>Viafirma - Examples</title>-->
<!--		-->
<!--		<link rel="stylesheet" href="../css/framework.css" type="text/css" media="screen" />-->
<!--		<link rel="stylesheet" href="../css/styles.css" type="text/css" media="screen" />-->
<!--	</head>-->
<!--	<body>-->
<!--		<div id="wrapper">-->
<!--			<h1 id="header"><a href=""><img src="../images/content/logo.png" alt="Viafirma" /></a></h1>-->
<!--			-->
<!--			<div id="content">	-->
<!--				<h2>Resultado del proceso de firma</h2>-->
<!---->
<!--					-->
<!--					<% -->
<!--						FirmaInfoViafirma firmaInfoViafirma=(FirmaInfoViafirma)request.getSession().getAttribute("resultado");-->
<!--						String[] ids=firmaInfoViafirma.getSignId().split(";");-->
<!--						for(String id:ids){-->
<!--					%>-->
<!--					-->
<!--					<table>-->
<!--							<tr><td>First Name</td><td>${resultado.properties.firstName}</td></tr>-->
<!--							<tr><td>Last Name</td><td>${resultado.properties.lastName}</td></tr>-->
<!--							<tr><td>Number User Id</td><td>${resultado.properties.numberUserId}</td></tr>-->
<!--							<tr><td>E-mail</td><td>${resultado.properties.email}</td></tr>-->
<!--							<tr><td>Ca Name</td><td>${resultado.properties.caName}</td></tr>-->
<!--							<tr><td>Oids</td><td>${resultado.properties.oids}</td></tr>-->
<!--							<tr><td>Type Certificate</td><td>${resultado.properties.typeCertificate}</td></tr>-->
<!--							<tr><td>Type Legal</td><td>${resultado.properties.typeLegal}</td></tr>-->
<!--					</table>-->
<!--					<p class="codBarras">-->
<!--						<img alt="Imagen QR de justificante del resultado de la firma del fichero" width="500" src="<%=ConfigureUtil.getViafirmaServer() %>/downloadComprobanteQR?codFirma=<%=id%>&amp;tipo=png" title="Imagen QR de justificante del resultado de la firma del fichero" />-->
<!--					</p>-->
<!--				-->
<!--					<p class="descargaComprobante">-->
<!--						<a class="descarga" target="_blank" href="<%=ConfigureUtil.getViafirmaServer()%>/v/<%=id%>?j" title="Descargar Comprobante">Descarga de comprobante de firma</a> 				-->
<!--					</p>-->
<!--					<p class="descargaComprobante">-->
<!--						<a class="descarga" target="_blank" href="<%=ConfigureUtil.getViafirmaServer()%>/v/<%=id%>?d" title="Descargar Documento firmado">Descarga de documento firmado</a> 				-->
<!--					</p>	-->
<!--					<p class="descargaComprobante">-->
<!--						<a class="descarga" target="_blank" href="utils/downloads.jsp?original&id=<%=id%>" title="Descargar Documento original">Descarga de documento original</a> 				-->
<!--					</p>-->
<!--						-->
<!--						<%}%>-->
<!--					<%-->
<!--					}-->
<!--					%>-->
<!--			</div>-->
<!--			<div id="footer">-->
<!--				<p class="left">-->
<!--					Acceda a <a href="http://www.viafirma.com">Viafirma</a> o consulte más información técnica en <a href="http://developers.viafirma.com/">Viafirma Developers</a> -->
<!--				</p>-->
<!--				<p>-->
<!--					<a href="apiExamples/">Listado de métodos</a> - Version 0.6-->
<!--				</p>-->
<!--			</div>-->
<!--		</div>-->
<!--	</body>-->
<!--</html>-->


<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Viafirma - Examples</title>
		
		<link rel="stylesheet" href="css/framework.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
	</head>
	<body>
		<div id="wrapper">
			<h1 id="header"><a href="."><img src="images/content/logo.png" alt="Viafirma" /></a></h1>
			
			<div id="content">	
			<h2>Ejemplo de pruebas con PHP</h2>
<?php
	include_once("./viafirma/includes.php");
	
	class ViafirmaClientResponsePrueba extends ViafirmaClientResponse {
		public function authenticateOK($usuarioGenerico){
			
			echo "El usuario ha sido recuperado correctamente:";
			echo "<table>";
					echo "	<tr><td>First Name</td><td>".$usuarioGenerico->firstName."</td></tr>";
					echo "	<tr><td>Last Name</td><td>".$usuarioGenerico->lastName."</td></tr>";
					echo "	<tr><td>Number User Id</td><td>".$usuarioGenerico->numberUserId."</td></tr>";
					echo "	<tr><td>E-mail</td><td>".$usuarioGenerico->email."</td></tr>";
					echo "	<tr><td>Ca Name</td><td>".$usuarioGenerico->caName."</td></tr>";
					echo "	<tr><td>Oids</td><td>".$usuarioGenerico->properties."</td></tr>";
					echo "	<tr><td>Type Certificate</td><td>".$usuarioGenerico->typeCertificate."</td></tr>";
					echo "	<tr><td>Type Legal</td><td>".$usuarioGenerico->typeLegal."</td></tr>";
			echo "</table>";
		}
		
		public function cancel(){
			echo "<p>Cancelado por el usuario</p>";
		}
		
		public function error($error){
			echo "	<p>$error. Operación cancelada</p>";
		}
		
		public function signOK($usuarioGenerico){
			echo "Firma correctamente realizada:";
			echo "<table>";
				if(isset($usuarioGenerico->firstName) && !empty($usuarioGenerico->firstName)){
					echo "	<tr><td>First Name</td><td>".$usuarioGenerico->firstName."</td></tr>";
				}
				if(isset($usuarioGenerico->lastName) && !empty($usuarioGenerico->lastName)){
					echo "	<tr><td>Last Name</td><td>".$usuarioGenerico->lastName."</td></tr>";
				}
				if(isset($usuarioGenerico->numberUserId) && !empty($usuarioGenerico->numberUserId)){
					echo "	<tr><td>Number User Id</td><td>".$usuarioGenerico->numberUserId."</td></tr>";
				}
				if(isset($usuarioGenerico->email) && !empty($usuarioGenerico->email)){
					echo "	<tr><td>E-mail</td><td>".$usuarioGenerico->email."</td></tr>";
				}
				if(isset($usuarioGenerico->caName) && !empty($usuarioGenerico->caName)){
					echo "	<tr><td>Ca Name</td><td>".$usuarioGenerico->caName."</td></tr>";
				}
				if(isset($usuarioGenerico->properties) && !empty($usuarioGenerico->properties)){
					echo "	<tr><td>Oids</td><td>".$usuarioGenerico->properties."</td></tr>";
				}
				if(isset($usuarioGenerico->typeCertificate) && !empty($usuarioGenerico->typeCertificate)){
					echo "	<tr><td>Type Certificate</td><td>".$usuarioGenerico->typeCertificate."</td></tr>";
				}
				if(isset($usuarioGenerico->typeLegal) && !empty($usuarioGenerico->typeLegal)){
					echo "	<tr><td>Type Legal</td><td>".$usuarioGenerico->typeLegal."</td></tr>";
				}
				echo "	<tr><td>Sign Id</td><td>".$usuarioGenerico->signId."</td></tr>";
				echo "	<tr><td>Sign TimeStamp</td><td>".$usuarioGenerico->signTimeStamp."</td></tr>";
					
					
			echo "</table>";
			
			
			$idFirmas = explode(';',$usuarioGenerico->signId);
			foreach($idFirmas AS $idFirma){
				echo "<p class=\"descargaComprobante\">
					<a class=\"descarga\" target=\"_blank\" title=\"Descargar documento firmado\" href='./requestManager.php?documentoFirmado&idFirma=".$idFirma."'>Descargar documento firmado con id ".$idFirma."</a> 
				</p>";
			}
			
		}
	}
	
	//Lanzamos el process...
	$test = new ViafirmaClientResponsePrueba();
	$test->process();
	
?>			<p>
				<a href="./">&larr; Volver</a>
			</p>
			</div>
			<div id="footer">
				<p class="left">
					Acceda a <a href="http://www.viafirma.com">Viafirma</a> o consulte más información técnica en <a href="http://developers.viafirma.com/">Viafirma Developers</a> 
				</p>
				<p>
					<a href="apiExamples/">Listado de métodos</a> - Version 0.php
				</p>
			</div>
		</div>
	</body>
</html>

