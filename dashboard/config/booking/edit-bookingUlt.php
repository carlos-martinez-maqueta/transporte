<?php
include '../conexion.php';
include '../../class/travel.php';
include '../../core/Security.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idReserva = $_POST['idReserva'];
    $estadoReserva = $_POST['estadoReserva'];
    $id_pasajeros = $_POST['id_pasajero'];
    $nombres = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correos = $_POST['correo'];
    $celulares = $_POST['celular'];

    $reservaEditada = false;

    // Editar el estado de la reserva si es "cancelado"
    if ($estadoReserva === 'cancelada') {
        $reservaEditada = Travel::editStateBookingId($idReserva, $estadoReserva);
    }

    // Si la reserva se editó correctamente o no era "cancelado", editar los datos de los pasajeros
    if ($reservaEditada || $estadoReserva !== 'cancelado') {
        for ($i = 0; $i < count($id_pasajeros); $i++) {
            $id_pasajero = $id_pasajeros[$i];
            $nombre = $nombres[$i];
            $apellido = $apellidos[$i];
            $correo = $correos[$i];
            $celular = $celulares[$i];

            $stmt = $conn->prepare("UPDATE tbl_reservas_pasajeros SET nombre=:nombre, apellidos=:apellidos, correo=:correo, celular=:celular WHERE id=:id_pasajero");
            $stmt->bindParam(':id_pasajero', $id_pasajero);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidos', $apellido);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':celular', $celular);
            $stmt->execute();
        }

        $response = array(
            'status' => 'success',
            'message' => 'La reserva se editó correctamente.'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar reserva.'
        );
    }

    // Devolver la respuesta como JSON
    echo json_encode($response);
}
