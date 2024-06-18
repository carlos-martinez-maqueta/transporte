<?php
include '../conexion.php';
include '../../class/travel.php';
include '../../core/Security.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "SELECT asiento, estado FROM tbl_asientos WHERE viaje_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $estados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($estados);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(array('message' => 'No se recibió un ID válido.'));
}
?>
