<?php
require_once 'Conexion.php';

class Usuario {
    private $conn;

    public function __construct() {
        $db = new Conexion();
        $this->conn = $db->conectar();
    }

    // Crear
    public function agregar($nombre, $email, $telefono) {
        $sql = "INSERT INTO usuarios (nombre, email, telefono) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $email, $telefono);
        return $stmt->execute();
    }

    // Leer todos
    public function listar() {
        $sql = "SELECT * FROM usuarios";
        $resultado = $this->conn->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Eliminar
    public function eliminar($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>