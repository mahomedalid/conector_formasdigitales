<?php

	date_default_timezone_set('America/Los_Angeles');

	error_reporting(E_ALL);ini_set('display_errors', TRUE);
	echo "<pre>";
	
	#var_dump (function_exists('openssl_get_privatekey'));die ();
	include_once('library/NumberToLetterConverter.php');
	include_once('sat/satxmlsv32.php');
	
	/*<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv3.xsd" version="3.0" 
	fecha="2012-03-29T03:50:09"
	formaDePago="En una sola exhibición" 
	noCertificado="20001000000100001696" 
	certificado
	subTotal="1187400.170000" total="1428337.850000" tipoDeComprobante="ingreso">*/

#	<cfdi:Emisor nombre="GASISLO 2000 SA DE CV SUC. LOPEZ" rfc="APR0412108C5">
#    <cfdi:DomicilioFiscal calle="BLVD. LOPEZ MATEOS" noExterior="101" colonia="CENTRO" localidad="ZACATECAS" municipio="ZACATECAS" estado="ZACATECAS" pais="MEXICO" codigoPostal="98000" />
#    <cfdi:ExpedidoEn calle="Cjon. del Plomo" noExterior="S/N" colonia="CENTRO" localidad="ZACATECAS" municipio="ZACATECAS" estado="ZACATECAS" pais="MEXICO" codigoPostal="98000" />
#  </cfdi:Emisor>
  
	$xml_data = array (
		'noCertificado' => '20001000000100005867',
		'serie' => '',
		'folio' => '',
		'fecha' => date('Y-m-d').'T'.date('H:i:s'),
		'formaDePago' => 'Pago en una sola exhibicion',
		'subTotal' => 100,
		'total' => 116,
		'tipoDeComprobante' => 'ingreso',
		'metodoDePago' => 'No Identificado',
		'LugarExpedicion' => 'San Alfonso 103 Int 20 Col El Campanario, Zapopan, Jalisco, Mexico',
		'NumCtaPago' => '',
		#FolioFiscalOrig
		#SerieFolioFiscalOrig
		#FechaFolioFiscalOrig
		#MontoFolioFiscalOrig
		#'Emisor' => array ('rfc' => 'APR0412108C5', 'nombre' => 'ACTIVIVIENDA PROMOCION SA DE CV', 'Regimen' => 'Régimen General de Ley Personas Morales'),
		'Emisor' => array ('rfc' => 'AAA010101AAA', 'nombre' => ' ACCEM SERVICIOS EMPRESARIALES SC', 'Regimen' => 'PERSONAS MORALES DEL REGIMEN GENERAL',
			'Domicilio' => array ("calle"=>"San Alfonso",
								  "noExterior"=>"103",
								  "noInterior"=>"20",
								  "colonia"=>"El Campanario",
								  "municipio"=>"Zapopan",
								  "estado"=>"Jalisco",
								  "pais"=>"MEXICO",
								  "codigoPostal"=>"45234"
			)
		),
		'Receptor' => array ('nombre' => 'Claudia Yarelih Banderas Flores', 'rfc' => 'BAFC821228H78', 
			'Domicilio' => array ('calle' => 'San Alfonso',
							'noExterior' => '103', 'noInterior' => '20', 'colonia' => 'El Campanario', 'localidad' => 'Zapopan',
							'municipio' => 'Zapopan', 'estado' => 'Jalisco', 'pais' => 'Mexico', 'codigoPostal' => '45234')),
		
		'Conceptos' => array (
			array ('valorUnitario' => '50', 'cantidad' => 2, 'unidad' => 'pz', 'descripcion' => 'Servicios profesionales', 'importe' => '100')
		),
		
		'Traslados' => array (
			array('impuesto' => 'IVA', 'tasa' => '16.00', 'importe' => '16'),
		),
		
		#totalImpuestosTrasladados
	/*	

		Conceptos/$i/valorUnitario
		Conceptos/$i/cantidad
		Conceptos/$i/unidad
		Conceptos/$i/descripcion
		Conceptos/$i/valorUnitario
		Conceptos/$i/importe

		Traslados/impuestos
		Traslados/importe
		Traslados/tasa*/
	);
	
	$xml_filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'xmls' . DIRECTORY_SEPARATOR . 'test';
	
	satxmlsv32($xml_data, NULL, $xml_filename);
	#function satxmlsv32($arr, $edidata=false, $dir="./tmp/",$nodo="",$addenda="") {
	#require_once "lib/numealet.php";        // genera el texto de un importe con letras
	#global $xml, $cadena_original, $sello, $texto, $ret;
	
	#header ('Content-type: text/html; charset=utf-8');	
	
	try {
	
		set_time_limit(0);
		
		/* carga archivo xml */
		//$xml = simplexml_load_file ("C:\\xmls\\08F72325-37B4-47C1-8B5F-354D04FA7DF5.xml");
				
		/* Esto es para cargar el xml en una sola cadena, tal como lo necesita el web service
		   en esta parte se recomienda que los caracteres raros y acentuados se metan con 
		   secuencia de escape para xml.
		   aqui se pueden dar una idea... http://xml.osmosislatina.com/curso/basico.htm		   
		*/
		$filename = $xml_filename . '.xml';

		/*$output=""; 
		$file = fopen($filename, "r"); 
		while(!feof($file)) { 
			//read file line by line into variable 
		  $output = $output . fgets($file, 4096); 
		} 
		fclose ($file); */
		//echo $output; 
		
		$XML = new DOMDocument(); 
		$XML->load( $filename ); 
		
		//set_time_limit(60); 
		#var_dump ($xml);
	
		$context = stream_context_create(array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		));
		
		
		/*$client  = new SoapClient(null, array( 
			'location' => 'https://...',
			'uri' => '...', 
			'stream_context' => $context
		));*/
