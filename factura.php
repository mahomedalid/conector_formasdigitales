<?php

	include_once('config.php');
	
	//Requirements:
	
	// - Put api available to Bepos
	// - Activate modules by device (admin side)
	// - Upload/Update/Create client data (admin side)
	// - Login into admin side
	
	$errors = array ();
	
	$invoice_id = $_REQUEST['invoice_id'];
	$invoice = new Invoice($invoice_id);
	
	$renderer = new InvoiceRenderer($invoice);
	
	$renderer->render ();
	die ();
