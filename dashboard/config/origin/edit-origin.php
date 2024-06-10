<?php
include '../conexion.php';
include '../../class/origin.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id =  !empty($_POST['id']) ? $_POST['id'] : null;
    $nombre =  !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $estado =  !empty($_POST['estado']) ? $_POST['estado'] : null;



    // Verificar si el correo y celular ya existen para otros usuarios
    $query = "SELECT * FROM tbl_origen WHERE (nombre = :nombre) AND id != :id";
    $stmtExiste = $conn->prepare($query);
    $stmtExiste->bindParam(':nombre', $nombre);
    $stmtExiste->bindParam(':id', $id);
    $stmtExiste->execute();
    $userList = $stmtExiste->fetchAll(PDO::FETCH_OBJ);

    if ($stmtExiste->rowCount() > 0) {
        $mensaje = [];
        foreach ($userList as $user) {
            if ($user->nombre == $nombre) {
                $mensaje[] = "El orige {$nombre} ";
            }
        }

        // El correo o el celular ya existen para otro usuario, envía un mensaje de error
        $response = array(
            'status' => 'error',
            'message' => implode(', ', $mensaje) . ' ya está registrado para otro origen.'
        );

        // Codificar el array a formato JSON
        echo json_encode($response);

        exit;
    }


    // Editar el resto de los campos
    $result = Origin::editOriginId($id, $nombre, $estado);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El origen se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar origen.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
