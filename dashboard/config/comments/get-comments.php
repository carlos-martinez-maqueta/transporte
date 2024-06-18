<?php
include '../conexion.php';
include '../../class/home.php';
include '../../core/Security.php';


session_start();
$id = Security::getUserId();

if (isset($_POST['action']) && $_POST['action'] == 'get_all_comments') {
    $result = Home::getCommentsAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_comments_id') {
    $id = $_POST['resultId'];
    $result = Home::getComments1Id($id);
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $resultId = $_POST['resultId'];
    $result = Home::deleteCommentsId($resultId);
    
    if ($result->execute()) {
        // Usuario registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El comentario se elimino correctamente.'
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