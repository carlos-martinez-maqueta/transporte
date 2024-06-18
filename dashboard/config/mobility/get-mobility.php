<?php
include '../conexion.php';
include '../../class/mobility.php';
include '../../core/Security.php';


session_start();
$id = Security::getUserId();


if (isset($_POST['action']) && $_POST['action'] == 'get_all_mobility_id') {
    $id = $_POST['resultId'];
    $result = Mobility::getMobilityId($id);
    echo json_encode($result);
}
