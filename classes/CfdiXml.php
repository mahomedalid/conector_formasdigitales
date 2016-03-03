<?php

	class CfdiXml
	{
		protected $_xml_data = array ();
		
		public function __construct ()
		{
		}
		
		public function fillClientData ($client_data)
		{
			$this->_xml_data = array (
				'noCertificado' => $client_data['no_certificado'],
				'serie' => $client_data['serie'],
				'folio' => $client_data['folio'],
				'LugarExpedicion' => $client_data['lugar_expedicion'],
				'Emisor' => array (
						'rfc' => $client_data['emisor_rfc'], 
						'nombre' => $client_data['emisor_nombre'], 
						'Regimen' => $client_data['emisor_regimen'],
					'Domicilio' => array (
						"calle"=> $client_data['emisor_calle'],
						"noExterior"=> $client_data['emisor_no_exterior'],
						"noInterior"=> $client_data['emisor_no_interior'],
						"colonia"=>$client_data['emisor_colonia'],
						"municipio" => $client_data['emisor_municipio'],
						"estado"=>$client_data['emisor_estado'],
						"pais"=>$client_data['emisor_pais'],
						"codigoPostal"=>$client_data['emisor_codigo_postal']
					)
				)
			);
		}
		
		public function getData ()
		{
			return $this->_xml_data;
		}
	}