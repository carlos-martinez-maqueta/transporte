<?php
include '../conexion.php';
include '../../class/booking.php';
include '../../core/Security.php';

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id =  !empty($_POST['reservaIdBla']) ? $_POST['reservaIdBla'] : null;
    $viajeId =  !empty($_POST['viajeId']) ? $_POST['viajeId'] : null;
    $estado =  !empty($_POST['estadoReservaBla']) ? $_POST['estadoReservaBla'] : null;


    $selectedSeats = !empty($_POST['selectedSeats']) ? $_POST['selectedSeats'] : null;


    // Editar el resto de los campos
    $result = Booking::updateStateBookingId($id, $estado);
    // Actualizar los asientos seleccionados
    if (!empty($selectedSeats)) {
        $selectedSeatsArray = explode(",", $selectedSeats);
        foreach ($selectedSeatsArray as $seat) {
            $sqlUpdate = "UPDATE tbl_asientos SET estado = 'ocupado', reserva_id = :reserva_id WHERE viaje_id = :viaje_id AND asiento = :asiento AND estado = 'disponible'";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':reserva_id', $id);
            $stmtUpdate->bindParam(':viaje_id', $viajeId);
            $stmtUpdate->bindParam(':asiento', $seat);
            $stmtUpdate->execute();
        }
    }

    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'La reserva se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar reserva.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
