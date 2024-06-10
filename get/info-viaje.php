<?php
// Supongamos que el nombre del usuario está almacenado en $_SESSION['user']
if (isset($_SESSION['id'])){
    $id =  $_SESSION['id'];
    $user =  $_SESSION['user'];
    $nombre =  $_SESSION['nombre'];
    $apellidos =  $_SESSION['apellidos'];
    $correo =  $_SESSION['correo'];
}else{
 $user = '';
}

// CAPTURAR PASAJEROS VALIDACIÓN SI SON MÁS DE DOS BOLETOS
$pasajeros = isset($_GET['pasajeros']) ? intval($_GET['pasajeros']) : 0;
// CAPTURAR MONTO TOTAL DE VALOR EN PASAJES 



//OBTENER ID VIAJE
$viajeid = isset($_GET['idviaje']) ? $_GET['idviaje'] : '';
$pasajeros = isset($_GET['pasajeros']) ? $_GET['pasajeros'] : 1;

$travelList = Travel::getTravelAlls($viajeid); 

// echo $travelList->id;
// var_dump($travelList);

$totalboletos = $pasajeros *  $travelList->precio;

// Formatear la fecha
$fecha_inicio = new DateTime($travelList->fecha_inicio);
$fecha_formateada = $fecha_inicio->format('d \d\e F');

// Convertir la cadena de fecha en un objeto DateTime - Formatear la hora
$fecha_inicio = new DateTime($travelList->fecha_inicio);
$fecha_fin = new DateTime($travelList->fecha_fin);
$hora_inicio = $fecha_inicio->format('h:i A');
$hora_fin = $fecha_fin->format('h:i A');

// Calcular la diferencia en horas - Obtener la diferencia en horas - Calcular el total de horas
$diferencia = $fecha_inicio->diff($fecha_fin);
$horas = $diferencia->h;
$minutos = $diferencia->i;
$total_horas = $horas + ($minutos / 60);
?>