<?php

	interface Invoice_Interface
	{
		
	}
	
	class Invoice implements Invoice_Interface
	{
		protected $_id = "";
		
		protected $_data = array('factura' => NULL, 'timbres' => '', 'cfdi' => '', 'invoice_id' => 0);
		
		public function __construct ($id)
		{
			$this->_id = $id;
			$this->_data['invoice_id'] = $id;
		}
		
		public function loadData ()
		{
			$data = (file_get_contents(INVOICE_DATA_FOLDER . DIRECTORY_SEPARATOR . $this->_id . '.data'));
			$data = json_decode($data);
			
			$cfdi = new SimpleXMLElement($data->results->cfdi);
			
			#var_dump ($data->results);die ();
	
			#$dom = new DOMDocument();
			#$dom->loadXML($data->results->cfdi);
			$cfdi->registerXpathNamespace('tfd', 'http://www.sat.gob.mx/TimbreFiscalDigital');
			
			$timbres = $cfdi->xpath('//cfdi:Complemento/tfd:TimbreFiscalDigital');
			
			#var_dump ($data->results->cfdi);die ();
			$this->_data['factura'] = $data;
			$this->_data['timbres'] = $timbres;
			$this->_data['cfdi'] = $cfdi;
		}
		
		public function getData ()
		{
			$this->loadData();
			return $this->_data;
		}
	}
