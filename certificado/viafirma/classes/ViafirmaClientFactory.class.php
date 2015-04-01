<?php


define("TIPO_STRING", 1);
define("TIPO_DATA", 2);
define("TIPO_POLICY", 3);
define("TIPO_DOCUMENT", 4);
define("TIPO_RECTANGLE", 5);

class ViafirmaClientFactory {

	private static $singleton = null;
	private static $attribute;
	private static $attributeForSign;
	private static $attributeOptional;
	private $urlViafirma;
	private $urlViafirmaWS;
	private $urlAplicacionPublica;
	private $maxSizeDocument;
	
	
	
	/**
	 * Inicialice the Viafirma Client.
	 * @param mixed $thing Any object which may be an
	 * @return bool true if $thing is an Auth_OpenID_AX_Error; false if not.
	 */
	public static function init($urlViafirmaParam, $urlViafirmaWSParam, $urlAplicacionPublicaParam){
		global $maxSizeMegabytes;
		
		if(ViafirmaClientFactory::$singleton === null){
			ViafirmaClientFactory::$singleton = new ViafirmaClientFactory();
		}
		
		if ($maxSizeMegabytes == null){
			$maxSizeDocument = 1024*1024*5;
		}else{
			$maxSizeDocument = 1024*1024*$maxSizeMegabytes;
		}
		
		ViafirmaClientFactory::$singleton->urlViafirma = $urlViafirmaParam;
		ViafirmaClientFactory::$singleton->urlViafirmaWS = $urlViafirmaWSParam."/services/ConectorFirmaRMI";
		ViafirmaClientFactory::$singleton->urlAplicacionPublica = $urlAplicacionPublicaParam;
		
		//Basic Attributes
		ViafirmaClientFactory::$attribute = array();
		ViafirmaClientFactory::$attributeForSign = array();
		ViafirmaClientFactory::$attributeOptional = array();
		
		//Numero de identificacion fiscal del usurio o similar
		ViafirmaClientFactory::$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://www.viavansi.com/schema/person/numberId', 1, true, 'numberUserId');
		//Nombre de la autoridad de certificacionn.
		ViafirmaClientFactory::$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://www.viavansi.com/schema/certificate/caName', 1, true, 'caName');
		//Conjunto de oids recuperados del certificado
		ViafirmaClientFactory::$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://www.viavansi.com/schema/certificate/oid', 1, true, 'oids');
		//Tipo de certificado, ej: FNMT, Camerfirma, etc.
		ViafirmaClientFactory::$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://www.viavansi.com/schema/certificate/type', 1, true, 'typeCertificate');
		//Tipo de certificado, ej: Persona fisica, Persona juridica, etc.
		ViafirmaClientFactory::$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://www.viavansi.com/schema/certificate/legal', 1, true, 'typeLegal');
		ViafirmaClientFactory::$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://schema.openid.net/contact/email', 1, true, 'email');
		ViafirmaClientFactory::$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://openid.net/schema/namePerson/first', 1, true, 'firstName');
		ViafirmaClientFactory::$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://openid.net/schema/namePerson/last', 1, true, 'lastName');

		// ***********************
		// Tipos de peticion relacionados con la firma de ficheros
		// ***********************
		ViafirmaClientFactory::$attributeForSign[] = Auth_OpenID_AX_AttrInfo::make('http://www.viavansi.com/schema/sign/signId',1,true, 'signId');
		ViafirmaClientFactory::$attributeForSign[] = Auth_OpenID_AX_AttrInfo::make('http://www.viavansi.com/schema/sign/timeStamp',1,true, 'signTimeStamp');

		// ***********************
		// Atributos opcionales
		// ***********************
		ViafirmaClientFactory::$attributeOptional[] = Auth_OpenID_AX_AttrInfo::make('http://www.viavansi.com/schema/certificate/X509Certificate',1,true, 'pem');
		ViafirmaClientFactory::$attributeOptional[] = Auth_OpenID_AX_AttrInfo::make('http://www.viavansi.com/schema/sign/cms',1,true, 'cms');
		ViafirmaClientFactory::$attributeOptional[] = Auth_OpenID_AX_AttrInfo::make('http://www.viavansi.com/schema/document/hash',1,true, 'document_hash');
		
		//Guardamos en sesion las variables de configuracion para que en posteriores getInstance se pueda iniciar solo...
		ViafirmaClientFactory::saveConfigSesion("urlViafirma", $urlViafirmaParam);
		ViafirmaClientFactory::saveConfigSesion("urlViafirmaWS", $urlViafirmaWSParam);
		ViafirmaClientFactory::saveConfigSesion("urlAplicacionPublica", $urlAplicacionPublicaParam);
		ViafirmaClientFactory::saveConfigSesion("maxSizeDocument", $maxSizeDocument);
	}
	
