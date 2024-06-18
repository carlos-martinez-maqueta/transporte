<?php

class Destination { 

    public static function consultSecurytyStaff($username, $password){
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_personal WHERE correo = :username AND pass = :password AND estado = 'activo'");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getDestinationId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_destino WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getDestinationAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            *
        FROM 
            tbl_destino
        ORDER BY 
            fecha_creacion DESC
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function addDestination($nombre)
    {
        global $conn;
        $sql = "INSERT INTO tbl_destino (nombre, fecha_creacion,  estado) 
                VALUES (:nombre, NOW(),'activo')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        return $stmt;
    }
    public static function editDestinationId($id, $nombre, $estado)
    {
        global $conn;
        $sql = "UPDATE tbl_destino SET nombre=:nombre, estado=:estado WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':estado', $estado);
        return $stmt;
    }
    public static function deleteId($id)
    {
        global $conn;
        $sql = "DELETE FROM tbl_destino WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt;
    }
    public static function getDestinationAllActive()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_destino WHERE estado= 'activo'");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    
    


}