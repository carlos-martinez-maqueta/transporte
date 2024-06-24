<?php

class Mobility
{


    public static function getMobilityAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            *
        FROM 
            tbl_movilidad
        ORDER BY 
            fecha_creacion DESC
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getMobilityId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_movilidad WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function addMobility($matricula, $marca, $modelo, $color, $cantidad_asientos, $tipo_vehiculo, $plantilla_id)
    {
        global $conn;
        $sql = "INSERT INTO tbl_movilidad (matricula, marca, modelo, color, capacidad_asientos, tipo_vehiculo, fecha_creacion, estado, plantilla_id) 
        VALUES (:matricula, :marca, :modelo, :color, :cantidad_asientos, :tipo_vehiculo, NOW(), 'disponible', :plantilla_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':cantidad_asientos', $cantidad_asientos);
        $stmt->bindParam(':tipo_vehiculo', $tipo_vehiculo);
        $stmt->bindParam(':plantilla_id', $plantilla_id);
        return $stmt;
    }
    public static function editImageMobility($id, $banner)
    {
        global $conn;
        $sql = "UPDATE tbl_movilidad SET imagen=:banner WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindParam(':banner', $banner);
        return $stmt;
    }
    public static function editMobilityId($id, $matricula, $marca, $modelo, $color, $tipo_vehiculo, $estado)
    {
        global $conn;
        $sql = "UPDATE tbl_movilidad 
            SET matricula=:matricula, 
                marca=:marca, 
                modelo=:modelo, 
                color=:color, 
                tipo_vehiculo=:tipo_vehiculo, 
                estado=:estado 
            WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':tipo_vehiculo', $tipo_vehiculo);
        $stmt->bindParam(':estado', $estado);
        return $stmt;
    }
    public static function getMobilityAllActive()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_movilidad WHERE estado= 'disponible'");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}
