<?php
include 'config/conexion.php';

$pasajeroId = $_POST['pasajero_id'];
$estadoAsistencia = $_POST['estado_asistencia'];

// Actualizar la asistencia en la base de datos
$statement = $conn->prepare("UPDATE tbl_reservas_pasajeros SET asistencia = :estado_asistencia WHERE id = :pasajero_id");
$statement->bindParam(':estado_asistencia', $estadoAsistencia);
$statement->bindParam(':pasajero_id', $pasajeroId);
$statement->execute();

echo "Asistencia actualizada correctamente";
?>
