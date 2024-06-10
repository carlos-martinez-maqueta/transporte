<?php
include '../conexion.php';
include '../../class/user.php';
include '../../core/Security.php';
include '../../lib-qr/barcode.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $nombre =  !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $apellidos =  !empty($_POST['apellidos']) ? $_POST['apellidos'] : null;
    $correo =  !empty($_POST['correo']) ? $_POST['correo'] : null;
    $celular =  !empty($_POST['celular']) ? $_POST['celular'] : null;
    $pass =  !empty($_POST['pass']) ? $_POST['pass'] : null;
    $origen = 'ADMINISTRACION';


    // Verificación de duplicados
    $query = "SELECT * FROM tbl_usuarios WHERE correo = :correo OR celular = :celular";
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
    $result = User::addUser($nombre, $apellidos, $correo, $celular, $pass, $referencia_id, $origen);


    if ($result->execute()) {

        $user_id = $conn->lastInsertId();



        // Generar y guardar el código QR
        $qr_folder = __DIR__ . '../../qr_codes/';

        $generator = new barcode_generator();
        header('Content-Type: image/svg+xml');
        $svg = $generator->render_svg("qr", "https://transportesafe.com/user/?user=$user_id", ""); //cambiar donde este la vista para que aparezca los detalles del usuario

        $qr_filename = "qr_code_$user_id.svg";
        $qr_filepath = $qr_folder . $qr_filename;

        file_put_contents($qr_filepath, $svg);

        $result2 = User::updateUserQrId($user_id, $qr_filename);
        $result2->execute();


        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El usuario se agregó correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar usuario.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
