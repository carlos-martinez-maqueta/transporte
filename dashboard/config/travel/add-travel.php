<?php
include '../conexion.php';
include '../../class/travel.php';
include '../../core/Security.php';

session_start();
$staffId = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $origin_id =  !empty($_POST['origin_id']) ? $_POST['origin_id'] : null;
    $destino_id =  !empty($_POST['destino_id']) ? $_POST['destino_id'] : null;
    $movilidad_id =  !empty($_POST['movilidad_id']) ? $_POST['movilidad_id'] : null;
    $fecha_inicio =  !empty($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : null;
    $fecha_fin =  !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
    $precio =  !empty($_POST['precio']) ? $_POST['precio'] : null;

    // Editar el resto de los campos
    $result = Travel::addTravel($origin_id, $destino_id, $movilidad_id, $fecha_inicio, $fecha_fin, $staffId, $precio);

    if ($result->execute()) {
        $lastInsertedId = $conn->lastInsertId();

        // Obtener la plantilla de asientos de la movilidad
        $stmt_capacidad = $conn->prepare("SELECT capacidad_asientos FROM tbl_movilidad WHERE id = ?");
        $stmt_capacidad->execute([$movilidad_id]);
        $capacidad_asientos = $stmt_capacidad->fetchColumn();

        // Insertar los asientos para el viaje
        for ($i = 1; $i <= $capacidad_asientos; $i++) {
            $fila = "A" . $i; // Puedes ajustar la lógica para nombrar las filas
            $stmt_asientos = $conn->prepare("INSERT INTO tbl_asientos (viaje_id, asiento, estado) VALUES (?, ?, ?)");
            $stmt_asientos->execute([$lastInsertedId, $fila, 'disponible']);
        }

        // Viaje y asientos registrados correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El viaje se agregó correctamente.'
        );
    } else {
        // Error al registrar el viaje
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar viaje.'
        );
    }

    // Devolver la respuesta como JSON
    echo json_encode($response);
}
?>
