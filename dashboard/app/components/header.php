<?php
include 'config/conexion.php';
include 'class/staff.php';
include 'class/user.php';
include 'class/origin.php';
include 'class/mobility.php';
include 'class/destination.php';
include 'class/pay.php';
include 'class/booking.php';
include 'class/travel.php';
include 'core/Security.php';

session_start();
if (!isset($_SESSION["user"])) {
  header("Location: ../dashboard-login");
  return;
}
$usuario_id = Security::getUserId();
$staffObj = Staff::getStaff($usuario_id);
$user_role = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="assets/css/dashboard.css" />
  <link rel="stylesheet" href="assets/css/media.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">

  <title>Dashboard</title>
</head>

<body>
  <div class="d-flex" id="wrapper">