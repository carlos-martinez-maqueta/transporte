<?php
include '../conexion.php';
include '../../class/mobility.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $matricula =  !empty($_POST['matricula']) ? $_POST['matricula'] : null;
    $marca =  !empty($_POST['marca']) ? $_POST['marca'] : null;
    $modelo =  !empty($_POST['modelo']) ? $_POST['modelo'] : null;
    $color =  !empty($_POST['color']) ? $_POST['color'] : null;
    $cantidad_asientos =  !empty($_POST['cantidad_asientos']) ? $_POST['cantidad_asientos'] : null;
    $tipo_vehiculo =  !empty($_POST['tipo_vehiculo']) ? $_POST['tipo_vehiculo'] : null;



    // Editar el resto de los campos
    $result = Mobility::addMobility($matricula, $marca, $modelo, $color, $cantidad_asientos, $tipo_vehiculo);


    if ($result->execute()) {

        $lastInsertedId = $conn->lastInsertId();

         // Verificar si se envió una nueva imagen
         if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
            // Generar un nombre único para el archivo
            $nombreArchivoUnico = uniqid('image_', true) . '.' . pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
            $rutaDestino = "../../files/mobility/" . $nombreArchivoUnico;

            // Guardar la imagen en la ruta especificada
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino)) {
                // Editar la imagen solo si se guardó correctamente
                $imagen = $nombreArchivoUnico;
                $result2 = Mobility::editImageMobility($lastInsertedId, $imagen);
                $result2->execute();
            }
        }


        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'La movilidad se agregó correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar movilidad.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
