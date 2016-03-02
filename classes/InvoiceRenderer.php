<?php

	class InvoiceRenderer
	{
		protected $_invoice = NULL;
		
		public function __construct(Invoice_Interface $invoice) 
		{
			$this->_invoice = $invoice;
		}
		
		public function render ($template = "default")
		{
			extract($this->_invoice->getData());
			include_once("templates/{$template}.php");
		}
	}
	
