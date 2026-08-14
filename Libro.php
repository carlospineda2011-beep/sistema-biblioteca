<?php
require_once 'Conexion.php';

class Libro {
    private $conn;

    public function __construct() {
        $db = new Conexion();
        $this->conn = $db->conectar();
    }

    // Crear
    public function agregar($titulo, $autor, $isbn, $cantidad) {
        $sql = "INSERT INTO libros (titulo, autor, isbn, cantidad) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $titulo, $autor, $isbn, $cantidad);
        return $stmt->execute();
    }

    // Leer todos
    public function listar() {
        $sql = "SELECT * FROM libros";
        $resultado = $this->conn->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Eliminar
    public function eliminar($id) {
        $sql = "DELETE FROM libros WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>