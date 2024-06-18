<?php
include '../conexion.php';
include '../../class/home.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = !empty($_POST['id']) ? $_POST['id'] : null;
    $titulo = !empty($_POST['titulo']) ? $_POST['titulo'] : null;
    $parrafo = !empty($_POST['parrafo']) ? $_POST['parrafo'] : null;
    $nombres = !empty($_POST['nombres']) ? $_POST['nombres'] : null;
    $cargo = !empty($_POST['cargo']) ? $_POST['cargo'] : null;






    // Editar el resto de los campos
    $result = Home::editCommentsId($id, $titulo, $parrafo, $nombres, $cargo);


    if ($result->execute()) {

     

        if (isset($_FILES["imagen2"]) && $_FILES["imagen2"]["error"] === UPLOAD_ERR_OK) {
            // Procesar la imagen 2
            $nombreArchivoUnico2 = uniqid('image_', true) . '.' . pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
            $rutaDestino2 = "../../files/home/" . $nombreArchivoUnico2;
            if (move_uploaded_file($_FILES["imagen2"]["tmp_name"], $rutaDestino2)) {
                $imagen2 = $nombreArchivoUnico2;
                $result2 = Home::editImageCommentsId($id, $imagen2);
                $result2->execute();
            }
        }
    


        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El comentario se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
