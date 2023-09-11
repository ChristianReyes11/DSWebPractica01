<?php
try {
    $url = "pgsql:host=172.17.0.2;port=5432;dbname=mydb;";
    $pdo = new PDO($url, "postgres", "password", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($pdo) {
        $select = $pdo->prepare("SELECT * FROM mytable");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);

        // Comprueba si hay resultados antes de mostrar la tabla
        if (count($result) > 0) {
            echo '<h2>Resultados:</h2>';
            echo '<table border="1">';
            echo '<tr>
                    <th> Clave </th>
                    <th> Nombre </th>
                    <th> Direccion </th>
                    <th> Telefono </th>
                    <th> Actualizar </th>
                    <th> Eliminar </th> </tr>';
            
            foreach ($result as $row) {
                echo '<tr>';
                echo '<td><a href="index.php?clave=' . $row['clave'] . '">' . $row['clave'] . '</a></td>';
                echo '<td>' . $row['nombre'] . '</td>';
                echo '<td>' . $row['direccion'] . '</td>';
                echo '<td>' . $row['telefono'] . '</td>';
                echo '<td><a href="index.php?editar=' . $row['clave'] . '">Editar</a></td>';
                echo '<td><a href="delete.php?eliminar=' . $row['clave'] . '">Eliminar</a></td>';

                echo '</tr>';
            }
            
            echo '</table>';
        }
        //Search by ID
        if (isset($_GET['clave'])) {
            $idSeleccionado = $_GET['clave'];

            // Realiza una consulta SELECT para obtener los datos del registro con el ID seleccionado
            $selectById = $pdo->prepare("SELECT * FROM mytable WHERE clave = :id");
            $selectById->bindParam(':id', $idSeleccionado);
            $selectById->execute();
            $registroSeleccionado = $selectById->fetch(PDO::FETCH_ASSOC);

            // Muestra los detalles del registro seleccionado
            if ($registroSeleccionado) {
                echo '<h2>Detalles del Registro Seleccionado:</h2>';
                echo 'Clave: ' . $registroSeleccionado['clave'] . '<br>';
                echo 'Nombre: ' . $registroSeleccionado['nombre'] . '<br>';
                echo 'Direccion: ' . $registroSeleccionado['direccion'] . '<br>';
                echo 'Telefono: ' . $registroSeleccionado['telefono'] . '<br>';
            }
        }
    }
} catch (PDOException $e) {
    die($e->getMessage());
} finally {
    if ($pdo) {
        $pdo = null;
    }
}
?>
