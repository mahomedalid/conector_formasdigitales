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
	
	$public_key_file = "";
	
	$handle = fopen('archivosPEM/AAA010101AAA__csd_01.cer','r');
	$contents = fread($handle,filesize("archivosPEM/AAA010101AAA__csd_01.cer"));
	$serv->publicKey = $contents;
	
	$private_key_file = "";
	
	$handle = fopen('archivosPEM/AAA010101AAA__csd_01.key','r');
	$contents = fread($handle,filesize("archivosPEM/AAA010101AAA__csd_01.key"));
	$serv->privateKey = $contents;
	
	$serv->process();
	
	if($serv->error != ""){
		echo "Error**** <br>";
		echo $serv->error . "<br>";
		exit;
	}else{
		echo htmlentities($serv->out) . "<br>";
		exit;
	}
	
	
