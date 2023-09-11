<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" /> 
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <title>REGISTRO</title>
    </head>
    <body>
    <?php
    $url = "pgsql:host=172.17.0.2;port=5432;dbname=mydb;";
    $pdo = new PDO($url, "postgres", "password", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        if (isset($_GET['editar'])) {
            $idEditar = $_GET['editar'];

            // Realiza una consulta SELECT para obtener los datos del registro con el ID seleccionado
            $selectById = $pdo->prepare("SELECT * FROM mytable WHERE clave = :clave");
            $selectById->bindParam(':clave', $idEditar);
            $selectById->execute();
            $registroEditar = $selectById->fetch(PDO::FETCH_ASSOC);

    // Rellena el formulario con los datos del registro seleccionado para editar
            if ($registroEditar) {
            $nombre = $registroEditar['nombre'];
            $direccion = $registroEditar['direccion'];
            $telefono = $registroEditar['telefono'];
            }
        }
    ?>

        <form action=alta.php method=POST autocomplete="off">
            <h1>INGRESA LOS DATOS DEL FORMULARIO</h1>
            <div>
                <table>
                    <tr>
                        <td>Nombre: </td>
                        <td><input class="input" type="text" name="nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>" required/></td>
                    </tr>
                    <tr>
                        <td>Direccion: </td>
                        <td><input class="input" type="text" name="direccion" value="<?php echo isset($direccion) ? $direccion : ''; ?>" required/></td>
                    </tr> 
                    <tr>
                        <td>Telefono: </td>
                        <td><input class="input" type="text" name="telefono" value="<?php echo isset($telefono) ? $telefono : ''; ?>" required/></td>
                    </tr>
                </table>
            </div>
            <input type="hidden" name="idEditar" value="<?php echo isset($idEditar) ? $idEditar : ''; ?>">
            <input  type=submit class="button asigCompeButton" name=Submit value="Guardar">
            
        </form>
        <?php
            // Incluye el archivo get.php para mostrar los resultados de la consulta
             include('get.php');
         ?>
    </body>
</html>