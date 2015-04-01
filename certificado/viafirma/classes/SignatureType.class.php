<?php

class SignatureType{
	public static $XADES="XADES_EPES_ENVELOPED";
	public static $CMS="CMS";
	public static $PDF_PKCS7="PDF_PKCS7";
	public static $PDF_PKCS7_T="PDF_PKCS7_T";
	public static $DIGITALIZED_SIGN = "DIGITALIZED_SIGN";
	public static $PADES_BASIC = "PAdES_BASIC";
	public static $PADES_BES= "PAdES_BES";
	public static $PADES_EPES= "PAdES_EPES";
	public static $PADES_LTV= "PAdES_LTV";
}

class MimeType{
	public static $XML ="text/xml";
	public static $TXT ="text/plain";
	public static $PDF ="application/pdf";
	public static $BINARY ="application/octet-stream";
	
}

class TypeSign{
	public static $ENVELOPING = "ENVELOPING";
	public static $ENVELOPED = "ENVELOPED";
	public static $DETACHED = "DETACHED";
	public static $ATTACHED = "ATTACHED";

}

?>