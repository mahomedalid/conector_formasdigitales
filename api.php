<?php

	date_default_timezone_set('America/Los_Angeles');
	header('Access-Control-Allow-Origin: *');
	//Requirements:
	
	// - Put api available to Bepos
	// - Activate modules by device (admin side)
	// - Upload/Update/Create client data (admin side)
	// - Login into admin side
	
	error_reporting(E_ALL);ini_set('display_errors', TRUE);
	
	#var_dump (function_exists('openssl_get_privatekey'));die ();
	include_once('library/NumberToLetterConverter.php');
	include_once('sat/satxmlsv32.php');
	
	$errors = array ();
	
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
  
	$devices = array ("browserTest" => 10, '364453d08a2792fb' => 10, '6ed20d2659d9f08e' => 10);

	
	if(isset($_REQUEST['idCliente'])) {
		$idCliente = $_REQUEST['idCliente'];
		$deviceId = 0;
	} else {
		if(isset($_REQUEST['deviceId'])) {
			$deviceId = $_REQUEST['deviceId'];
			if(isset($devices[$deviceId])) {
				$idCliente = $devices[$deviceId];
			} else {
				$errors [] = "Dispositivo {$deviceId} no encontrado";
				$idCliente = 0;
			}
		} else {
			$deviceId = 0;
			$errors [] = "Se necesita id de cliente o de dispositivo";
			$idCliente = 0;
		}
	}
	
	
	file_put_contents("logs/".$idCliente.'_'.$deviceId.'_'.time(), var_export($_REQUEST, true));	
	#'Emisor' => array ('rfc' => 'APR0412108C5', 'nombre' => 'ACTIVIVIENDA PROMOCION SA DE CV', 'Regimen' => 'Régimen General de Ley Personas Morales'),
	
	$datos = array (
		10 => array (
			'noCertificado' => '20001000000100005867',
			'serie' => '',
			'folio' => '',
			'LugarExpedicion' => 'San Alfonso 103 Int 20 Col El Campanario, Zapopan, Jalisco, Mexico',
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
		)
	);
	
	
	if(isset($datos[$idCliente])) {
		$xml_data = $datos[$idCliente];
	} else {
		$errors [] = "Cliente {$idCliente} no registrado.";
	}

	$xml_data['fecha'] = date('Y-m-d').'T'.date('H:i:s');
	
	#FolioFiscalOrig
	#SerieFolioFiscalOrig
	#FechaFolioFiscalOrig
	#MontoFolioFiscalOrig
		
	$requestFields = array ('formaDePago', 'tipoDeComprobante', 'metodoDePago', 'NumCtaPago');
	
	foreach($requestFields as $requestField) {
		if(isset($_REQUEST[$requestField])) {
			$xml_data [$requestField] = $_REQUEST[$requestField];
		} else {
			$xml_data [$requestField] = '';
		}
	}
	
	if(isset($_REQUEST['receptor'])) {
		$receptor = $_REQUEST['receptor'];
	} else {
		$errors [] = "No se enviaron datos de receptor";
		$receptor = "|||||||||||||||";
	}
	
	$receptor = explode('|', $receptor);
	
	list($receptorNombre, $receptorRfc, $receptorCalle, $receptorNoExt, $receptorNoInt, $receptorColonia, $receptorLocalidad,
		$receptorMunicipio, $receptorEstado, $receptorPais, $receptorCodigoPostal) = $receptor;
	
	#idCliente=10&formaDePago=Pago en una sola exhibicion&tipoDeComprobante=ingreso&metodoDePago=No Identificado&
	#receptor=Claudia Yarelih Banderas Flores|BAFC821228H78|San Alfonso|103|20|El Campanario|Zapopan|Zapopan|Jalisco|Mexico|45234&
	#conceptos[]=40|2|pz|Servicios profesionales&
	#impuestos[]=IVA|16.00|12.80
	
	#idCliente=10&formaDePago=Pago en una sola exhibicion&tipoDeComprobante=ingreso&metodoDePago=No Identificado&receptor=Claudia Yarelih Banderas Flores|BAFC821228H78|San Alfonso|103|20|El Campanario|Zapopan|Zapopan|Jalisco|Mexico|45234&conceptos[]=40|2|pz|Servicios profesionales&impuestos[]=IVA|16.00|12.80
	
	$xml_data ['Receptor'] = 
		array ('nombre' => $receptorNombre, 'rfc' => $receptorRfc,
			'Domicilio' => array ('calle' => $receptorCalle,
							'noExterior' => $receptorNoExt, 'noInterior' => $receptorNoInt, 
							'colonia' => $receptorColonia, 'localidad' => $receptorLocalidad,
							'municipio' => $receptorMunicipio, 'estado' => $receptorEstado, 
							'pais' => $receptorPais, 'codigoPostal' => $receptorCodigoPostal));

	$xml_data['Conceptos'] = array ();
	$subtotal = 0;
	
	if(isset($_REQUEST['conceptos'])) {
		foreach($_REQUEST['conceptos'] as $concepto) {
			$concepto = explode('|', $concepto);
			list($valorUnitario, $cantidad, $unidad, $descripcion, $sku) = $concepto;
			
			$importe = round($cantidad * $valorUnitario,2);
			
			$xml_data['Conceptos'][] = array (
				'valorUnitario' => $valorUnitario, 
				'cantidad' => $cantidad, 
				'unidad' => $unidad, 
				'descripcion' => $descripcion, 
				'importe' => $importe,
				'sku' => $sku);
				
			$subtotal += $importe;
		}
	} else {
		$errors [] = "No se especificaron conceptos de facturacion";
	}
	
	$totalImpuestos = 0;
	
	if(isset($_REQUEST["impuestos"])) {
		foreach($_REQUEST['impuestos'] as $impuestoData) {
			$impuestoData = explode('|', $impuestoData);
			list($impuesto, $tasa, $importe) = $impuestoData;
			
			$xml_data['Traslados'][] = array('impuesto' => $impuesto, 'tasa' => $tasa, 'importe' => $importe);
			$totalImpuestos += $importe;
		}
	} else {
		
	}
	
	$xml_data['subTotal'] = $subtotal;
	$xml_data['total'] 	  = $subtotal + $totalImpuestos;
	
	if(count($errors) > 0) {
		$results ["errors"] = $errors;
		$results ["success"] = false;
	} else {
		$xml_filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'xmls' . DIRECTORY_SEPARATOR . $idCliente . '_' . date('YmdHis');
	
		satxmlsv32($xml_data, NULL, $xml_filename);
		
		if(count(SatBepos::$errors) > 0) {
			$results ["errors"] = SatBepos::$errors;
			$results ["success"] = false;
		} else {
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
				
				/* se le pasan los datos de acceso */
				$autentica = new Autenticar();
				$autentica->usuario = "pruebasWS";
				$autentica->contrasena = "pruebasWS";
				
				/* se cacha la respuesta de la autenticacion */
				$responseAutentica = $client->Autenticar($autentica);	
				
				if(isset($responseAutentica->return->token)) {
					/* se manda el xml a timbrar */
					$timbrar = new Timbrar();
					$timbrar->cfd = $XML->saveXML();
					$timbrar->token = $responseAutentica->return->token; 
				
					/* cacha la respuesta */
					$responseTimbre = $client->Timbrar($timbrar);
				
					$results = $responseTimbre->return;
		#var_dump ($results);die ();	
					$rawData = array('xml_data' => $xml_data, 'results' => $results, 'idCliente' => $idCliente, 'cadenaOriginal' => $cadena_original);

					$invoice_id = strtoupper($idCliente . '_' . substr($deviceId,0,3) . substr($deviceId, -3) . '_' . date('YmdHis'));
					
					file_put_contents("facturas/".$invoice_id.'.data', json_encode($rawData));
					
					$results->invoice_id = $invoice_id;
							
					$results->success = true;
					$results->receptor_rfc = $receptorRfc;

					$results->xml_url = 'http://facturacion.bepos.com.mx/factura/xml.php?invoice_id='.$invoice_id;
					$results->pdf_url = 'http://facturacion.bepos.com.mx/factura/factura.php?invoice_id='.$invoice_id;
				} else {
					$results = array ('errors' => 'Error al conectarse a Forgocsa: ' . $responseAutentica->return->mensaje);
					$results['success'] = false;
				}
			} catch (SoapFault $e) {
				$results = array ('errors' => 'Soap Error: ' . $e);
				$results ["success"] = false;
			}
		}
	}
	
	echo json_encode($results);
	die ();
	
class Autenticar{
	public $usuario;
	public $contraseña;
}

class Timbrar{
	public $cfd;
	public $token;
}

