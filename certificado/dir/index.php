<?php
session_start();  
?>
<html>
<head>
	<title>Prueba</title>
	
</head>
<body>
	<form action="http://localhost/larapro/public/auth/login" method="POST" name="formulario">
		
			<input type="hidden" name="usuario" value="<?=$_SESSION['dni']?>">
			<input type="hidden" name="clave" value="vacio">
			<input type="hidden" name="_token" value="<?=$_SESSION['token']?>">
			<input type="hidden" name="_tipo_login" value="3">
			<input type="hidden" name="_position" value="000">

		<!-- <button type="submit">Ingresar</button> -->
	</form>

	<script type="text/javascript">
		document.formulario.submit();
	</script>
</body>
</html>
<?php 
session_destroy();
?>