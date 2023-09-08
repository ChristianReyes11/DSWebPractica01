<?php
    try{
        $url = "pgsql:host=172.17.0.3;port=5432;dbname=mydb;";
        $pdo = new PDO($url, "postgres", "password", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        if ($pdo) {

                $insert = $pdo->prepare("INSERT INTO mytable (nombre, direccion, telefono) VALUES (:nombre, :direccion, :telefono)");
            
            $insert->bindParam(':nombre', $_POST['nombre']);
            $insert->bindParam(':direccion', $_POST['direccion']);
            $insert->bindParam(':telefono', $_POST['telefono']);

            $insert->execute();

            header('Location: index.php');
    exit(); 
            }
    }catch (PDOException $e) {
        die($e -> getMessage());
    }finally{
        if($pdo){
            $pdo=null;
        }
    }

?>