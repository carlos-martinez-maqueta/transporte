<?php
include '../conexion.php'; // Incluir el archivo de conexión a la base de datos

// Verificar si se ha enviado una solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario y sanitizarlos
    $reservaId = filter_var($_POST['reservaIdBla'], FILTER_SANITIZE_NUMBER_INT);
    $estadoReserva = filter_var($_POST['estadoReservaBla'], FILTER_SANITIZE_STRING);

    try {
        // Iniciar una transacción
        $conn->beginTransaction();
        
        // Preparar la consulta SQL para actualizar la reserva
        $sql = "UPDATE tbl_reservas SET estado = :estado WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':estado', $estadoReserva, PDO::PARAM_STR);
        $stmt->bindParam(':id', $reservaId, PDO::PARAM_INT);
        $stmt->execute();
        
        // Verificar si la actualización fue exitosa
        if ($stmt->rowCount() > 0) {
            // Confirmar la transacción
            $conn->commit();
            
            // Si se actualizó al menos una fila
            $response = [
                'success' => true,
                'message' => 'Reserva actualizada correctamente'
            ];
        } else {
            // Devolver un mensaje si no se actualizó ninguna fila
            $response = [
                'success' => false,
                'message' => 'No se encontró ninguna reserva con el ID proporcionado'
            ];
        }
    } catch (PDOException $e) {
        // Si ocurre un error en la transacción, cancelarla
        $conn->rollback();
        
        // Devolver un mensaje de error
        $response = [
            'success' => false,
            'message' => 'Error al actualizar la reserva: ' . $e->getMessage()
        ];
    }
} else {
    // Si no es una solicitud POST, devolver un mensaje de error
    $response = [
        'success' => false,
        'message' => 'Método no permitido'
    ];
}

// Devolver la respuesta en formato JSON
echo json_encode($response);
?>
