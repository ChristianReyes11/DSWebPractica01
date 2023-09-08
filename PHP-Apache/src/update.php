<?php
    if (isset($_GET['editar']) && isset($_POST['nombre']) && isset($_POST['direccion']) && isset($_POST['telefono'])) {
        $idEditar = $_GET['editar'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
    try {
        $url = "pgsql:host=172.17.0.3;port=5432;dbname=mydb;";
        $pdo = new PDO($url, "postgres", "password", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
        if ($pdo) {
            // Verifica si el registro a editar existe en la base de datos
            $verificarExistencia = $pdo->prepare("SELECT COUNT(*) FROM mytable WHERE clave = :id");
            $verificarExistencia->bindParam(':id', $idEditar);
            $verificarExistencia->execute();

            if ($verificarExistencia->fetchColumn() > 0) {
                // El registro existe, realiza la actualización
                $update = $pdo->prepare("UPDATE mytable SET nombre = :nombre, direccion = :direccion, telefono = :telefono WHERE clave = :clave");
                $update->bindParam(':nombre', $nombre);
                $update->bindParam(':direccion', $direccion);
                $update->bindParam(':telefono', $telefono);
                $update->bindParam(':clave', $idEditar);

                $update->execute();

                echo "alaverga";
    
            // Redirige a la página deseada después de la actualización
            header('Location: index.php');
            exit();
        } else {
            // El registro a editar no existe, muestra un mensaje de error o redirige a una página de error
            echo 'El registro a editar no existe.';
        }
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    } finally {
        if ($pdo) {
            $pdo = null;
        }
    }    
}
?>