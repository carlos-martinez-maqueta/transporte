<?php
include '../conexion.php';
include '../../class/destination.php';
include '../../core/Security.php';


session_start();
$id = Security::getUserId();

if (isset($_POST['action']) && $_POST['action'] == 'get_all_destination') {
    $result = Destination::getDestinationAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_destination_id') {
    $id = $_POST['resultId'];
    $result = Destination::getDestinationId($id);
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $resultId = $_POST['resultId'];
    $result = Destination::deleteId($resultId);
    
    if ($result->execute()) {
        // Usuario registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El destino se elimino correctamente.'
        );
    } else {
        // Error al registrar usuario
        $response = array(
            'status' => 'error',
            'message' => 'Error al eliminar destino.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}