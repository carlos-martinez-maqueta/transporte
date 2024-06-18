<?php
include '../conexion.php';
include '../../class/travel.php';
include '../../core/Security.php';
// Verificar si se recibió un ID válido
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener el ID de la movilidad asociada al viaje
    $statement = $conn->prepare("SELECT movilidad_id FROM tbl_viajes WHERE id=:id");
    $statement->bindValue(":id", $id);
    $statement->execute();
    $movilidad_id = $statement->fetchColumn();

    // Obtener el plantilla_id asociado a la movilidad
    $statement = $conn->prepare("SELECT plantilla_id FROM tbl_movilidad WHERE id=:movilidad_id");
    $statement->bindValue(":movilidad_id", $movilidad_id);
    $statement->execute();
    $plantilla_id = $statement->fetchColumn();

    // Devolver el ID de la plantilla como JSON
    echo json_encode(array('plantilla_id' => $plantilla_id));
} else {
    // Si no se recibió un ID válido, devolver un error
    echo json_encode(array('error' => 'ID inválido'));
}