	public static function getInstance(){
		if(ViafirmaClientFactory::$singleton === null){
			//Comprobamos si no ha sido iniciado anteriormente y estan en sesion los parametros...
			$urlViafirma = ViafirmaClientFactory::getConfigSesion("urlViafirma");
			$urlViafirmaWS = ViafirmaClientFactory::getConfigSesion("urlViafirmaWS");
			$urlAplicacionPublica = ViafirmaClientFactory::getConfigSesion("urlAplicacionPublica");
			if(isset($urlViafirma) && isset($urlViafirmaWS) && isset($urlAplicacionPublica)){
				ViafirmaClientFactory::init($urlViafirma, $urlViafirmaWS, $urlAplicacionPublica);
			}else{
				throw new Exception("Debe incializar el cliente de Viafirma con el metodo: init(\$urlViafirmaParam, \$urlViafirmaWSParam, \$urlAplicacionPublicaParam)");
			}
		}
		return ViafirmaClientFactory::$singleton;
	}
	
	
	public function addDocumentoFirmaEnLote($idLote,$nombreDocumento,$mimeType,$datosDocumento){
		$datos = array();
		$datos[] = array(TIPO_STRING,$idLote);
		$datos[] = array(TIPO_STRING,$nombreDocumento);
		$datos[] = array(TIPO_STRING,$mimeType);
		$datos[] = array(TIPO_DATA,$datosDocumento);
		if(strlen($datosDocumento) < $this->getMaxSizeDocument()){
			$idFirma=$this->execute("addDocumentoFirmaEnLote",$datos);
			return $idFirma;
		}else{
			throw new Exception('El tamaño del documento excede el limite permitido');
		}
	}

	public function buildInfoQRBarCode($idFirma){
		$datos = array();
		$datos[] = array(TIPO_STRING,$idFirma);
		$resguardo=$this->execute("buildInfoQRBarCode",$datos);
		return $resguardo;
	}

	/*
	public function checkDocumentSigned($document,$idFirma){
		$datos = array();
		$datos[] = array(TIPO_DATA,$document);
		$datos[] = array(TIPO_STRING,$idFirma);
		$info=$this->execute("checkDocumentSigned",$datos);
		
		print_r($info);
		$respuestaJSON=json_decode($info);
		
		return new FirmaInfo($respuestaJSON->FirmaInfoViafirma);
	}
	*/
	
	/*	
	public function checkOrignalDocumentSigned($original,$idFirma){
		$datos = array();
		$datos[] = array(TIPO_DATA,$original);
		$datos[] = array(TIPO_STRING,$idFirma);
		$info=$this->execute("checkOrignalDocumentSigned",$datos);
		
		print_r($info);
		$respuestaJSON=json_decode($info);
		
		return new FirmaInfo($respuestaJSON->FirmaInfoViafirma);
	}
	*/
	
	public function checkSignedDocumentValidity($firmado){
		$datos = array();
		$datos[] = array(TIPO_DATA,$firmado);
		$info=$this->execute("checkSignedDocumentValidity",$datos);
		$info=json_decode($info);
		return $info;
	}
	
	public function checkSignedDocumentValidityByFileType($firmado, $formatoFirma){
		$datos = array();
		$datos[] = array(TIPO_DATA,$firmado);
		$datos[] = array(TIPO_STRING,$formatoFirma);
		$info=$this->execute("checkSignedDocumentValidityByFileType",$datos);
		$info=json_decode($info);
		return $info;
	}
	
	public function disabledMultiSign($idFirma){
		//Nuevo
		$datos = array();
		$datos[] = array(TIPO_STRING,$idFirma);
		$id=$this->execute("disabledMultiSign",$datos);
		return $id;
	}	
	
	public function enabledMultiSign($idFirma){
		//Nuevo
		$datos = array();
		$datos[] = array(TIPO_STRING,$idFirma);
		$id=$this->execute("enabledMultiSign",$datos);
		return $id;
	}
	
