<?php
session_start();  
include_once("./viafirma/includes.php");
	class Ejercicio1Response extends ViafirmaClientResponse {
	
	// Proceso de Autenticación correcto: recibe un objeto UsuarioGenericoViafirma
		public function authenticateOK($usuarioGenerico){

		    $_SESSION['dni'] = $usuarioGenerico->numberUserId;
		    header("Location: ./dir/index.php");
		}

	     // Firma o Autenticación cancelada por el usuario
		public function cancel(){
			$_SESSION['dni'] = $usuarioGenerico->numberUserId;
		    header("Location: ./dir/index.php");
	   }

	    // Error en el proceso de Firma o Autenticación: recibe String con el error
		public function error($error){
			$_SESSION['dni'] = $usuarioGenerico->numberUserId;	
		    header("Location: ./dir/index.php");
		}
	    
	    // Proceso de Firma correcto: recibe un objeto UsuarioGenericoViafirma
		public function signOK($usuarioGenerico){
			echo "Firma correcta";
		}
	}

	$test = new Ejercicio1Response();
	$test->process();

?>