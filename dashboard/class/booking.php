<?php

class Booking
{

    public static function getBookingAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            tr.*,
            tpe.nombre AS nombreStaff,
            tpe.apellidos AS apellidosStaff,
            tvi.correlativo AS correlativoViaje
        FROM 
            tbl_reservas tr
        JOIN
            tbl_personal tpe ON tpe.id = tr.staff_id
        LEFT JOIN
            tbl_viajes tvi ON tvi.id = tr.viaje_id
        ORDER BY 
            tr.fecha_creacion DESC
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getBookingPassengersId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_reservas_pasajeros WHERE reserva_id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getSeatsPassengersId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_asientos WHERE reserva_id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getBookingVentasId($id)
    {
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            tr.*,
            tpe.nombre AS nombreStaff,
            tpe.apellidos AS apellidosStaff,
            tvi.correlativo AS correlativoViaje
        FROM 
            tbl_reservas tr
        JOIN
            tbl_personal tpe ON tpe.id = tr.staff_id
        LEFT JOIN
            tbl_viajes tvi ON tvi.id = tr.viaje_id
        WHERE 
            tr.staff_id=:id
        ORDER BY 
            tr.fecha_creacion DESC ");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function addBookingSales($staffId, $viaje_id, $referencia, $num_asientos, $precioBooking)
    {
        global $conn;
        $sql = "INSERT INTO tbl_reservas (staff_id , viaje_id , referencia, asientos_reservados, precio_pagado, fecha_creacion, estado) 
        VALUES (:staffId, :viaje_id, :referencia, :num_asientos, :precioBooking, NOW(), 'confirmada')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':staffId', $staffId);
        $stmt->bindParam(':viaje_id', $viaje_id);
        $stmt->bindParam(':referencia', $referencia);
        $stmt->bindParam(':num_asientos', $num_asientos);
        $stmt->bindParam(':precioBooking', $precioBooking);
        return $stmt;
    }
    public static function editBookingImageId($lastInsertedId, $imagen)
    {
        global $conn;
        $sql = "UPDATE tbl_reservas SET imagen=:imagen WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $lastInsertedId);
        $stmt->bindParam(':imagen', $imagen);
        return $stmt;
    }
    public static function getVoucherByBookingId($id) {
        global $conn;
        $statement = $conn->prepare("SELECT imagen FROM tbl_reservas WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getSumaTotalPrecioPorMes($mes, $anio)
{
    global $conn;
    $inicio_mes = "$anio-$mes-01";
    $fin_mes = date('Y-m-t', strtotime($inicio_mes));

    $statement = $conn->prepare("
        SELECT 
            SUM(precio_pagado) as total
        FROM 
            tbl_reservas
        WHERE
            estado = 'confirmada'
            AND fecha_creacion >= :inicio_mes
            AND fecha_creacion <= :fin_mes
    ");
    $statement->bindParam(':inicio_mes', $inicio_mes);
    $statement->bindParam(':fin_mes', $fin_mes);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
}

}
