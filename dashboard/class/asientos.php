<?php

class Asientos
{
    public static function getAsientosByViajeId($viaje_id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_asientos WHERE viaje_id = :viaje_id");
        $statement->bindValue(":viaje_id", $viaje_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}