	public function getDocumentoCustodiado($idFirma){
		$datos = array();
		$datos[] = array(TIPO_STRING,$idFirma);
		$documento=$this->execute("getDocumentoCustodiado",$datos);
		return base64_decode($documento);
	}
	
	public function tsaRequest($dataRequest){
		$datos = array();
		$datos[] = array(TIPO_DATA,$dataRequest);
		$documento=$this->execute("tsaRequest",$datos);
		return base64_decode($documento);
	}
	
	
	/*
	public function getOriginalDocument($idFirma){
		$datos = array();
		$datos[] = array(TIPO_STRING,$idFirma);
		$original=$this->execute("getOriginalDocument",$datos);
		$respuestaJSON=json_decode($original);
		return new Document($respuestaJSON->Documento);
	}
	*/
	
	/*
	public function getOriginalDocumentsIds($idFirmaLotes){
		//TODO
		$datos = array();
		$datos[] = array(TIPO_STRING,$idFirmaLotes);
		$ids=$this->execute("getOriginalDocumentsIds",$datos);
		return $ids;
	}
	*/
	
	/*
	public function getSignInfo($idFirma){
		$datos = array();
		$datos[] = array(TIPO_STRING,$idFirma);
		$info=$this->execute("getSignInfo",$datos);
		print_r($info);
		echo gettype($info);
		$respuestaJSON=json_decode($info);
		return new FirmaInfo($respuestaJSON->FirmaInfoViafirma);
	}
	*/
	
	public function iniciarFirmaEnLotes($formatoFirma){
		$datos = array();
		$datos[] = array(TIPO_STRING,$formatoFirma);
		$idFirma=$this->execute("iniciarFirmaEnLotes",$datos);
		return $idFirma;
	}
	
	public function prepareFirmaPDFWithImageStamp($nombreDocumento,$datosDocumento,$datosRectangle,$datosImagen){
		$datos = array();
//		opcion rectangulo para firma
		$datos[] = array(TIPO_STRING,$nombreDocumento);
		$datos[] = array(TIPO_DATA,$datosDocumento);
		$datos[] = array(TIPO_STRING,$datosRectangle);
		$datos[] = array(TIPO_DATA,$datosImagen);
		
		if(strlen($datosDocumento) < $this->getMaxSizeDocument()){
			$idFirma=$this->execute("prepareFirmaPDFWithImageStamp",$datos);
			return $idFirma;
		}else{
			throw new Exception('El tamaño del documento excede el limite permitido');
		}
		
	}
	
	public function prepareFirmaPDFWithImageStampAtField($nombreDocumento,$datosDocumento,$fieldName,$datosImagen){
		$datos = array();
//		opcion campo de firma en pdf
		$datos[] = array(TIPO_STRING,$nombreDocumento);
		$datos[] = array(TIPO_DATA,$datosDocumento);
		$datos[] = array(TIPO_STRING,$fieldName);
		$datos[] = array(TIPO_DATA,$datosImagen);
		
		if(strlen($datosDocumento) < $this->getMaxSizeDocument()){
			$idFirma=$this->execute("prepareFirmaPDFWithImageStampAtField",$datos);
			return $idFirma;
		}else{
			throw new Exception('El tamaño del documento excede el limite permitido');
		}
	}
	
	public function prepareFirmaWithTypeFileAndFormatSign($nombreDocumento,$mimeType,$datosDocumento,$formatoFirma){
		$datos = array();
		$datos[] = array(TIPO_STRING,$nombreDocumento);
		$datos[] = array(TIPO_STRING,$mimeType);
		$datos[] = array(TIPO_STRING,$formatoFirma);
		$datos[] = array(TIPO_DATA,$datosDocumento);
		
		if(strlen($datosDocumento) < $this->getMaxSizeDocument()){
			$idFirma=$this->execute("prepareFirmaWithTypeFileAndFormatSign",$datos);
			return $idFirma;
		}else{
			throw new Exception('El tamaño del documento excede el limite permitido');
		}
	}
	
	/*
	public function prepareFirmaWithTypeFileAndFormatSignAndFilterCertificate($nombreDocumento,$mimeType,$datosDocumento,$formatoFirma,$usuarioGenericoViafirma){
		//TODO
		$datos = array();
		$datos[] = array(TIPO_STRING,$nombreDocumento);
		$datos[] = array(TIPO_STRING,$mimeType);
		$datos[] = array(TIPO_STRING,$formatoFirma);
		$datos[] = array(TIPO_DATA,$datosDocumento);
		$datos[] = array(TIPO_STRING,json_encode($usuarioGenericoViafirma));
		$idFirma=$this->execute("prepareFirmaWithTypeFileAndFormatSignAndFilterCertificate",$datos);
		return $idFirma;
	}
*/
	
