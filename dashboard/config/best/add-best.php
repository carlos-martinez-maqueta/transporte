<?php
include '../conexion.php';
include '../../class/home.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = !empty($_POST['titulo']) ? $_POST['titulo'] : null;
    $parrafo = !empty($_POST['parrafo']) ? $_POST['parrafo'] : null;






    // Editar el resto de los campos
    $result = Home::addSection1($titulo, $parrafo);


    if ($result->execute()) {

        $lastInsertedId = $conn->lastInsertId();

        // Verificar si se envió una nueva imagen
        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
            // Generar un nombre único para el archivo
            $nombreArchivoUnico = uniqid('image_', true) . '.' . pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
            $rutaDestino = "../../files/home/" . $nombreArchivoUnico;

            // Guardar la imagen en la ruta especificada
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino)) {
                // Editar la imagen solo si se guardó correctamente
                $imagen = $nombreArchivoUnico;
                $result2 = Home::editImageSection1Id($lastInsertedId, $imagen);
                $result2->execute();
            }
        }


        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El mejor destino se agregó correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
