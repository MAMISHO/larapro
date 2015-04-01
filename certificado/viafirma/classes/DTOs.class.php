<?php
Class Document{

	private $id;
	private $tipo;
	private $datos;
	private $nombre;
	private $typeFormatSign;

	function Document($json){
		if(property_exists($json, 'id'))
			$this->id=$json->id;
		if(property_exists($json, 'tipo'))
			$this->tipo=$json->tipo;
		if(property_exists($json, 'datos'))
			$this->datos=base64_decode($json->datos[0]);
		if(property_exists($json, 'nombre'))
			$this->nombre=$json->nombre;
		if(property_exists($json, 'typeFormatSign'))
			$this->typeFormatSign=$json->typeFormatSign;
		
	}
	
	public static function newDocument( $nombreParam, $datosParam, $tipoParam, $typeFormatSignParam ) {
        $instance = new self("");
        $instance->nombre = $nombreParam;
		$instance->datos = $datosParam;		
		$instance->tipo = $tipoParam;
		$instance->typeFormatSign = $typeFormatSignParam;
        return $instance;
	}

	public function getId(){
		return $this->id;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function getDatos(){
		return $this->datos;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getTypeFormatSign(){
		return $this->typeFormatSign;
	}
	
	public function toJson(){
	    $jsonParseTipo = "{name:".substr($this->tipo, strrpos($this->tipo,"/")+1)."}";
		$jsonTypeFormatSign = "{name:".$this->typeFormatSign."}";
		
		
		return "{tipo:".$jsonParseTipo.",nombre:".$this->nombre.",typeFormatSign:".$jsonTypeFormatSign."}";
	}
	
}

Class FirmaInfo{

	
	public $firstName;
    public $lastName;
    public $numberUserId;
    public $email;
    public $typeCertificate;
    public $typeLegal;
    public $caName;
    public $properties;
	
    public $signId;
	public $signTimeStamp;
	public $valid;
	
	public $message;
	
	function FirmaInfo($json){
		if(property_exists($json, 'firstName'))
			$this->firstName=$json->firstName;
		if(property_exists($json, 'lastName'))
			$this->lastName=$json->lastName;
		if(property_exists($json, 'numberUserId'))
			$this->numberUserId=$json->numberUserId;
		if(property_exists($json, 'email'))
			$this->email=$json->email;
		if(property_exists($json, 'typeCertificate'))
			$this->typeCertificate=$json->typeCertificate;
		if(property_exists($json, 'typeLegal'))
			$this->typeLegal=$json->typeLegal;
		if(property_exists($json, 'caName'))
			$this->caName=$json->caName;
		if(property_exists($json, 'properties'))
			$this->properties=$json->properties;
		if(property_exists($json, 'signId'))
			$this->signId=$json->signId;
		if(property_exists($json, 'signTimeStamp'))
			$this->signTimeStamp=$json->signTimeStamp;
		if(property_exists($json, 'valid'))
			$this->valid=$json->valid;
		if(property_exists($json, 'message'))
			$this->message=$json->message;	
	}

}


Class Rectangle{

	public $x;
	public $y;
	public $height;
	public $width;	
	
	function Rectangle($left, $bottom, $heightRectangle, $widthRectangle){
		$this->x=$left;
		$this->y=$bottom;
		$this->height=$heightRectangle;
		$this->width=$widthRectangle;
	}
	

	function getDatosRectangle(){
		return "{x:".$this->x.",y:".$this->y.",height:".$this->height.",width:".$this->width."}";
	}

}

?>