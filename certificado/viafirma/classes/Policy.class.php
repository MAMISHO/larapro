<?php

class Policy{
    /**
     * Type of signature (Enveloped, Enveloping, Detached ...)
     */
    public $typeSign;
    
    /**
     * Format of signature (Xades_EPES, PADES, CMS ...)
     */
    public $typeFormatSign;
    
    /**
     * Parameters defined in OptionalRequestParam
     */
    public $optionalRequest;
    
    /**
     * Additional parameters
     */
    public $parameters;
	
	public function toJson(){
		$jsonParams = "{";
		if($this->parameters!=null){
			foreach($this->parameters as $i => $param){
				if($i>0){
					$jsonParams = $jsonParams.",";
				}
				$key = $param[0];
				$value = $param[1];
				
				//Solve some bug with the pem file
				if(!strcmp($key,PolicyParams::$DIGITALIZED_SIGN_BIOMETRIC_CRYPTO_PEM)){
					//Replace simple \ by \\ for escape charaters of line break
					echo $value."<br/>"."<br/>"."<br/>"."<br/>"."<br/>";
					//$value = preg_replace("/\r\n/", '\\r\\n', $param[1]);
					$value = base64_encode($value);
				}
				
				$jsonParams = $jsonParams.$key.":'".$value."'";
			}
		}
		$jsonParams = $jsonParams."}";
		
		$jsonOptRequest = "[";
		
		if($this->optionalRequest!=null){
			foreach($this->optionalRequest as $i => $opt){
				$jsonOptRequest = $jsonOptRequest.$key.",";
			}
		}
		$jsonOptRequest = $jsonOptRequest."]";
	
		$jsonTypeFormatSign = "{name:".$this->typeFormatSign."}";
		$jsonTypeSign = "{name:".$this->typeSign."}";
	
		return "{typeSign:".$jsonTypeSign.",typeFormatSign:".$jsonTypeFormatSign.",parameters:".$jsonParams.",optionalRequest:".$jsonOptRequest."}";
	}

    function Policy($json){
		if(property_exists($json, 'typeSign'))
			$this->typeSign=$json->typeSign;
		if(property_exists($json, 'typeFormatSign'))
			$this->typeFormatSign=$json->typeFormatSign;
		if(property_exists($json, 'optionalRequest'))
			$this->optionalRequest=($json->optionalRequest);
		if(property_exists($json, 'parameters'))
			$this->parameters=$json->parameters;
	}
	
	public static function newPolicy(){
		$instance = new self("");
		return $instance;
	}
    
    public function addParameter($key, $value){
		if($this->parameters==null){
    	    $this->parameters = array();
    	}
    	if(gettype($value) == 'string' ){
			$this->parameters[] = array($key, $value);			
    	}else if(gettype($value) == 'integer' ){
			$this->parameters[] = array($key, $value);
		}else if($value instanceof ByteArray){
			$this->parameters[] = array($key, base64_encode($value));
    	}else if($value instanceof Rectangle){
			$this->parameters[] = array($key, $value->getDatosRectangle());
    	}else{
    	    return false;
    	}
		
    	return true;
     }
    
    /**
     * Remove a parameter from the policy. You should use the enum PolicyParam for the keys
     * @param key
     * @return true if the parameter has been removed of false if not
     * 
     */
    public function removeParameter($key){
    	if($this->parameters==null){
    	    return false;
    	}else{
    	    unset($this->$parameters[$key]);
    	    return true;
    	}
     }

}

class PolicyParams{

    //DETACHED PARAMS
	public static $DETACHED_REFERENCE_URL = "detachedReferenceUrl";

    //DIGITALIZED PARAMS
	public static $DIGITALIZED_SIGN_LOGO = "digitalizedSignLogo";
    public static $DIGITALIZED_SIGN_COLOUR = "digitalizedSignColor";
    public static $DIGITALIZED_SIGN_BACK_COLOUR = "digitalizedSignBackColor";
    public static $DIGITALIZED_SIGN_HELP_TEXT = "digitalizedSignHelpText";
    public static $DIGITALIZED_SIGN_RECTANGLE = "digitalizedSignRectangle";
    public static $DIGITALIZED_SIGN_ALIAS = "alias";
    public static $DIGITALIZED_SIGN_PASS = "pass";
    public static $DIGITALIZED_SIGN_BIOMETRIC_ALIAS = "biometricAlias";
    public static $DIGITALIZED_SIGN_BIOMETRIC_PASS = "biometricPass";
    public static $DIGITALIZED_SIGN_BIOMETRIC_CRYPTO_PEM = "biometricCryptoPEM";
    public static $DIGITALIZED_SIGN_PAGE = "page";
	public static $DIGITALIZED_PRESSURE_STYLUS = "digitalizedPressureStylus";
    public static $DIGITALIZED_PRESSURE_INFO = "digitalizedPressureInfo";
    public static $DIGITALIZED_LOCATION_STATUS = "digitalizedLocationStatus";
    public static $DIGITALIZED_SIGNATURE_INFO = "digitalizedSignatureInfo";
    public static $DIGITALIZED_SIGNATURE_FORMAT = "DIGITALIZED_SIGNATURE_FORMAT";

    //APPLET PARAMS
	public static $CLIENT_LOCALE = "CLIENT_LOCALE";
    public static $APPLET_STYLE = "APPLET_STYLE";
    public static $FILTER_NUMBER_USER_ID = "FILTER_NUMBER_USER_ID";
    public static $FILTER_CA_NAME = "FILTER_CA_NAME";

    //ANNOTATIONS AND STAMP PARAMS
	public static $DIGITAL_SIGN_RECTANGLE = "DIGITAL_SIGN_RECTANGLE";
    public static $DIGITAL_SIGN_IMAGE_STAMPER = "DIGITAL_SIGN_IMAGE_STAMPER";
    public static $DIGITAL_SIGN_PAGE = "DIGITAL_SIGN_PAGE";
    public static $DIGITAL_SIGN_IMAGE_STAMPER_AUTOGENERATE = "DIGITAL_SIGN_IMAGE_STAMPER_AUTOGENERATE";
	public static $DIGITAL_SIGN_STAMPER_HIDE_STATUS = "DIGITAL_SIGN_STAMPER_HIDE_STATUS";
	public static $DIGITAL_SIGN_STAMPER_TEXT = "DIGITAL_SIGN_STAMPER_TEXT";
    public static $DIGITAL_SIGN_REASON = "DIGITAL_SIGN_REASON";
    public static $DIGITAL_SIGN_LOCATION = "DIGITAL_SIGN_LOCATION";
    public static $DIGITAL_SIGN_CONTACT = "DIGITAL_SIGN_CONTACT";
	public static $DIGITAL_SIGN_STAMPER_TYPE = "DIGITAL_SIGN_STAMPER_TYPE";
	public static $PDF_ANNOTATION_IMAGE = "PDF_ANNOTATION_IMAGE";
    public static $PDF_ANNOTATION_RECTANGLE = "PDF_ANNOTATION_RECTANGLE";
    public static $PDF_ANNOTATION_PAGE = "PDF_ANNOTATION_PAGE";

    //SPECIAL FUNCIONALITIES PARAMS
	public static $XML_CANONIZATION_TRANSFORM = "XML_CANONIZATION_TRANSFORM";
    public static $CALLBACK_URL = "CALLBACK_URL";
	public static $MULTISIGN_ID = "MULTISIGN_ID";
	

}


?>