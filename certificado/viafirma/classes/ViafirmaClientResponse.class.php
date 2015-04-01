<?php
include_once("viafirma/config/config.inc.php");
abstract class ViafirmaClientResponse {
	abstract protected function authenticateOK($usuarioGenerico);
	abstract protected function cancel();
	abstract protected function error($error);
	abstract protected function signOK($error);
	
	final public function process(){
		try {
			$viafirmaClient = ViafirmaClientFactory::getInstance();
			$usuarioGenerico = $viafirmaClient->recuperarRespuestaOpenId();
			if(!$usuarioGenerico){
				$this->error("Error: No se ha podido recuperar el usuario autenticado");
			}else{
				if($usuarioGenerico->signId!=""){
					$this->signOK($usuarioGenerico);
				}else{
					$this->authenticateOK($usuarioGenerico);	
				}
			}
		}catch(UserCancelExcepcion $exception){
			$this->cancel();
		}catch(FailureExcepcion $exception){
			$this->error("Error: ".$exception);
		}catch(Exception $exception){
//			echo "<pre>".$exception."</pre>";
		}
	}
}
?>