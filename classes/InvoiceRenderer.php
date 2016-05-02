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
			include_once(dirname(__FILE__) . "/../templates/{$template}.php");
		}
	}
	