#var_dump (file_get_contents('https://dev.facturacfdi.mx:8081/WSTimbrado/WSForcogsaService?wsdl'));#die ();
		/* conexion al web service */
		$client = new SoapClient("https://dev.facturacfdi.mx:8081/WSTimbrado/WSForcogsaService?wsdl");
		/*$client = new SoapClient(NULL,
			array('location' => 'https://dev.facturacfdi.mx:8081/WSTimbrado/WSForcogsaService', 
				'uri' => 'https://dev.facturacfdi.mx:8081/WSTimbrado/WSForcogsaService',
					'stream_context' => $context));*/
			
		/* esto es solo para informativo */
		var_dump($client->__getFunctions());
		
		
		/* se le pasan los datos de acceso */
		$autentica = new Autenticar();
		$autentica->usuario = "pruebasWS";
		$autentica->contrasena = "pruebasWS";
		
		/* se cacha la respuesta de la autenticacion */
		$responseAutentica = $client->Autenticar($autentica);	
		
		var_dump ($responseAutentica);
		
		#echo $responseAutentica->return->mensaje . "<br>";
		echo $responseAutentica->return->token . "<br>";
		
		/* se manda el xml a timbrar */
		$timbrar = new Timbrar();
		$timbrar->cfd = $XML->saveXML();
		$timbrar->token = $responseAutentica->return->token; 
		var_dump ($timbrar);
		/* cacha la respuesta */
		$responseTimbre = $client->Timbrar($timbrar);
		var_dump($responseTimbre);
		
		echo "<br><br><br>MSG SOAP REQUEST:<br><br>" . $client->__getLastRequest() . "\n";
		echo "<br><br><br>MSG SOAP REQUEST:<br><br>" . $client->__getLastResponse() . "\n";
				
		/* solo informativo... muestra el codigo de error en caso de existir y resultados */
		echo "codigoErr:" . $responseTimbre->return->codigo . "<br>";
		if(isset($responseTimbre->return->mensaje)) { echo $responseTimbre->return->mensaje . "<br>"; }
		echo htmlentities($responseTimbre->return->cfdi) . "<br>";
	} catch (SoapFault $e) {
		print("Auth Error:::: $e");
	}
	
	
class Autenticar{
	public $usuario;
	public $contraseña;
}

class Timbrar{
	public $cfd;
	public $token;
}

