<?php
include '../conexion.php';
include '../../class/booking.php';
include '../../core/Security.php';

 session_start();
 $usuario_id= Security::getUserId();

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Primera consulta a tbl_reservas
    $sql = "SELECT * FROM tbl_reservas WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $reserva = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($reserva) {
        // Segunda consulta a tbl_viajes usando el viaje_id de la primera consulta
        $viaje_id = $reserva['viaje_id'];
        $sql = "SELECT * FROM tbl_viajes WHERE id = :viaje_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':viaje_id', $viaje_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $viaje = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($viaje) {
            // Tercera consulta a tbl_movilidad usando el movilidad_id de la segunda consulta
            $movilidad_id = $viaje['movilidad_id'];
            $sql = "SELECT * FROM tbl_movilidad WHERE id = :movilidad_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':movilidad_id', $movilidad_id, PDO::PARAM_INT);
            $stmt->execute();
            
            $movilidad = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Combinamos los resultados de las tres consultas
            $resultado = array(
                'reserva' => $reserva,
                'viaje' => $viaje,
                'movilidad' => $movilidad
            );
            echo json_encode($resultado);
        } else {
            // Si no se encuentra el viaje, devolvemos solo la reserva
            $resultado = array(
                'reserva' => $reserva,
                'viaje' => null,
                'movilidad' => null
            );
            echo json_encode($resultado);
        }
    } else {
        echo json_encode([]);
    }
}
?>