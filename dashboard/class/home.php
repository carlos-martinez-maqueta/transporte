<?php

class Home
{
    public static function getHome()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_home WHERE id= 1");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function editBannerHome($banner)
    {
        global $conn;
        $sql = "UPDATE tbl_home SET banner=:banner WHERE id=1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':banner', $banner);
        return $stmt;
    }
    public static function editBanner2Home($banner)
    {
        global $conn;
        $sql = "UPDATE tbl_home SET publicidad=:banner WHERE id=1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':banner', $banner);
        return $stmt;
    }
    public static function editBanner3Home($banner)
    {
        global $conn;
        $sql = "UPDATE tbl_home SET banner2=:banner WHERE id=1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':banner', $banner);
        return $stmt;
    }
    public static function editHome($texto1, $texto2, $parrafo)
    {
        global $conn;
        $sql = "UPDATE tbl_home SET texto1=:texto1, texto2=:texto2, parrafo=:parrafo WHERE id=1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':texto1', $texto1);
        $stmt->bindParam(':texto2', $texto2);
        $stmt->bindParam(':parrafo', $parrafo);
        return $stmt;
    }
    public static function getBestAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            *
        FROM 
            tbl_section1
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function addSection1($titulo, $parrafo)
    {
        global $conn;
        $sql = "INSERT INTO tbl_section1 (title, subtitle) 
        VALUES (:titulo, :parrafo)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':parrafo', $parrafo);
        return $stmt;
    }
    public static function editImageSection1Id($id, $banner)
    {
        global $conn;
        $sql = "UPDATE tbl_section1 SET imagen=:banner WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindParam(':banner', $banner);
        return $stmt;
    }
    public static function getSection1Id($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_section1 WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function editSection1Id($id, $title, $subtitle)
    {
        global $conn;
        $sql = "UPDATE tbl_section1 SET title=:title, subtitle=:subtitle WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':subtitle', $subtitle);
        return $stmt;
    }
    public static function deleteId($id)
    {
        global $conn;
        $sql = "DELETE FROM tbl_section1 WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt;
    }

    public static function getCommentsAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            *
        FROM 
            tbl_comentarios_clientes
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public static function addComments($titulo, $parrafo, $nombres, $cargo)
    {
        global $conn;
        $sql = "INSERT INTO tbl_comentarios_clientes (titulo, parrafo, nombre, cargo) 
                VALUES (:titulo, :parrafo, :nombres, :cargo)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':parrafo', $parrafo);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':cargo', $cargo);
        return $stmt;
    }
    
    public static function editImageCommentsId($id, $banner)
    {
        global $conn;
        $sql = "UPDATE tbl_comentarios_clientes SET imagen=:banner WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindParam(':banner', $banner);
        return $stmt;
    }
    public static function getComments1Id($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_comentarios_clientes WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function editCommentsId($id, $titulo, $parrafo, $nombres, $cargo)
    {
        global $conn;
        $sql = "UPDATE tbl_comentarios_clientes SET titulo=:titulo, parrafo=:parrafo, nombre=:nombres, cargo=:cargo WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':parrafo', $parrafo);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':cargo', $cargo);
        return $stmt;
    }
    public static function deleteCommentsId($id)
    {
        global $conn;
        $sql = "DELETE FROM tbl_comentarios_clientes WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt;
    }

  
}

