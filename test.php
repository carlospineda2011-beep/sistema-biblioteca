<?php
require_once 'Conexion.php';
$db = new Conexion();
$conn = $db->conectar();
echo "¡Conexión exitosa!";
?>