<?php
include '../conexion.php';
include '../../class/booking.php';
include '../../core/Security.php';


session_start();


if (isset($_POST['action']) && $_POST['action'] == 'get_all_booking') {
    $result = Booking::getBookingAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_booking_ventas_id') {
    $id = Security::getUserId();
    $result = Booking::getBookingVentasId($id);
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_passengers_by_booking_id') {
    $id = $_POST['resultId'];
    $result = Booking::getBookingPassengersId($id);
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_seats_by_booking_id') {
    $id = $_POST['resultId'];
    $result = Booking::getSeatsPassengersId($id);
    echo json_encode($result);
}
