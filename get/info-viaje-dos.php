<?php

$travelList = Travel::getTravelAll();
//var_dump($travelList);

// Supongamos que el nombre del usuario está almacenado en $_SESSION['user']
$user = isset($_SESSION['cliente']) ? $_SESSION['cliente'] : null;
$pasajeros = isset( $_GET['pasajeros']) ?  $_GET['pasajeros'] : null;
$fecha = isset( $_GET['fecha']) ?  $_GET['fecha'] : null;

// Separa el valor de 'destino' en $id y $tipo
list($id, $tipo) = explode('-', $_GET['destino']);

try {
    // Filtrar tbl_viajes_puntos para obtener viaje_id
    $query = "SELECT viaje_id FROM tbl_viajes_puntos WHERE puntos_id = :id AND tipo = :tipo";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $stmt->execute();
    
    $selected_viaje_id = null;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $viaje_id = $row['viaje_id'];

        // Consulta para verificar si el viaje tiene un count menor o igual a 0 en otra_tabla
        $count_query = "SELECT COUNT(*) AS count FROM tbl_viajes WHERE id = :viaje_id";
        $count_stmt = $conn->prepare($count_query);
        $count_stmt->bindParam(':viaje_id', $viaje_id, PDO::PARAM_INT);
        $count_stmt->execute();
        $count_row = $count_stmt->fetch(PDO::FETCH_ASSOC);
        $count = $count_row['count'];

        // Si el count es menor o igual a 0, continúa con el siguiente resultado
        if ($count <= 0) {
            continue;
        }

        $ticketObj = Travel::getPointsFechHomeId($viaje_id, $id);
        $viajeObj = Travel::getMarvelId($viaje_id);
        $movilidadObj = Mobility::getMobilityId($viajeObj->movilidad_id);

        $asientos = Asientos::getAsientosByViajeId($viaje_id);
        //var_dump($ticketObj);

        $horafecha = new DateTime($horafecha = $ticketObj->fecha);

        $fecha_formateada = strftime('%d de %B de %Y', $horafecha->getTimestamp());
        
        // Hacer algo con el viaje_id seleccionado
        //echo "El viaje con viaje_id $viaje_id tiene un count mayor a 0 en otra_tabla.";

        // Por ejemplo, podrías almacenar el viaje_id en una variable para usarlo más tarde
        $selected_viaje_id = $viaje_id;
        break; // Rompe el bucle ya que hemos encontrado un resultado válido
    }

    if ($selected_viaje_id === null) {
        echo "No se encontraron resultados válidos para el punto_id $id y tipo $tipo en tbl_viajes_puntos.";
    }

} catch (PDOException $e) {
    die("PDO Error: " . $e->getMessage());
}


?>