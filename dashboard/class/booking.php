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
        $statement = $conn->prepare("SELECT * FROM tbl_reservas_asientos WHERE reserva_id=:id");
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
}
