<?php

	date_default_timezone_set('America/Los_Angeles');
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
	
	$invoice_id = $_REQUEST['invoice_id'];
	
	$data = (file_get_contents('facturas/'.$invoice_id.'.data'));
	$data = json_decode($data);
	#var_dump ($data->results);die ();
	$cfdi = new SimpleXMLElement($data->results->cfdi);
	#$dom = new DOMDocument();
	#$dom->loadXML($data->results->cfdi);
	$cfdi->registerXpathNamespace('tfd', 'http://www.sat.gob.mx/TimbreFiscalDigital');
	$timbres = $cfdi->xpath('//cfdi:Complemento/tfd:TimbreFiscalDigital');
	#var_dump ($data->results->cfdi);die ();
	$factura = $data;
	
	include_once('templates/default.php');
	
	die ();
