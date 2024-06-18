<?php

class Origin { 

    public static function consultSecurytyStaff($username, $password){
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_personal WHERE correo = :username AND pass = :password AND estado = 'activo'");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getOriginId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_origen WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getOriginAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            *
        FROM 
            tbl_origen
        ORDER BY 
            fecha_creacion DESC
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function addOrigin($nombre)
    {
        global $conn;
        $sql = "INSERT INTO tbl_origen (nombre, fecha_creacion,  estado) 
                VALUES (:nombre, NOW(),'activo')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        return $stmt;
    }
    public static function editOriginId($id, $nombre, $estado)
    {
        global $conn;
        $sql = "UPDATE tbl_origen SET nombre=:nombre, estado=:estado WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':estado', $estado);
        return $stmt;
    }
    public static function deleteId($id)
    {
        global $conn;
        $sql = "DELETE FROM tbl_origen WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt;
    }
    public static function getOriginAllActive()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_origen WHERE estado= 'activo'");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    
    


}