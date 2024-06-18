<?php
include '../conexion.php';
include '../../class/expenses.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id =  !empty($_POST['id']) ? $_POST['id'] : null;
    $nombre =  !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $precio =  !empty($_POST['precio']) ? $_POST['precio'] : null;



    // Editar el resto de los campos
    $result = Expenses::editExpensesId($id, $nombre, $precio);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El egreso se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar egreso.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
