<?php
require_once 'Conexion.php';

class Prestamo {
    private $conn;

    public function __construct() {
        $db = new Conexion();
        $this->conn = $db->conectar();
    }

    // Crear un prestamo
    public function agregar($libro_id, $usuario_id, $fecha_prestamo) {
        $sql = "INSERT INTO prestamos (libro_id, usuario_id, fecha_prestamo) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iis", $libro_id, $usuario_id, $fecha_prestamo);
        return $stmt->execute();
    }

    // Listar prestamos con info de libro y usuario (no solo los IDs)
    public function listar() {
        $sql = "SELECT p.id, l.titulo, u.nombre, p.fecha_prestamo, p.fecha_devolucion, p.estado
                FROM prestamos p
                JOIN libros l ON p.libro_id = l.id
                JOIN usuarios u ON p.usuario_id = u.id";
        $resultado = $this->conn->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Marcar como devuelto
    public function marcarDevuelto($id, $fecha_devolucion) {
        $sql = "UPDATE prestamos SET estado = 'devuelto', fecha_devolucion = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $fecha_devolucion, $id);
        return $stmt->execute();
    }
}
?>