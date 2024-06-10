<?php
include '../conexion.php';
include '../../class/staff.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $nombre =  !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $apellidos =  !empty($_POST['apellidos']) ? $_POST['apellidos'] : null;
    $correo =  !empty($_POST['correo']) ? $_POST['correo'] : null;
    $celular =  !empty($_POST['celular']) ? $_POST['celular'] : null;
    $rol_id =  !empty($_POST['rol_id']) ? $_POST['rol_id'] : null;
    $pass =  !empty($_POST['pass']) ? $_POST['pass'] : null;


    // Verificación de duplicados
    $query = "SELECT * FROM tbl_personal WHERE correo = :correo OR celular = :celular";
    $stmtExiste = $conn->prepare($query);
    $stmtExiste->bindParam(':correo', $correo);
    $stmtExiste->bindParam(':celular', $celular);
    $stmtExiste->execute();
    $userList = $stmtExiste->fetchAll(PDO::FETCH_OBJ);

    if ($stmtExiste->rowCount() > 0) {
        $mensaje = [];
        foreach ($userList as $user) {
            if ($user->correo == $correo) {
                $mensaje[] = "El correo {$correo}";
            }
            if ($user->celular == $celular) {
                $mensaje[] = "El Celular {$celular}";
            }
        }

        // El correo o el celular ya existe, envía un mensaje de error
        $response = array(
            'status' => 'error',
            'message' => implode(', ', $mensaje) . ' ya está registrado.'
        );

        // Codificar el array a formato JSON
        echo json_encode($response);

        exit;
    }


    // Editar el resto de los campos
    $result = Staff::addStaff($nombre, $apellidos, $correo, $celular, $rol_id, $pass, $referencia_id);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El Staff se agregó correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar Staff.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
