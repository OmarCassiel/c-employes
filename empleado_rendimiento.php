<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados edicion</title>
    
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: none;
            border-radius: 5px;
            background-color: #f0f0f0;
            font-size: 16px;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        form {
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            max-width: 600px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            
        }

        img {
            display: block;
            margin: 20px auto;
            max-width: 100%;
            height: auto;
        }

        /* Media queries para dispositivos móviles */
        @media screen and (max-width: 600px) {
            form {
                padding: 10px;
            }
            table {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <?php 
    // empleado_rendimineto.php
    session_start();
    if (!isset($_SESSION["correo"])) {
        header("Location: index.php");
    }
    require "funciones/conecta.php";
    $con = conecta();


    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM empleados WHERE id = $id";
        $res = $con->query($sql);

        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];
            $correo = $row["correo"];
            $rol = $row["rol"] == '1' ? 'Gerente' : 'Ejecutivo';
            $archivo = $row["archivo"];
            $status = $row["status"] == '1' ? 'Activo' : 'Inactivo';
            $tareas_realizadas = $row["tareas_realizadas"];
            $horas_trabajadas = $row["horas_trabajadas"];
            $asistenciaPorcentaje=$row['asistenciaPorcentaje'];

            // Mostrar los detalles del empleado
            echo "<header>
                    <h1>Agregar horas trabajadas/tareas realizadas</h1>
                  </header>";
            echo "<div>";
            echo "<a href='empleados_lista.php' style='display: block; text-align: center; text-decoration: none; color: white; background-color: #333; border: none; padding: 10px 20px; margin-top: 10px; cursor: pointer; border-radius: 3px;'>Regresar a la lista</a>";
            echo "</div>";
            echo "<form action='empleados_actualizar_rendimiento.php' method='post'>";
            echo "<table>";
            echo "<tr>";
            echo "<td>Nombre</td>";
            echo "<td>$nombre</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Apellidos</td>";
            echo "<td>$apellidos</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Rol</td>";
            echo "<td>$rol</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Horas trabajas</td>";
            echo "<td>$horas_trabajadas</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Tareas realizadas</td>";
            echo "<td>$tareas_realizadas</td>";
            echo "</tr>";
            echo "</table>";
            echo "<img src='archivos/$archivo' alt='Imagen del empleado' style='width: 300px; height: auto;'>";
            echo "<label for='horas_trabajadas'>Horas trabajadas</label>";
            echo "<input type='text' name='horas_trabajadas' id='horas_trabajadas' value='$horas_trabajadas' /><br>";
            echo "<div id='yaUsado'></div>";
            echo "<label for='tareas_realizadas'>Tareas realizadas</label>";
            echo "<input type='text' name='tareas_realizadas' id='tareas_realizadas' value='$tareas_realizadas' /><br>";
            echo "<label for='asistenciaPorcentaje'>% de asistencias</label>";
            echo "<input type='text' name='asistenciaPorcentaje' id='asistenciaPorcentaje' value='$asistenciaPorcentaje' /><br>";
            echo "<input type='submit' value='Salvar'/>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<div id='mensaje'></div>";
            echo "</form>";
        } else {
            echo "Empleado no encontrado.";
        }
    } else {
        echo "ID de empleado no especificado.";
    }
    ?>
</body>
</html>
