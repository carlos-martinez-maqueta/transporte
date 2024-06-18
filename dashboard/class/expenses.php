<?php

class Expenses
{

    public static function consultSecurytyStaff($username, $password)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_personal WHERE correo = :username AND pass = :password AND estado = 'activo'");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getExpensesId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_gastos WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getExpensesAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            *
        FROM 
            tbl_gastos
        ORDER BY 
            fecha DESC
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function addExpenses($nombre,$precio)
    {
        global $conn;
        $sql = "INSERT INTO tbl_gastos (nombre, precio,  fecha) 
                VALUES (:nombre,  :precio, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':precio', $precio);
        return $stmt;
    }
    public static function editExpensesId($id, $nombre, $precio)
    {
        global $conn;
        $sql = "UPDATE tbl_gastos SET nombre=:nombre, precio=:precio WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':precio', $precio);
        return $stmt;
    }
    public static function deleteId($id)
    {
        global $conn;
        $sql = "DELETE FROM tbl_gastos WHERE id = :id";
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
