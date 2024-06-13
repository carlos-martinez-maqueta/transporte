<?php
include '../conexion.php';
include '../../class/expenses.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $nombre =  !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $precio =  !empty($_POST['precio']) ? $_POST['precio'] : null;



    // Editar el resto de los campos
    $result = Expenses::addExpenses($nombre,$precio);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El egreso se agregó correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar egreso.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
