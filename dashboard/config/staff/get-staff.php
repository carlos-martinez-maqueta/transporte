<?php
include '../conexion.php';
include '../../class/staff.php';
include '../../core/Security.php';


session_start();
$id = Security::getUserId();

if (isset($_POST['action']) && $_POST['action'] == 'get_all_staff') {
    $result = Staff::getStaffAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_staff_id') {
    $id = $_POST['resultId'];
    $result = Staff::getStaff($id);
    echo json_encode($result);
}
