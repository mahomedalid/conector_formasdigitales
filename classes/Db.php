<?php

	class Db 
	{
		protected $_connection = NULL;
		
		public function __construct ()
		{
			$this->connect();
		}
		
		public function connect ()
		{
			if($this->_connection) {
				
			} else {
				$this->_connection = new PDO(DB_STRING, DB_USER, DB_PASSWORD);
			}
			
			return $this->_connection;
		}
		
		public function getDevices ()
		{
			$stmt = $this->_connection->query("SELECT id, cliente_id FROM dispositivo");
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function getDevice ($device_id)
		{
			$stmt = $this->_connection->prepare("SELECT id, cliente_id FROM dispositivo WHERE id = ?");
			$stmt->execute(array($device_id));
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		
		public function getClientData ($client_id)
		{
			$stmt = $this->_connection->prepare("SELECT * FROM cliente WHERE cliente_id = ?");
			$stmt->execute(array($client_id));
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
	}
