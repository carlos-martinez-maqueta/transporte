<?php
include '../conexion.php';
include '../../class/travel.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id =  !empty($_POST['id']) ? $_POST['id'] : null;
    $origin_id =  !empty($_POST['origin_id']) ? $_POST['origin_id'] : null;
    $destino_id =  !empty($_POST['destino_id']) ? $_POST['destino_id'] : null;
    $movilidad_id =  !empty($_POST['movilidad_id']) ? $_POST['movilidad_id'] : null;
    $fecha_inicio =  !empty($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : null;
    $fecha_fin =  !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
    $estado =  !empty($_POST['estado']) ? $_POST['estado'] : null;




    // Editar el resto de los campos
    $result = Travel::editTravelId($id, $origin_id, $destino_id, $movilidad_id, $fecha_inicio, $fecha_fin, $estado);


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