	public function prepareSignWithPolicy($policy, $documento){
		// sube los datos por rmi al conector de firma1
		if ($documento->getNombre() == null || $documento->getTipo() == null || $documento->getDatos() == null) {
			if ($documento->getNombre() == null) {
				throw new Exception(" Nombre del documento no definido ");
			} else if ($documento->getTipo() == null) {
				throw new Exception(" Tipo del documento no definido ");
			}
			throw new Exception(" Documento con contenido vacío ");
		} else {
			if (strlen($documento->getDatos()) > $this->getMaxSizeDocument()) {
				throw new Exception('El tamaño del documento excede el limite permitido');
			}
			$datos = array();
			$datos[] = array(TIPO_POLICY,$policy);
			$datos[] = array(TIPO_DOCUMENT,$documento);
			$idFirma=$this->execute("prepareSignWithPolicy",$datos);
		}
		return $idFirma;
	}
	
	public function signByServerWithPolicy ($policy, $documento, $aliasCertificado, $contrasenaCertificado){
		if ($documento->getNombre() == null || $documento->getTipo() == null || $documento->getDatos() == null) {
			if ($documento->getNombre() == null) {
				throw new Exception(" Nombre del documento no definido ");
			} else if ($documento->getTipo() == null) {
				throw new Exception(" Tipo del documento no definido ");
			}
			throw new Exception(" Documento con contenido vacío ");
		} else {
			if (strlen($documento->getDatos()) > $this->getMaxSizeDocument()) {
				throw new Exception('El tamaño del documento excede el limite permitido');
			}
			$datos = array();
			$datos[] = array(TIPO_POLICY,$policy);
			$datos[] = array(TIPO_DOCUMENT,$documento);
			$datos[] = array(TIPO_STRING,$aliasCertificado);
			$datos[] = array(TIPO_STRING,$contrasenaCertificado);
 			$idFirma=$this->execute("signByServerWithPolicy ",$datos);            
        }
		return $idFirma;
    }
	
	public function setMaxSizeMbDocument($maxSizeMegabytes){
		
		$maxSizeDocument = 1024*1024*$maxSizeMegabytes;
		ViafirmaClientFactory::saveConfigSesion("maxSizeDocument", $maxSizeDocument);
		
	}
	
	public function getMaxSizeDocument(){
		
		$maxSizeDocument = ViafirmaClientFactory::getConfigSesion("maxSizeDocument");
		return $maxSizeDocument;
	}
	
	public function sendSignMailByServer($subject,$mailTo,$texto,$htmlTexto,$aliasCertificado,$contrasenaCertificado){
		//TODO
		$datos = array();
		$datos[] = array(TIPO_STRING,$subject);
		$datos[] = array(TIPO_STRING,$mailTo);
		$datos[] = array(TIPO_STRING,$texto);
		$datos[] = array(TIPO_STRING,$htmlTexto);
		$datos[] = array(TIPO_STRING,$aliasCertificado);
		$datos[] = array(TIPO_STRING,$contrasenaCertificado);
		$idFirma=$this->execute("sendSignMailByServer",$datos);
		return $idFirma;
	}
	
	public function signByServerEnLotes($idFirmaLote,$aliasCertificado,$contrasenaCertificado){
		$datos = array();
		$datos[] = array(TIPO_STRING,$idFirmaLote);
		$datos[] = array(TIPO_STRING,$aliasCertificado);
		$datos[] = array(TIPO_STRING,$contrasenaCertificado);
		$idFirma=$this->execute("signByServerEnLotes",$datos);
		return $idFirma;
	}

