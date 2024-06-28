<?php
include '../conexion.php';
include '../../class/booking.php';
include '../../class/travel.php';
include '../../core/Security.php';

session_start();
$staffId = Security::getUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $monto_descuento =  !empty($_POST['monto_descuento']) ? $_POST['monto_descuento'] : null;
    $usuario_id =  !empty($_POST['u']) ? $_POST['u'] : null;
    $motivo =  !empty($_POST['motivo']) ? $_POST['motivo'] : null;
    $reserva_id =  !empty($_POST['id']) ? $_POST['id'] : null;


    $reservaObj = Booking::getBookingIdFech($reserva_id);

    $precioReserva = $reservaObj->precio_pagado;

    $descuentoPago = floatval($precioReserva) - floatval($monto_descuento);



    // Editar el resto de los campos
    $result = Booking::addDescuentoCompra($monto_descuento, $motivo, $reserva_id, $usuario_id, $precioReserva, $descuentoPago);


    if ($result->execute()) {


        $result2 = Booking::editBookingPrace($reserva_id, $descuentoPago);
        $result2->execute();


        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El descuento a la compra se agregó correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar descuento.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
