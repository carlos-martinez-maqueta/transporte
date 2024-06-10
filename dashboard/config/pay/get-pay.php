<?php
include '../conexion.php';
include '../../class/pay.php';
include '../../core/Security.php';


session_start();
$id = Security::getUserId();

if (isset($_POST['action']) && $_POST['action'] == 'get_all_discount') {
    $result = Pay::getDiscountAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_discount_id') {
    $id = $_POST['resultId'];
    $result = Pay::getDiscountId($id);
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $resultId = $_POST['resultId'];
    $result = Pay::deleteId($resultId);
    
    if ($result->execute()) {
        // Usuario registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El cupon de descuento se elimino correctamente.'
        );
    } else {
        // Error al registrar usuario
        $response = array(
            'status' => 'error',
            'message' => 'Error al eliminar origen.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}