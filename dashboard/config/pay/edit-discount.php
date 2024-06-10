<?php
include '../conexion.php';
include '../../class/pay.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id =  !empty($_POST['id']) ? $_POST['id'] : null;
    $porcentaje =  !empty($_POST['porcentaje']) ? $_POST['porcentaje'] : null;
    $uso =  !empty($_POST['uso']) ? $_POST['uso'] : null;
    $estado =  !empty($_POST['estado']) ? $_POST['estado'] : null;


    // Editar el resto de los campos
    $result = Pay::editDiscountId($id, $porcentaje, $uso, $estado);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El cupon de descuento se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar cupon de descuento.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