	public function signByServerPDFWithImageStamp ($nombreDocumento,$datosDocumento,$aliasCertificado,$contrasenaCertificado,$datosRectangle,$datosImagen){
		$datos = array();
		
//		opcion rectangulo de firma en $dataFirma
		$datos[] = array(TIPO_STRING,$nombreDocumento);
		$datos[] = array(TIPO_DATA,$datosDocumento);
		$datos[] = array(TIPO_STRING,$aliasCertificado);
		$datos[] = array(TIPO_STRING,$contrasenaCertificado);
		$datos[] = array(TIPO_STRING,$datosRectangle);
		$datos[] = array(TIPO_DATA,$datosImagen);
		
//		opcion campo de firma en pdf en $dataFirma
//		$datos[] = array(TIPO_STRING,$nombreDocumento);
//		$datos[] = array(TIPO_DATA,$datosDocumento);
//		$datos[] = array(TIPO_STRING,$aliasCertificado);
//		$datos[] = array(TIPO_STRING,$contrasenaCertificado);
//		$datos[] = array(TIPO_STRING,$datosFirma);
//		$datos[] = array(TIPO_DATA,$datosImagen);
		
		if(strlen($datosDocumento) < $this->getMaxSizeDocument()){
			$idFirma=$this->execute("signByServerPDFWithImageStamp",$datos);
			return $idFirma;
		}else{
			throw new Exception('El tamaño del documento excede el limite permitido');
		}
	}
	
	public function signByServerWithTypeFileAndFormatSign($nombreDocumento,$mimeType,$datosDocumento,$formatoFirma,$aliasCertificado,$contrasenaCertificado){
		$datos = array();
		$datos[] = array(TIPO_STRING,$nombreDocumento);
		$datos[] = array(TIPO_DATA,$datosDocumento);
		$datos[] = array(TIPO_STRING,$aliasCertificado);
		$datos[] = array(TIPO_STRING,$contrasenaCertificado);
		$datos[] = array(TIPO_STRING,$mimeType);
		$datos[] = array(TIPO_STRING,$formatoFirma);
		
		if(strlen($datosDocumento) < $this->getMaxSizeDocument()){
			$idFirma=$this->execute("signByServerWithTypeFileAndFormatSign",$datos);
			return $idFirma;
		}else{
			throw new Exception('El tamaño del documento excede el limite permitido');
		}
	}
	
	public function signPreviousSignature($idFirma,$urlRetorno){
		//$idFirma=$idFirma."CONTINUE";
		$this->solicitarFirma($idFirma,$urlRetorno);
	}
	
	public function solicitarAutenticacion($urlRetorno){
		global $pathTemporalOpenIDFileStore;
		
		$urlPeticion = $this->urlViafirma."/conectorAutenticacionOpenId";

		//Guardamos en sesion la url de retorno para luego recuperarla en la respuesta
		ViafirmaClientFactory::saveConfigSesion("urlRetorno", $urlRetorno);
		
		// iniciar sesion (necesario para YADIS)
		if(session_id() == ""){
			@session_start();
		}


		// directorio de almacenamiento de OpenID
		$almacenamiento = new Auth_OpenID_FileStore($pathTemporalOpenIDFileStore);

		// crear el cliente OpenID
		$cliente = new Auth_OpenID_Consumer($almacenamiento);

		// Inicia el proceso de autentificaci�n y crea las peticiones para el servidor OpenID
		$auth = $cliente->begin($urlPeticion);
		if(!$auth){
			throw new Exception('No se ha podido conectar al servidor OpenID. Revise la configuracion config/config.inc.php y compruebe que tiene conexion con:'.$urlPeticion.'');
		}

		//
		if(!$this->compruebaUserPassw($auth, $urlPeticion)){
			throw new Exception('Aplicacion no autorizada. API key invalido');
		}

		// petici�n para obtener los datos de usuario
		//$sreg = Auth_OpenID_SRegRequest::build(array('email', 'fullname'), array('nickname'));
		//if (!$sreg){
		//	throw new Exception('no se ha podido obtener la informaci�n de usuario');
		//}execute
		//$auth->addExtension($sreg);

		// Create AX fetch request
		$ax = new Auth_OpenID_AX_FetchRequest();

		// Anadimos todos los atributos de Viafirma
		foreach(ViafirmaClientFactory::$attribute as $attr){
			$ax->add($attr);
		}

		// Add AX fetch request to authentication request
		$auth->addExtension($ax);

		// redireccionar al servidor OpenID para autentificar la cuenta
		Header('Location: '.$auth->redirectURL($this->urlAplicacionPublica, $urlRetorno));
	}
	
