<?php
  	class Database {
		private static $instance = null;
		private $conn;
		
		private function __construct() {
			try {
				$this->conn = new PDO("mysql:host=localhost;dbname=cultures", "root", "");
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo "Connection failed: " . $e->getMessage();
			}
		}
		
		public static function getInstance() {
			if(!self::$instance) {
				self::$instance = new Database();
			}
			return self::$instance;
		}
		
		public function getConnection() {
			return $this->conn;
		}
	}
?>