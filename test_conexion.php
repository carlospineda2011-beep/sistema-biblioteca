<?php
echo "Paso 1: antes del require<br>";
require_once 'classes/Database.php';
echo "Paso 2: después del require<br>";

try {
    $db = new Database();
    echo "Paso 3: objeto Database creado<br>";
    $conn = $db->getConnection();
    echo "Paso 4: getConnection ejecutado<br>";
    var_dump($conn);
} catch (PDOException $e) {
    echo "ERROR PDO: " . $e->getMessage();
} catch (Exception $e) {
    echo "ERROR GENERAL: " . $e->getMessage();
}