	public function solicitarFirma($idFirma,$urlRetorno){
		global $pathTemporalOpenIDFileStore;
		
		//$urlPeticion = $this->urlViafirma."/conectorFirmaOpenId/";

		$urlPeticion = $this->urlViafirma."/sign/".$idFirma;
		
		//Guardamos en sesion la url de retorno para luego recuperarla en la respuesta
		ViafirmaClientFactory::saveConfigSesion("urlRetorno", $urlRetorno);
		
		// iniciar sesi�n (necesario para YADIS)
		if(session_id() == ""){
			@session_start();
		}

		// directorio de almacenamiento de OpenID
		$almacenamiento = new Auth_OpenID_FileStore($pathTemporalOpenIDFileStore);

		// crear el cliente OpenID
		$cliente = new Auth_OpenID_Consumer($almacenamiento);

		// Inicia el proceso de autentificaci�n y crea las peticiones para el servidor OpenID
		$auth = $cliente->begin($urlPeticion);
		if(!$auth){
			throw new Exception('No se ha podido conectar al servidor OpenID. Compruebe que tiene conexión con:'.$urlPeticion.'');
		}

		//
		if(!$this->compruebaUserPassw($auth, $urlPeticion)){
			throw new Exception('Aplicación no autorizada');
		}

		// petici�n para obtener los datos de usuario
		//$sreg = Auth_OpenID_SRegRequest::build(array('email', 'fullname'), array('nickname'));
		//if (!$sreg){
		//	throw new Exception('no se ha podido obtener la informaci�n de usuario');
		//}execute
		//$auth->addExtension($sreg);

		// Create AX fetch request
		$ax = new Auth_OpenID_AX_FetchRequest();

		$allAttibutes=array_merge(ViafirmaClientFactory::$attribute,ViafirmaClientFactory::$attributeForSign);
		
		// Anadimos todos los atributos de Viafirma
		foreach($allAttibutes as $attr){
			$ax->add($attr);
		}

		// Add AX fetch request to authentication request
		$auth->addExtension($ax);

		// redireccionar al servidor OpenID para autentificar la cuenta		
		Header('Location: '.$auth->redirectURL($this->urlAplicacionPublica, $urlRetorno));
		
	}

	public function solicitarFirmasIndependientes($idFirmas, $urlRetorno){
		$datos[] = array(TIPO_STRING,$idFirmas);
		$idFirmaLoop=$this->execute("resumeLoopId",$datos);
		$this->solicitarFirma($idFirmaLoop, $urlRetorno);
	}
	
	
	public function recuperarRespuestaOpenId(){
		global $pathTemporalOpenIDFileStore;
	
		// iniciar sesi�n (necesario para YADIS)
//		if(session_id() == ""){
//			session_start();
//		}
		
		//Recuperamos la urlRetorno de la ultima petici�n realizada
		$urlRetorno = ViafirmaClientFactory::getConfigSesion("urlRetorno");
		$canceladoUsuario = isset($_GET["cancel"]);

		// directorio de almacenamiento OpenID
		$almacenamiento = new Auth_OpenID_FileStore($pathTemporalOpenIDFileStore);

		// crear el cliente OpenID y leer las respuestas del servidor OpenID
		$cliente = new Auth_OpenID_Consumer($almacenamiento);
		$respuesta = $cliente->complete($urlRetorno);

		//Borramos la url de retorno..
		$this->urlRetorno = "";

		// establecer las variables de sesi?n dependiendo del resultado de la autentificaci?n
		if ($respuesta->status == Auth_OpenID_SUCCESS && !$canceladoUsuario) {
			// Get registration informations
			$ax = new Auth_OpenID_AX_FetchResponse();
			$obj = $ax->fromSuccessResponse($respuesta);

			// Print me raw
			//echo '<pre>';
			//print_r($obj->data);
			//echo '</pre>';
			
			//Todo ha ido bien, tenemos que construir el objeto UsuarioGenericoViafirma y cargarlo con los datos
			$usuarioGenerico = new UsuarioGenericoViafirma();
			$allAttibutes=array_merge(ViafirmaClientFactory::$attribute,ViafirmaClientFactory::$attributeForSign);
			foreach($allAttibutes AS $attr){
				$alias = $attr->alias;
				$type_uri = $attr->type_uri;
				
				if($alias == "numberUserId" && isset($obj->data[$type_uri]) && sizeof($obj->data[$type_uri])>0){
					$usuarioGenerico->numberUserId = $obj->data[$type_uri][0];
					
				}else if($alias == "caName" && isset($obj->data[$type_uri]) && sizeof($obj->data[$type_uri])>0){
					$usuarioGenerico->caName = $obj->data[$type_uri][0];
					
				}else if($alias == "typeCertificate" && isset($obj->data[$type_uri]) && sizeof($obj->data[$type_uri])>0){
					$usuarioGenerico->typeCertificate = $obj->data[$type_uri][0];
					
				}else if($alias == "typeLegal" && isset($obj->data[$type_uri]) && sizeof($obj->data[$type_uri])>0){
					$usuarioGenerico->typeLegal = $obj->data[$type_uri][0];
					
				}else if($alias == "email" && isset($obj->data[$type_uri]) && sizeof($obj->data[$type_uri])>0){
					$usuarioGenerico->email = $obj->data[$type_uri][0];
					
				}else if($alias == "firstName" && isset($obj->data[$type_uri]) && sizeof($obj->data[$type_uri])>0){
					$usuarioGenerico->firstName = $obj->data[$type_uri][0];
					
				}else if($alias == "lastName" && isset($obj->data[$type_uri]) && sizeof($obj->data[$type_uri])>0){
					$usuarioGenerico->lastName = $obj->data[$type_uri][0];

				}else if($alias == "signId" && isset($obj->data[$type_uri]) && sizeof($obj->data[$type_uri])>0){
					$usuarioGenerico->signId = $obj->data[$type_uri][0];
					
				}else if($alias == "signTimeStamp" && isset($obj->data[$type_uri]) && sizeof($obj->data[$type_uri])>0){
					$usuarioGenerico->signTimeStamp = $obj->data[$type_uri][0];
					
				}else if($alias == "oids" && isset($obj->data[$type_uri]) && sizeof($obj->data[$type_uri])>0){
					$usuarioGenerico->properties = $obj->data[$type_uri][0];
				}
				
			}
			return $usuarioGenerico;
			
		}else if($respuesta->status == Auth_OpenID_CANCEL){
			throw new UserCancelExcepcion('El usuario canceló la solicitud de autenticación: '.$respuesta->message);
			
		}else if($canceladoUsuario){
			throw new UserCancelExcepcion('El usuario canceló la solicitud de autenticación: '.$_GET["cancel"]);
			
		} else {		
			throw new FailureExcepcion('La autentificación OpenID ha fallado: '.$respuesta->message);
			
		}	
		return false;		
	}
	
