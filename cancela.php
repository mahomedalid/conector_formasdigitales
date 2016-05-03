<?php
	
	include_once('config.php');
	
	header('Access-Control-Allow-Origin: *');
	
	$errors = array ();
	
	$db = new DB();
	
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
	
	file_put_contents("logs/".$idCliente.'_'.$deviceId.'_cancelar_'.time(), var_export($_REQUEST, true));

	$client_data = $db->getClientData($idCliente);
	
	if($client_data['estatus'] == 'pruebas') {
		$serv = new FD_Cancelador(FORMAS_DIGITALES_WEBSERVICE_URL_TEST);
		
		$serv->usuario = "pruebasWS";
		$serv->password = "pruebasWS";

	} else if($client_data['estatus'] == 'activo') {
		$serv = new FD_Cancelador(FORMAS_DIGITALES_WEBSERVICE_URL_PROD);
		
		$autentica = new FD_Autenticar();
		$serv->usuario = $client_data['ws_user']  ;
		$serv->password = $client_data['ws_password'] ;

	} else {
		echo json_encode(array("success" => FALSE, "errors" => array("Cuenta no activa")));die ();
	}
	
	$serv->rfc = $client_data['emisor_rfc'];
	$serv->fecha = date('Y-m-d').'T'.date('H:i:s');
	
	if(isset($_REQUEST['invoice_id']) && $_REQUEST['invoice_id']) {
		$invoice_id = $_REQUEST['invoice_id'];
		$invoice = new Invoice($invoice_id);
		
		$data = $invoice->getData();
		$folio = $data['timbres'][0]['UUID'];
	
		$serv->folios = Array(
			0 => $folio //"357A11CE-A3F7-4C81-B01F-F7144F8F8873"
		);	
	} else {
		echo json_encode(array("success" => FALSE, "errors" => array("Id factura a cancelar no especificado o enviado")));die ();
	}
	
	//-------
	$serv->passwordkeys = "12345678a";
	
	$public_key_file = 'sellos/'.$client_data['no_certificado'].'.cer';
	$private_key_file = 'sellos/'.$client_data['no_certificado'].'.key';
	
	$handle = fopen($public_key_file,'r');
	$contents = fread($handle,filesize($public_key_file));
	$serv->publicKey = $contents;
	
	$handle = fopen($private_key_file,'r');
	$contents = fread($handle,filesize($private_key_file));
	$serv->privateKey = $contents;
	
	$serv->process();
	
	if($serv->error != ""){
		echo json_encode(array("success" => FALSE, "errors" => array($serv->error)));die ();
	}else{
		echo json_encode(array("success" => TRUE, "response" => $serv->out));die ();
	}
	/**
	<?xml version="1.0" encoding="UTF-8"?><ns2:CancelaCFDResponse xmlns:ns2="http://cancelacfd.sat.gob.mx" xmlns="http://www.w3.org/2000/09/xmldsig#" xmlns:S="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xml="http://www.w3.org/XML/1998/namespace"><ns2:CancelaCFDResult Fecha="2016-05-03T10:09:01.000-05:00" RfcEmisor="AAA010101AAA"><ns2:Folios><ns2:UUID>313CBD1A-FF11-4EA2-85C2-1FE536BC10DB</ns2:UUID><ns2:EstatusUUID>201</ns2:EstatusUUID></ns2:Folios><Signature Id="SelloSAT"><SignedInfo><CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/><SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#hmac-sha512"/><Reference URI=""><Transforms><Transform Algorithm="http://www.w3.org/TR/1999/REC-xpath-19991116"><XPath>not(ancestor-or-self::*[local-name()='Signature'])</XPath></Transform></Transforms><DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/><DigestValue>GECYnFplkXVfy0riU5tZ7iB4cvMFakwsd8+Kq7Ufg/LKKG7yrPrL70q9haoY5Us3s1jmMbz+YZ3ol8ojCGJybQ==</DigestValue></Reference></SignedInfo><SignatureValue>sz5adLl0Gvq/Er4sjzvrSvjZR2ph9YEJmknRoo2HFQOTts4RY01niwICz14Q96lpWVJOqij2YsRKCUs+5OPTPA==</SignatureValue><KeyInfo><KeyName>20001000000100001696</KeyName><KeyValue><RSAKeyValue><Modulus>ANw/++rKpbTGpJ9sLyJkgweTftxSDwe0A+OeIx36MoRpbqoF6JHLZ8J6yqiGG7TTXtrQVcn8KOTvkKyBXRrnabbhaeWblLR+fmzfdywi4fxF5I/XbrSmSceVzF8Vpj87NeGtl1KvFr9BSa1F+1PLwZeYneRjquVBksALIqzwvzcL</Modulus><Exponent>AQAB</Exponent></RSAKeyValue></KeyValue></KeyInfo></Signature></ns2:CancelaCFDResult></ns2:CancelaCFDResponse>
	**/
	
