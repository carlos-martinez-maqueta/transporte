<?php
include '../conexion.php';
include '../../class/origin.php';
include '../../class/home.php';
include '../../core/Security.php';


session_start();
$id = Security::getUserId();

if (isset($_POST['action']) && $_POST['action'] == 'get_all_best') {
    $result = Home::getBestAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_best_id') {
    $id = $_POST['resultId'];
    $result = Home::getSection1Id($id);
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $resultId = $_POST['resultId'];
    $result = Home::deleteId($resultId);
    
    if ($result->execute()) {
        // Usuario registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El mejor destino se elimino correctamente.'
        );
    } else {
        // Error al registrar usuario
        $response = array(
            'status' => 'error',
            'message' => 'Error al eliminar.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}