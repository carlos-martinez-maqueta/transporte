<?php

class Plantilla
{
    public static function getPlantillaId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_plantillas WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
}