	private function compruebaUserPassw($auth, $urlPeticion){
		global $proxyHost,$proxyPort,$proxyUser,$proxyPassword;
		global $appId,$appPassword;
		
		if(isset($appId) && isset($appPassword) && $appId !== null && $appPassword !== null){
			$handler = $auth->assoc->handle;
			$asociaciones = $this->getMapAssociattions();

			//Comprobamos si tenemos la asociacion correcta...
			$temp = $asociaciones[$urlPeticion];
			if($temp == "" || $temp != $handler){
			//if( !in_array($urlPeticion, $asociaciones) && ($asociaciones[$urlPeticion] == "" || $asociaciones[$urlPeticion] != $handler)  ){
				//No tenemos el handler correcto, enviamos la solicitud a viafirma para un nuevo handler...
				$urlPeticionHandler = $urlPeticion."?";
				$urlPeticionHandler .= "V1_REGISTER_CLIENT";
				$urlPeticionHandler .= "&openid.assoc_handle=".urlencode($handler);
				$urlPeticionHandler .= "&VIAFIRMA_CLIENT_APP_ID=".urlencode($appId);
				$urlPeticionHandler .= "&VIAFIRMA_CLIENT_APP_PASS=".urlencode($appPassword);

				$ch = curl_init();
				if($proxyHost != "" && $proxyPort != ""){
					curl_setopt($ch, CURLOPT_PROXY, $proxyHost);
					curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);
					if($proxyUser != ""){
						curl_setopt($ch,CURLOPT_PROXYUSERPWD,"$proxyUser:$proxyPassword");
					}
				}
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_URL, $urlPeticionHandler);
				curl_exec($ch);
				$headers = curl_getinfo($ch);
				curl_close($ch);

				if($headers["http_code"] == "401"){
					unset($asociaciones[$urlPeticion]);
					$this->putMapAssociattions($asociaciones);
					return false;
				}else{
					$asociaciones[$urlPeticion] = $handler;
					$this->putMapAssociattions($asociaciones);
				}

				/*
				$http_response_header = array();
				@file_get_contents($urlPeticionHandler);
				if(stripos($http_response_header[0], "401") !== FALSE){
					return false;
				}
				$asociaciones[$urlPeticion] = $handler;
				$this->putMapAssociattions($asociaciones);
				*/
				
			}
		}
		
		return true;
	}
	
	public static function saveConfigSesion($key, $val){
		if(session_id() == ""){
			@session_start();
		}
		
		$_SESSION["viafirma-".$key] = $val;
	}
	
	public static function getConfigSesion($key){
		if(session_id() == ""){
			@session_start();
		}
		
		return $_SESSION["viafirma-".$key];
	}
	
	private function getMapAssociattions(){
		global $pathTemporalOpenIDFileStore;
		
		$pathFicheroAsociaciones = $pathTemporalOpenIDFileStore."/associations.vf";
		if(file_exists($pathFicheroAsociaciones)){
			return unserialize(file_get_contents($pathFicheroAsociaciones));
		}else{
			return array();
		}
	}
	
	public function putMapAssociattions($mapa){
		global $pathTemporalOpenIDFileStore;
		
		$pathFicheroAsociaciones = $pathTemporalOpenIDFileStore."/associations.vf";
		file_put_contents($pathFicheroAsociaciones, serialize($mapa));
	}
		
	public function printConfig(){
		echo "<div style='width: 500px;border: 1px solid #444;background-color:#EEE;padding:5px;'>";
		echo "<p style='margin:0px;padding:5px;'>Esta es la configuraci�n actual del cliente de Viafirma:</p>";
		echo "<ul>";
		echo "<li>UrlViafirma: <b>".$this->urlViafirma."</b></li>";
		echo "<li>UrlViafirmaWS: <b>".$this->urlViafirmaWS."</b></li>";
		echo "<li>UrlAplicacionPublica: <b>".$this->urlAplicacionPublica."</b></li>";
		echo "</ul>";
		echo "</div>";
	}
	
	private function execute($metodo, $parametros){
		global $proxyHost,$proxyPort,$proxyUser,$proxyPassword;
		global $appId,$appPassword;
		$ch = curl_init($this->urlViafirmaWS."/".$metodo);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); 
		curl_setopt($ch, CURLOPT_POST,true);
		
		//PROXY
		if($proxyHost != "" && $proxyPort != ""){
			curl_setopt($ch, CURLOPT_PROXY, $proxyHost);
			curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);
			if($proxyUser != ""){
				curl_setopt($ch,CURLOPT_PROXYUSERPWD,"$proxyUser:$proxyPassword");
			}
		}
		
		if(isset($appId) && isset($appPassword) && $appId !== null && $appPassword !== null){
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch,CURLOPT_USERPWD,$appId.':'.$appPassword);
		}
		$cadena="";
		foreach ($parametros as $i=>$temp) {
			$tipo = $temp[0];
			$valor = $temp[1];
			if($tipo == TIPO_STRING){
				$valor = $temp[1];
			}else if($tipo == TIPO_DATA){
				$valor =base64_encode($temp[1]);
				$valor = str_replace("+", "%2B", $valor);
				//Abrimos el fichero en modo de escritura 
				//$DescriptorFichero = fopen("c:/temp.txt","w"); 
				//Escribimos la primera l�nea dentro de �l 
				//fputs($DescriptorFichero,$valor); 
				//fclose($DescriptorFichero);
			}else if($tipo == TIPO_RECTANGLE){ 
				$valor = $valor->getDatosRectangle();
			}else if($tipo == TIPO_DOCUMENT){ 
				//Enviamos el fichero codificado en un String
				$datos = base64_encode($valor->getDatos());
				$datos = str_replace("+", "%2B", $datos);				
				$cadena .= ($cadena!=""?"&":"")."docFile=".$datos;			
				
				//seteamos los datos del doc a null para no volver a enviar el fichero que acabamos de enviar
				$valor = $valor->toJson();
				
			}else if($tipo == TIPO_POLICY){ 
				$valor = $valor->toJson();				
			}
			$cadena .= ($cadena!=""?"&":"")."param".($i+1)."=".$valor;		
		}
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $cadena);
		$data=curl_exec ($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	 	if( $status != "200" ) {
			throw new Exception('Existieron problemas en la comunicacion. HhttpErrorCode='.$status.'.  message:'.$data);
    	}	
		curl_close ($ch);
		return $data;
	}
	
	private function test(){
		$this->execute("prepareFirmaWithTypeFileAndFormatSign",array("param1" =>$nombreDocumento,"param1" =>$datosDocumento));
	}
}
?>
