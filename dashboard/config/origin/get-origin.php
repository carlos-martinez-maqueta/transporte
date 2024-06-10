<?php
include '../conexion.php';
include '../../class/origin.php';
include '../../core/Security.php';


session_start();
$id = Security::getUserId();

if (isset($_POST['action']) && $_POST['action'] == 'get_all_origin') {
    $result = Origin::getOriginAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_origin_id') {
    $id = $_POST['resultId'];
    $result = Origin::getOriginId($id);
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $resultId = $_POST['resultId'];
    $result = Origin::deleteId($resultId);
    
    if ($result->execute()) {
        // Usuario registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El origen se elimino correctamente.'
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