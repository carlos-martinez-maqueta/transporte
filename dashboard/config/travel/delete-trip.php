<?php
include '../conexion.php'; // Incluye tu archivo de conexión PDO

if (isset($_POST['id']) && isset($_POST['tipo_viaje'])) {
    $tripId = $_POST['id'];
    $tipoViaje = $_POST['tipo_viaje'];

    try {
        // Determina la tabla a usar según el tipo de viaje
        if ($tipoViaje == 'ida') {
            $query = "DELETE FROM tbl_idas WHERE id = :id";
        } else {
            $query = "DELETE FROM tbl_vueltas WHERE id = :id";
        }

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $tripId, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo 'Viaje eliminado exitosamente.';
        } else {
            echo 'No se encontró el viaje para eliminar.';
        }
    } catch (PDOException $e) {
        echo 'Error al eliminar el viaje: ' . $e->getMessage();
    }
} else {
    echo 'ID del viaje o tipo de viaje no especificado.';
}
?>
