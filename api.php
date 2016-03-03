<?php

	include_once('config.php');
	
	header('Access-Control-Allow-Origin: *');
	
	$errors = array ();
	
	$db = new DB();
	
	#array ("browserTest" => 10, '364453d08a2792fb' => 10, '6ed20d2659d9f08e' => 10);
	
	if(isset($_REQUEST['idCliente']) && FALSE) { //DEPRECATED FOR SECURITY
		$idCliente = $_REQUEST['idCliente'];
		$deviceId = 0;
	} else {
		if(isset($_REQUEST['deviceId'])) {
			$deviceId = $_REQUEST['deviceId'];
			$device = $db->getDevice($deviceId);
			
			if($device == FALSE) {
				$errors [] = "Dispositivo {$deviceId} no encontrado";
				$idCliente = 0;
			} else {
				$idCliente = $device["cliente_id"];
			}
		} else {
			$deviceId = 0;
			$errors [] = "Se necesita id de cliente o de dispositivo";
			$idCliente = 0;
		}
	}
	
	file_put_contents("logs/".$idCliente.'_'.$deviceId.'_'.time(), var_export($_REQUEST, true));	
	
	$client_data = $db->getClientData($idCliente);
	
	$xml = new CfdiXml ();
	
	if($client_data) {
		$xml->fillClientData($client_data);
		$xml_data = $xml->getData();
	} else {
		$errors [] = "Cliente {$idCliente} no registrado.";
	}
	
	/*
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
	);*/

	$xml_data['fecha'] = date('Y-m-d').'T'.date('H:i:s');
	
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
			if(count($concepto) > 5) {
				list($valorUnitario, $cantidad, $unidad, $descripcion, $sku) = $concepto;
			} else {
				list($valorUnitario, $cantidad, $unidad, $descripcion) = $concepto;
				$sku = NULL;
			}
			
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
	
	/*if(file_exists("Sellos/".$xml_data["noCertificado"].".pem")) {
		
	}*/
	
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
				
				$filename = $xml_filename . '.xml';

				$XML = new DOMDocument(); 
				$XML->load( $filename ); 
				
				$context = stream_context_create(array(
					'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true
					)
				));
				
				$client = new SoapClient(FORMAS_DIGITALES_WEBSERVICE_URL);
				
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
					
					if(isset($results->cfdi)) {
						$results->invoice_id = $invoice_id;
						$results->success = true;
						
						$results->xml_url = 'http://facturacion.bepos.com.mx/factura/xml.php?invoice_id='.$invoice_id;
						$results->pdf_url = 'http://facturacion.bepos.com.mx/factura/factura.php?invoice_id='.$invoice_id;
						
					} else {
						$results->success = false;
						$results->errors = array ($results->mensaje);
					}
					
					$results->receptor_rfc = $receptorRfc;
				} else {
					$results = array ('errors' => array('Error al conectarse a Forgocsa: ' . $responseAutentica->return->mensaje));
					$results['success'] = false;
				}
			} catch (SoapFault $e) {
				$results = array ('errors' => array('Soap Error: ' . $e));
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