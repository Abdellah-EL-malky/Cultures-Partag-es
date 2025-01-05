<?php
class Database {
    private static $instance = null;
    private $conn;
    private $error = null;
    
    private $host = 'localhost';
    private $dbname = 'culture';
    private $username = 'root';
    private $password = '';
    
    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ];
            
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            error_log("Erreur de connexion: " . $e->getMessage());
            throw new Exception("Impossible de se connecter à la base de données");
        }
    }
    
    public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    public function getError() {
        return $this->error;
    }
    
    public function testConnection() {
        try {
            $this->conn->query('SELECT 1');
            return true;
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }
    
    private function __clone() {}
    private function __wakeup() {}
}

function handleDatabaseError($e) {
    error_log($e->getMessage());
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Une erreur est survenue avec la base de données']);
    exit;
}