<?php
session_start();  
include_once("./viafirma/includes.php");
	class FirmadoResponse extends ViafirmaClientResponse {
	
	// Proceso de Autenticación correcto: recibe un objeto UsuarioGenericoViafirma
		public function authenticateOK($usuarioGenerico){

		    $_SESSION['dni'] = $usuarioGenerico->numberUserId;
		    // header("Location: ./dir/index.php");
		    echo "autenticate";
		}

	     // Firma o Autenticación cancelada por el usuario
		public function cancel(){
			$_SESSION['dni'] = $usuarioGenerico->numberUserId;
		    // header("Location: ./dir/firmado.php");
		    echo "cancel";
	   }

	    // Error en el proceso de Firma o Autenticación: recibe String con el error
		public function error($error){
			$_SESSION['dni'] = $usuarioGenerico->numberUserId;	
		    // header("Location: ./dir/firmado.php");
		    echo "error";
		}
	    
	    // Proceso de Firma correcto: recibe un objeto UsuarioGenericoViafirma
		public function signOK($usuarioGenerico){
			// echo "Id de Firma devuelto: ".$usuarioGenerico->signId;
			// echo $_SESSION['idtemporal'];
			$_SESSION['id_firma'] = $usuarioGenerico->signId;
			// echo $usuarioGenerico->signId;
			// echo '<br />';
			// echo $_SESSION['_token'];
			header("Location: ./dir/buclefirmado.php");
			exit;
			// session_destroy();
		}
	}

	$test = new FirmadoResponse();
	$test->process();

?>