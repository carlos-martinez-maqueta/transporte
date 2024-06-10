<?php
include '../conexion.php';
include '../../class/user.php';
include '../../core/Security.php';


session_start();
$id = Security::getUserId();

if (isset($_POST['action']) && $_POST['action'] == 'get_all_user') {
    $result = User::getUserAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_user_id') {
    $id = $_POST['resultId'];
    $result = User::getUserId($id);
    echo json_encode($result);
}
