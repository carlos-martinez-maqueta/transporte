<?php

class Staff { 

    public static function consultSecurytyStaff($username, $password){
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_personal WHERE correo = :username AND pass = :password AND estado = 'activo'");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getStaff($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_personal WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getStaffAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            *
        FROM 
            tbl_personal
        ORDER BY 
            fecha_creacion DESC
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function addStaff($nombre, $apellidos, $correo, $celular, $rol_id, $pass, $referencia)
    {
        global $conn;
        $sql = "INSERT INTO tbl_personal (nombre, apellidos, correo, celular, fecha_creacion, rol_id, referencia, pass, estado) 
                VALUES (:nombre, :apellidos, :correo, :celular, NOW(), :rol_id, :referencia, :pass, 'activo')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':rol_id', $rol_id);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':referencia', $referencia);
        return $stmt;
    }
    public static function editStaffId($id, $nombre, $apellidos, $correo, $celular, $estado, $pass)
    {
        global $conn;
        $sql = "UPDATE tbl_personal SET nombre=:nombre, apellidos=:apellidos, correo=:correo, celular=:celular, estado=:estado, pass=:pass WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':pass', $pass);
        return $stmt;
    }
    public static function settingsStaffId($id, $nombre, $apellidos, $correo, $celular, $pass)
    {
        global $conn;
        $sql = "UPDATE tbl_personal SET nombre=:nombre, apellidos=:apellidos, correo=:correo, celular=:celular, pass=:pass WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':pass', $pass);
        return $stmt;
    }
    
    


}