<?php

	class FD_Autenticar{
		public $usuario;
		public $contraseña;
	}

	class FD_Timbrar{
		public $cfd;
		public $token;
	}
	
	class FD_Cancelar {
		public $rfcEmisor;
		public $fecha;
		public $folios;
		public $publicKey;
		public $privateKey;
		public $password;
		public $token;
	}

	class FD_Cancelador{

		var $usuario;
		var $password;
		var $rfc;
		var $fecha;
		var $folios;
		var $publicKey;
		var $privateKey;
		var $passwordkeys;
		
		
		
		var $out;
		var $error;
		var $coderror;
		var $https;
		var $responseAutentica;
		var $Cancelacion_1Response;
		
		function FD_Cancelador($url){
			// Set error message
			$this->error="";
			
			//'https://dev.facturacfdi.mx:8081/WSTimbrado/WSForcogsaService?wsdl'
			$this->https = new SoapClient($url);
		}

		function process(){
			try{
				if($this->usuario==""){
					$this->error="ERROR: El usuario es requerido.";
					return 0;
				}
				if($this->password==""){
					$this->error="ERROR: El password es requerido.";
					return 0;
				}		
				
				/* se le pasan los datos de acceso */
				$autentica = new FD_Autenticar();
				$autentica->usuario = $this->usuario;
				$autentica->contrasena = $this->password;
				
				
				/* se cacha la respuesta de la autenticacion */
				$this->responseAutentica = $this->https->Autenticar($autentica);	
				
				if(isset($this->responseAutentica->return->mensaje)){
					$this->error = $this->responseAutentica->return->mensaje;
				}else{
					/* se manda el xml a timbrar */
					$cancela1 = new FD_Cancelar();
					$cancela1->rfcEmisor = $this->rfc;
					$cancela1->token = $this->responseAutentica->return->token; 
					$cancela1->fecha = $this->fecha; 
					$cancela1->folios = $this->folios; 
					$cancela1->password = $this->passwordkeys; 
					$cancela1->publicKey = $this->publicKey; 
					$cancela1->privateKey = $this->privateKey; 
					
					/* cacha la respuesta */
					$this->Cancelacion_1Response = $this->https->Cancelacion_1($cancela1);
									
					if(isset($this->Cancelacion_1Response->return->mensaje)){
						$this->error = $this->Cancelacion_1Response->return->mensaje;
					}else{
						$this->out = $this->Cancelacion_1Response->return->acuse;
					}			
				}
			} catch (SoapFault $e) {
				$this->error = $e->getMessage();
			}		
		}	
	}
