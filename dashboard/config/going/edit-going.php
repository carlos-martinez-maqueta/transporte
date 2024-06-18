<?php
include '../conexion.php';
include '../../class/going.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id =  !empty($_POST['id']) ? $_POST['id'] : null;
   
    $origen =  !empty($_POST['origen']) ? $_POST['origen'] : null;
    $destino =  !empty($_POST['destino']) ? $_POST['destino'] : null;
    $hora_salida =  !empty($_POST['hora_salida']) ? $_POST['hora_salida'] : null;
    $hora_llegada =  !empty($_POST['hora_llegada']) ? $_POST['hora_llegada'] : null;
    $tiempo_estimado =  !empty($_POST['tiempo_estimado']) ? $_POST['tiempo_estimado'] : null;
    $precio =  !empty($_POST['precio']) ? $_POST['precio'] : null;
    $reserva =  !empty($_POST['reserva']) ? $_POST['reserva'] : null;
    $estado =  !empty($_POST['estado']) ? $_POST['estado'] : null;



    // Editar el resto de los campos
    $result = Going::editGoingId($id, $origen, $destino, $hora_salida, $hora_llegada, $tiempo_estimado, $precio, $reserva, $estado);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El punto se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar punto.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
