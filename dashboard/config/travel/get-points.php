<?php
include '../conexion.php'; // Incluye tu archivo de conexión a la base de datos
include '../../class/travel.php'; // Incluye la clase Travel si aún no está incluida
include '../../core/Security.php'; // Incluye el archivo de seguridad si es necesario

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener el tipo de viaje para determinar la tabla correcta
    $viajeObj = Travel::getMarvelId($id);
    $tipoViaje = $viajeObj->tipo;
    $tablaViaje = ($tipoViaje === 'ida') ? 'tbl_idas' : 'tbl_vueltas';

    // Consulta para obtener los puntos del viaje con el ID especificado
    $query = "SELECT v.*, vp.*, t.* FROM tbl_viajes_puntos vp JOIN $tablaViaje t ON vp.puntos_id = t.id JOIN tbl_viajes v ON v.id = vp.viaje_id WHERE vp.viaje_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $puntos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($puntos);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(array('message' => 'No se recibió un ID válido.'));
}
?>
