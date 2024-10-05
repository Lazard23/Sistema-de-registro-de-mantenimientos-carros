<?php
require_once 'config/database.php'; 

$database = new Database();
$db = $database->getConnection();

if ($db) {
    echo "Conexión a la base de datos exitosa.";
} else {
    echo "Error al conectar a la base de datos.";
}
?>
