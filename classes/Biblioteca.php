<?php
require_once 'Database.php';
require_once 'Libro.php';
require_once 'Usuario.php';
require_once 'Prestamo.php';

class Biblioteca {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Gestión de Libros
    public function agregarLibro(Libro $libro) {
    $sql = "INSERT INTO libros (titulo, autor, isbn, cantidad) VALUES (:titulo, :autor, :isbn, :cantidad)";
    $stmt = $this->conn->prepare($sql);
    $titulo = $libro->getTitulo();
    $autor = $libro->getAutor();
    $isbn = $libro->getIsbn();
    $cantidad = $libro->getCantidad();
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':autor', $autor);
    $stmt->bindParam(':isbn', $isbn);
    $stmt->bindParam(':cantidad', $cantidad);
    return $stmt->execute();
}

    public function editarLibro($id, $nuevosDatos) {
    $sql = "UPDATE libros SET titulo = :titulo, autor = :autor, isbn = :isbn, cantidad = :cantidad WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':titulo', $nuevosDatos['titulo']);
    $stmt->bindParam(':autor', $nuevosDatos['autor']);
    $stmt->bindParam(':isbn', $nuevosDatos['isbn']);
    $stmt->bindParam(':cantidad', $nuevosDatos['cantidad']);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

    public function eliminarLibro($id) {
        $sql = "DELETE FROM libros WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function obtenerLibros() {
        $sql = "SELECT * FROM libros";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function buscarLibro($id) {
        $sql = "SELECT * FROM libros WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Gestión de Usuarios
    public function agregarUsuario(Usuario $usuario) {
    $sql = "INSERT INTO Usuarios (nombre, email, telefono) VALUES (:nombre, :email, :telefono)";
    $stmt = $this->conn->prepare($sql);
    $nombre = $usuario->getNombre();
    $email = $usuario->getEmail();
    $telefono = $usuario->getTelefono();
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);
    return $stmt->execute();
    }

    public function editarUsuario($id, $nuevosDatos) {
        $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, telefono = :telefono WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':nombre', $nuevosDatos['nombre']);
    $stmt->bindParam(':email', $nuevosDatos['email']);
    $stmt->bindParam(':telefono', $nuevosDatos['telefono']);
    return $stmt->execute();
    }

    public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function obtenerUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    // Gestión de Préstamos
    public function prestarLibro($libro_id, $usuario_id) {
        $sql = "INSERT INTO prestamos (libro_id, usuario_id, fecha_prestamo, estado) VALUES (:libro_id, :usuario_id, :fecha_prestamo, :estado)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':libro_id', $libro_id);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $fecha = date('Y-m-d');
        $stmt->bindParam(':fecha_prestamo', $fecha);
        $estado = 'activo';
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();
        $sql2 = "UPDATE libros SET cantidad = cantidad - 1 WHERE id = :libro_id";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->bindParam(':libro_id', $libro_id);
        return $stmt2->execute();
    }

    public function devolverLibro($prestamo_id) {
        $sql = "SELECT libro_id FROM prestamos WHERE id = :prestamo_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':prestamo_id', $prestamo_id);
        $stmt->execute();
        $prestamo = $stmt->fetch(PDO::FETCH_ASSOC);
        $libro_id = $prestamo['libro_id'];
        $sql2 = "UPDATE prestamos SET fecha_devolucion = :fecha, estado = 'devuelto' WHERE id = :prestamo_id";
        $stmt2 = $this->conn->prepare($sql2);
        $fecha = date('Y-m-d');
        $stmt2->bindParam(':fecha', $fecha);
        $stmt2->bindParam(':prestamo_id', $prestamo_id);
        $stmt2->execute();
        $sql3 = "UPDATE libros SET cantidad = cantidad + 1 WHERE id = :libro_id";
        $stmt3 = $this->conn->prepare($sql3);
        $stmt3->bindParam(':libro_id', $libro_id);
        return $stmt3->execute();
    }

    public function obtenerPrestamosActivos() {
           $sql = "SELECT p.id, l.titulo, u.nombre, p.fecha_prestamo, p.estado
            FROM prestamos p
            JOIN libros l ON p.libro_id = l.id
            JOIN usuarios u ON p.usuario_id = u.id
            WHERE p.estado = 'activo'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}