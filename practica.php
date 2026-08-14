<?php
require_once 'Libro.php';
$libro = new Libro();
$libros = $libro->listar();
if ($_SERVER['REQUEST_METHOD']=== 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $cantidad = $_POST['cantidad'];
    $libro->agregar($titulo,$autor,$isbn,$cantidad);
}
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Autor</th>
        <th>isbn</th>
        <th>Cantidad</th>
    </tr>

    <?php foreach ($libros as $l): ?>
<tr>
    <td><?= $l['id']?></td>
    <td><?= $l['titulo']?></td>
    <td><?= $l['autor']?></td>
    <td><?= $l['isbn']?></td>
    <td><?= $l['cantidad']?></td>
</tr>
<?php endforeach; ?>

</table>
<h2>Agregar Libro</h2>
<form method='POST'>
    <label>Titulo:</label>
    <input type='text' name='titulo'><br><br>
    <label>Autor:</label>
    <input type='text' name='autor'><br><br>
    <label>isbn:</label>
    <input type='text' name='isbn'><br><br>
    <label>Cantidad:</label>
    <input type='number' name='cantidad' value='1'>
    <button type='submit'>AgregarLibro</button>
    </form>