<?php
include '../conexion.php';
include '../../class/return.php';
include '../../core/Security.php';


session_start();
$id = Security::getUserId();

if (isset($_POST['action']) && $_POST['action'] == 'get_all_return') {
    $result = Vuelta::getGoingAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_going_id') {
    $id = $_POST['resultId'];
    $result = Vuelta::getGoingId($id);
    echo json_encode($result);
}
