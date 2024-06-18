<?php
include '../conexion.php';
include '../../class/pay.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $porcentaje =  !empty($_POST['porcentaje']) ? $_POST['porcentaje'] : null;
    $uso =  !empty($_POST['uso']) ? $_POST['uso'] : null;


    // Editar el resto de los campos
    $result = Pay::addDiscounts($porcentaje, $uso, $referencia_id);


    if ($result) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El cupon de descuento se agregó correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar el cupon de descuento.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
