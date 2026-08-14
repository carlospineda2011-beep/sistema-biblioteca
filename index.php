<?php
require_once 'Libro.php';
require_once 'Usuario.php';
require_once 'Prestamo.php';

$libro = new Libro();
$usuario = new Usuario();
$prestamo = new Prestamo();

// Agregar libro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_libro'])) {
    $libro->agregar($_POST['titulo'], $_POST['autor'], $_POST['isbn'], $_POST['cantidad']);
}

// Agregar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_usuario'])) {
    $usuario->agregar($_POST['nombre'], $_POST['email'], $_POST['telefono']);
}

// Agregar prestamo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_prestamo'])) {
    $prestamo->agregar($_POST['libro_id'], $_POST['usuario_id'], $_POST['fecha_prestamo']);
}

// Traer datos actualizados
$libros = $libro->listar();
$usuarios = $usuario->listar();
$prestamos = $prestamo->listar();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Biblioteca</title>
</head>
<body>
    <h1>Sistema de Biblioteca</h1>

    <h2>Agregar Libro</h2>
    <form method="POST">
        <label>Titulo:</label>
        <input type="text" name="titulo" required><br><br>
        <label>Autor:</label>
        <input type="text" name="autor" required><br><br>
        <label>ISBN:</label>
        <input type="text" name="isbn"><br><br>
        <label>Cantidad:</label>
        <input type="number" name="cantidad" value="1"><br><br>
        <button type="submit" name="agregar_libro">Agregar Libro</button>
    </form>

    <h2>Lista de Libros</h2>
    <table border="1" cellpadding="5">
        <tr><th>ID</th><th>Titulo</th><th>Autor</th><th>ISBN</th><th>Cantidad</th></tr>
        <?php foreach ($libros as $l): ?>
        <tr>
            <td><?= $l['id'] ?></td>
            <td><?= $l['titulo'] ?></td>
            <td><?= $l['autor'] ?></td>
            <td><?= $l['isbn'] ?></td>
            <td><?= $l['cantidad'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <hr>

    <h2>Agregar Usuario</h2>
    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Telefono:</label>
        <input type="text" name="telefono"><br><br>
        <button type="submit" name="agregar_usuario">Agregar Usuario</button>
    </form>

    <h2>Lista de Usuarios</h2>
    <table border="1" cellpadding="5">
        <tr><th>ID</th><th>Nombre</th><th>Email</th><th>Telefono</th></tr>
        <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= $u['nombre'] ?></td>
            <td><?= $u['email'] ?></td>
            <td><?= $u['telefono'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <hr>

    <h2>Registrar Prestamo</h2>
    <form method="POST">
        <label>Libro:</label>
        <select name="libro_id" required>
            <option value="">-- Elige un libro --</option>
            <?php foreach ($libros as $l): ?>
                <option value="<?= $l['id'] ?>"><?= $l['titulo'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Usuario:</label>
        <select name="usuario_id" required>
            <option value="">-- Elige un usuario --</option>
            <?php foreach ($usuarios as $u): ?>
                <option value="<?= $u['id'] ?>"><?= $u['nombre'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Fecha de prestamo:</label>
        <input type="date" name="fecha_prestamo" required><br><br>

        <button type="submit" name="agregar_prestamo">Registrar Prestamo</button>
    </form>

    <h2>Lista de Prestamos</h2>
    <table border="1" cellpadding="5">
        <tr><th>ID</th><th>Libro</th><th>Usuario</th><th>Fecha Prestamo</th><th>Fecha Devolucion</th><th>Estado</th></tr>
        <?php foreach ($prestamos as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['titulo'] ?></td>
            <td><?= $p['nombre'] ?></td>
            <td><?= $p['fecha_prestamo'] ?></td>
            <td><?= $p['fecha_devolucion'] ?? '-' ?></td>
            <td><?= $p['estado'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>