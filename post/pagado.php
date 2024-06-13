<?php
require '../config/conexion.php'; // Asegúrate de tener tu configuración de base de datos aquí

// Obtener el cuerpo de la solicitud JSON
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $viaje_id = $data['viaje_id'];
    $asientos_reservados = $data['asientos_reservados'];
    $precio = $data['precio'];
    $fecha_creacion = date('Y-m-d H:i:s');
    $estado = 'confirmada';
    $reservadoas = $data['reservadoas'];
    $acompanantes = $data['acompanantes'];

    $correo = $data['correo'];
    $apellidos = $data['apellidos'];
    $telefono = $data['telefono'];
    $nombre = $data['nombre'];

    try {
        // Insertar datos en tbl_reservas
        $sql_reserva = "INSERT INTO tbl_reservas (staff_id, viaje_id, referencia, asientos_reservados, imagen, precio_pagado, fecha_creacion, estado) 
                        VALUES (NULL, '$viaje_id', 'WEB', '$asientos_reservados', NULL, '$precio', '$fecha_creacion', '$estado')";
        $stmt_reserva = $conn->prepare($sql_reserva);
        $stmt_reserva->execute();

        // Obtener el ID de la última inserción en tbl_reservas
        $ultimo_id_insertado = $conn->lastInsertId();

        // Actualizar tbl_viajes
        $sql_update_viajes = "UPDATE tbl_viajes SET count = count - '$asientos_reservados' WHERE id = '$viaje_id'";
        $stmt_update_viajes = $conn->prepare($sql_update_viajes);
        $stmt_update_viajes->execute();

        // Convertir la cadena de nombres de asientos reservados en un array
        $asientos_reservados_array = json_decode($reservadoas, true);

        // Iniciar transacción
        $conn->beginTransaction();

        // Actualizar tbl_asientos para marcar los asientos como ocupados
        foreach ($asientos_reservados_array as $asiento_data) {
            $asiento_id = $asiento_data['id'];
            $asiento_asiento = $asiento_data['asiento'];

            $sql_update_asientos = "UPDATE tbl_asientos SET estado = 'ocupado', reserva_id = '$ultimo_id_insertado'
                                    WHERE viaje_id = '$viaje_id' AND id = '$asiento_asiento'";

            $stmt_update_as = $conn->prepare($sql_update_asientos);
            $stmt_update_as->execute();
        }

        // Insertar datos de usuario principal en tbl_reservas_pasajeros
        $sql_usuario = "INSERT INTO tbl_reservas_pasajeros (nombre, apellidos, correo, celular, reserva_id) 
                        VALUES ('$nombre', '$apellidos', '$correo', '$telefono', '$ultimo_id_insertado')";
        $stmt_user = $conn->prepare($sql_usuario);
        $stmt_user->execute();

        // Insertar datos de acompañantes en tbl_reservas_pasajeros
        $acompanantes_array = json_decode($acompanantes, true);

        foreach ($acompanantes_array as $acom) {
            $nombre_acomp = $acom['nombre'];
            $apellidos_acomp = $acom['apellidos'];

            $sql_acompanante = "INSERT INTO tbl_reservas_pasajeros (nombre, apellidos, reserva_id) 
                                VALUES ('$nombre_acomp', '$apellidos_acomp', '$ultimo_id_insertado')";
            $stmt_acom = $conn->prepare($sql_acompanante);
            $stmt_acom->execute();
        }

        // Confirmar la transacción
        $conn->commit();
        echo "Reserva realizada con éxito.";
    } catch (PDOException $e) {
        // Revertir la transacción en caso de error
        $conn->rollBack();
        echo "Error al realizar la reserva: " . $e->getMessage();
    }
} else {
    echo "No se recibieron datos.";
}
?>
