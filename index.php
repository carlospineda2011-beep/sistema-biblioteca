<?php
require_once 'classes/Biblioteca.php';

// TODO: Instanciar la clase Biblioteca
$biblioteca = new Biblioteca();
$action = $_GET['action'] ?? 'libros';
if ($action === 'libros' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $libro = new Libro($_POST['titulo'], $_POST['autor'], $_POST['isbn'], $_POST['cantidad']);
    $biblioteca->agregarLibro($libro);
}

$libros = $biblioteca->obtenerLibros();

if ($action === 'usuarios' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($_POST['nombre'], $_POST['email'], $_POST['telefono']);
    $biblioteca->agregarUsuario($usuario);
}

$usuarios = $biblioteca->obtenerUsuarios();

if ($action === 'prestamos' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['prestar'])) {
        $biblioteca->prestarLibro($_POST['libro_id'], $_POST['usuario_id']);
    }
    if (isset($_POST['devolver'])) {
        $biblioteca->devolverLibro($_POST['prestamo_id']);
    }
}

$prestamos = $biblioteca->obtenerPrestamosActivos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Biblioteca</title>
    <style>
        /* TODO: Agregar estilos CSS */
        body { font-family: Arial, sans-serif; margin: 20px; }
        nav { margin-bottom: 20px; background: #eee; padding: 10px; }
        nav a { margin-right: 15px; text-decoration: none; color: #333; }
        .container { max-width: 800px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Biblioteca Mini-App</h1>
        
        <nav>
            <a href="index.php">Inicio / Libros</a>
            <a href="index.php?action=usuarios">Usuarios</a>
            <a href="index.php?action=prestamos">Préstamos</a>
        </nav>
        <div id="content">
        <?php if ($action === 'libros'): ?>
            
            <h2>Agregar Libro</h2>
            <form method="POST">
                <label>Título:</label>
                <input type="text" name="titulo" required><br><br>
                <label>Autor:</label>
                <input type="text" name="autor" required><br><br>
                <label>ISBN:</label>
                <input type="text" name="isbn"><br><br>
                <label>Cantidad:</label>
                <input type="number" name="cantidad" value="1"><br><br>
                <button type="submit">Agregar Libro</button>
            </form>

            <h2>Lista de Libros</h2>
            <table border="1" cellpadding="5">
                <tr><th>ID</th><th>Título</th><th>Autor</th><th>ISBN</th><th>Cantidad</th></tr>
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

        <?php elseif ($action === 'usuarios'): ?>

            <h2>Agregar Usuario</h2>
            <form method="POST">
                <label>Nombre:</label>
                <input type="text" name="nombre" required><br><br>
                <label>Email:</label>
                <input type="email" name="email" required><br><br>
                <label>Teléfono:</label>
                <input type="text" name="telefono"><br><br>
                <button type="submit">Agregar Usuario</button>
            </form>

            <h2>Lista de Usuarios</h2>
            <table border="1" cellpadding="5">
                <tr><th>ID</th><th>Nombre</th><th>Email</th><th>Teléfono</th></tr>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= $u['nombre'] ?></td>
                    <td><?= $u['email'] ?></td>
                    <td><?= $u['telefono'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

        <?php elseif ($action === 'prestamos'): ?>

            <h2>Registrar Préstamo</h2>
            <form method="POST">
                <label>Libro:</label>
                <select name="libro_id" required>
                    <option value="">-- Elegí un libro --</option>
                    <?php foreach ($libros as $l): ?>
                        <option value="<?= $l['id'] ?>"><?= $l['titulo'] ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <label>Usuario:</label>
                <select name="usuario_id" required>
                    <option value="">-- Elegí un usuario --</option>
                    <?php foreach ($usuarios as $u): ?>
                        <option value="<?= $u['id'] ?>"><?= $u['nombre'] ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <button type="submit" name="prestar">Registrar Préstamo</button>
            </form>

            <h2>Préstamos Activos</h2>
            <table border="1" cellpadding="5">
                <tr><th>ID</th><th>Libro</th><th>Usuario</th><th>Fecha Préstamo</th><th>Acción</th></tr>
                <?php foreach ($prestamos as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= $p['titulo'] ?></td>
                    <td><?= $p['nombre'] ?></td>
                    <td><?= $p['fecha_prestamo'] ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="prestamo_id" value="<?= $p['id'] ?>">
                            <button type="submit" name="devolver">Devolver</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

        <?php endif; ?>
        </div>

    </div>
</body>
</html>