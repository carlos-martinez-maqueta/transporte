<?php
include '../conexion.php';
include '../../class/home.php';
include '../../core/Security.php';

session_start();
$referencia_id = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id =  !empty($_POST['id']) ? $_POST['id'] : null;
    $texto1 =  !empty($_POST['texto1']) ? $_POST['texto1'] : null;
    $texto2 =  !empty($_POST['texto2']) ? $_POST['texto2'] : null;
    $parrafo =  !empty($_POST['parrafo']) ? $_POST['parrafo'] : null;


    if (isset($_FILES["imagen1"]) && $_FILES["imagen1"]["error"] === UPLOAD_ERR_OK) {
        // Generar un nombre único para el archivo
        $nombreArchivoUnico1 = uniqid('image_', true) . '.' . pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
        $rutaDestino1 = "../../files/home/" . $nombreArchivoUnico1;
    
        // Guardar la imagen en la ruta especificada
        if (move_uploaded_file($_FILES["imagen1"]["tmp_name"], $rutaDestino1)) {
            // Editar la imagen solo si se guardó correctamente
            $imagen1 = $nombreArchivoUnico1;
            $result1 = Home::editBannerHome($imagen1);
            $result1->execute();
        }
    }
    
    if (isset($_FILES["imagen2"]) && $_FILES["imagen2"]["error"] === UPLOAD_ERR_OK) {
        // Procesar la imagen 2
        $nombreArchivoUnico2 = uniqid('image_', true) . '.' . pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
        $rutaDestino2 = "../../files/home/" . $nombreArchivoUnico2;
        if (move_uploaded_file($_FILES["imagen2"]["tmp_name"], $rutaDestino2)) {
            $imagen2 = $nombreArchivoUnico2;
            $result2 = Home::editBanner2Home($imagen2);
            $result2->execute();
        }
    }

    if (isset($_FILES["imagen3"]) && $_FILES["imagen3"]["error"] === UPLOAD_ERR_OK) {
        // Procesar la imagen 3
        $nombreArchivoUnico3 = uniqid('image_', true) . '.' . pathinfo($_FILES["imagen3"]["name"], PATHINFO_EXTENSION);
        $rutaDestino3 = "../../files/home/" . $nombreArchivoUnico3;
        if (move_uploaded_file($_FILES["imagen3"]["tmp_name"], $rutaDestino3)) {
            $imagen3 = $nombreArchivoUnico3;
            $result3 = Home::editBanner3Home($imagen3);
            $result3->execute();
        }
    }




    // Editar el resto de los campos
    $result = Home::editHome($texto1, $texto2, $parrafo);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El home se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar home.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
