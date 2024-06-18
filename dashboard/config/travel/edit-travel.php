<?php
include '../conexion.php';
include '../../class/travel.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id =  !empty($_POST['id']) ? $_POST['id'] : null;
    $hora_salida =  !empty($_POST['hora_salida']) ? $_POST['hora_salida'] : null;
    $fecha_salida =  !empty($_POST['fecha_salida']) ? $_POST['fecha_salida'] : null;
    $estado =  !empty($_POST['estado']) ? $_POST['estado'] : null;




    // Editar el resto de los campos
    $result = Travel::editTravelId($id, $hora_salida, $fecha_salida, $estado);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El viaje se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar viaje.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
