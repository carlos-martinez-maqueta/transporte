<?php
include '../conexion.php';
include '../../class/travel.php';
include '../../core/Security.php';

session_start();
$staffId = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $viaje_ids = !empty($_POST['viaje_id']) ? $_POST['viaje_id'] : []; // Array of viaje_ids
    $tipo_viaje = !empty($_POST['tipo_viaje']) ? $_POST['tipo_viaje'] : null;
    $movilidad_id = !empty($_POST['movilidad_id']) ? $_POST['movilidad_id'] : null;
    $fecha_salida = !empty($_POST['fecha_salida']) ? $_POST['fecha_salida'] : null;
    $hora_salida = !empty($_POST['hora_salida']) ? $_POST['hora_salida'] : null;

    // Asumiendo que la clase Travel tiene un método addTravel que devuelve un objeto PDOStatement
    $result = Travel::addTravel($fecha_salida, $hora_salida, $movilidad_id, $staffId, $tipo_viaje);

    if ($result->execute()) {
        $lastInsertedId = $conn->lastInsertId();

        // Insertar múltiples puntos de viaje
        $sqlInsertPuntoViaje = "INSERT INTO tbl_viajes_puntos (viaje_id, puntos_id, tipo) VALUES (:viaje_id, :puntos_id, :tipo)";
        $stmtInsertPuntoViaje = $conn->prepare($sqlInsertPuntoViaje);

        foreach ($viaje_ids as $viaje_id) {
            $stmtInsertPuntoViaje->bindParam(':viaje_id', $lastInsertedId);
            $stmtInsertPuntoViaje->bindParam(':puntos_id', $viaje_id);
            $stmtInsertPuntoViaje->bindParam(':tipo', $tipo_viaje);
            $stmtInsertPuntoViaje->execute();
        }

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
