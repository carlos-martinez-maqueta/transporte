<?php
include '../conexion.php';
include '../../class/destination.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $nombre =  !empty($_POST['nombre']) ? $_POST['nombre'] : null;


    // Verificación de duplicados
    $query = "SELECT * FROM tbl_destino WHERE nombre = :nombre";
    $stmtExiste = $conn->prepare($query);
    $stmtExiste->bindParam(':nombre', $nombre);
    $stmtExiste->execute();
    $userList = $stmtExiste->fetchAll(PDO::FETCH_OBJ);

    if ($stmtExiste->rowCount() > 0) {
        $mensaje = [];
        foreach ($userList as $user) {
            if ($user->nombre == $nombre) {
                $mensaje[] = "El destino {$nombre}";
            }
        }

        // El nombre ya existe, envía un mensaje de error
        $response = array(
            'status' => 'error',
            'message' => implode(', ', $mensaje) . ' ya está registrado.'
        );

        // Codificar el array a formato JSON
        echo json_encode($response);

        exit;
    }


    // Editar el resto de los campos
    $result = Destination::addDestination($nombre);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El destino se agregó correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar destino.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
