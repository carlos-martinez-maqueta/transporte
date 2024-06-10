<?php
include '../conexion.php';
include '../../class/travel.php';
include '../../core/Security.php';


session_start();
$id = Security::getUserId();

if (isset($_POST['action']) && $_POST['action'] == 'get_all_travel') {
    $result = Travel::getTravelAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_travel_id') {
    $id = $_POST['resultId'];
    $result = Travel::getMarvelId($id);
    echo json_encode($result);
}
