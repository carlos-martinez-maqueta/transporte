<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_transporte_bajio";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
} catch(PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
    die();
}
?>
