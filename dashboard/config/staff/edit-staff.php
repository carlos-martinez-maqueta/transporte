<?php
include '../conexion.php';
include '../../class/staff.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id =  !empty($_POST['id']) ? $_POST['id'] : null;
    $nombre =  !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $apellidos =  !empty($_POST['apellidos']) ? $_POST['apellidos'] : null;
    $correo =  !empty($_POST['correo']) ? $_POST['correo'] : null;
    $celular =  !empty($_POST['celular']) ? $_POST['celular'] : null;
    $estado =  !empty($_POST['estado']) ? $_POST['estado'] : null;
    $pass =  !empty($_POST['pass']) ? $_POST['pass'] : null;


    // Verificar si el correo y celular ya existen para otros usuarios
    $query = "SELECT * FROM tbl_personal WHERE (correo = :correo OR celular = :celular) AND id != :id";
    $stmtExiste = $conn->prepare($query);
    $stmtExiste->bindParam(':correo', $correo);
    $stmtExiste->bindParam(':celular', $celular);
    $stmtExiste->bindParam(':id', $id);
    $stmtExiste->execute();
    $userList = $stmtExiste->fetchAll(PDO::FETCH_OBJ);

    if ($stmtExiste->rowCount() > 0) {
        $mensaje = [];
        foreach ($userList as $user) {
            if ($user->correo == $correo) {
                $mensaje[] = "El correo {$correo} ";
            }
            if ($user->celular == $celular) {
                $mensaje[] = "El Celular {$celular} ";
            }
        }

        // El correo o el celular ya existen para otro usuario, envía un mensaje de error
        $response = array(
            'status' => 'error',
            'message' => implode(', ', $mensaje) . ' ya está registrado para otro usuario.'
        );

        // Codificar el array a formato JSON
        echo json_encode($response);

        exit;
    }


    // Editar el resto de los campos
    $result = Staff::editStaffId($id, $nombre, $apellidos, $correo, $celular, $estado, $pass);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El Staff se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar Staff.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
