<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'biblioteca';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
        } catch (PDOException $e) {
            echo "ERROR DE CONEXIÓN: " . $e->getMessage();
        }
        
        return $this->conn;
    }
}