<?php
$host ="localhost";
$database ="db_transporte_bajiov2";
$user ="root";
$pass ="";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $pass, array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                    PDO::ATTR_TIMEOUT => "1",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ));
} catch (PDOException $e) {
    die("PDO Connection Error: " . $e->getMessage());
}
?>