<?php
session_start();  
?>
<html>
<head>
	<title>Firmado</title>
	
</head>
<body>
	<form action="http://localhost/larapro/public/home/anular/firmado" method="POST" name="formulario">
		
			<input type="hidden" name="convocatoria" value="<?=$_SESSION['convocatoria']?>">
			<input type="hidden" name="id_firma" value="<?=$_SESSION['id_firma']?>">
			<input type="hidden" name="_token" value="<?=$_SESSION['_token']?>">
			<input type="hidden" name="location" value="valor">

		<!-- <input type="submit" value="Ingresar"/> -->
	</form>

	<script type="text/javascript">
		document.formulario.submit();
	</script>
</body>
</html>
<?php 
session_destroy();
?>