<?php
    try {
        $url = "pgsql:host=172.17.0.3;port=5432;dbname=mydb;";
        $pdo = new PDO($url, "postgres", "password", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
        if ($pdo) {
            $idToDelete = $_GET['eliminar']; // Obtén el ID del registro a eliminar desde la URL o de otra fuente
    
            $delete = $pdo->prepare("DELETE FROM mytable WHERE clave = :id");
            $delete->bindParam(':id', $idToDelete);
    
            $delete->execute();
    
            // Redirige a la página deseada después de la eliminación
            header('Location: index.php');
            exit();
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    } finally {
        if ($pdo) {
            $pdo = null;
        }
    }    
?>