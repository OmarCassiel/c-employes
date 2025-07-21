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
        echo "<header style='background-color: #333; color: white; padding: 10px 0; text-align: center;'>
                <h1>Agregar horas trabajadas/tareas realizadas</h1>
              </header>";
        echo "<div style='display: flex; justify-content: space-around;'>";
        echo "<form style='background-color: white; width: 300px; margin: 20px; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>";
        echo "<table id='listaEmpleadosDetalle' border='1'>";
         echo "<a href='empleados_lista.php' style='display: block; text-align: center; text-decoration: none; color: white; background-color: #333; border: none; padding: 10px 20px; margin-top: 10px; cursor: pointer; border-radius: 3px;'>Regresar a la lista</a>";
        echo "<br>";
        echo "<tr>";
        echo "<td style='background-color: #333; color: white; padding: 10px;'>Nombre</td>";
        echo "<td style='padding: 10px;'>$nombre</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td style='background-color: #333; color: white; padding: 10px;'>Apellidos</td>";
        echo "<td style='padding: 10px;'>$apellidos</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td style='background-color: #333; color: white; padding: 10px;'>Rol</td>";
        echo "<td style='padding: 10px;'>$rol</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td style='background-color: #333; color: white; padding: 10px;'>Horas trabajas</td>";
        echo "<td style='padding: 10px;'>$horas_trabajadas</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td style='background-color: #333; color: white; padding: 10px;'>Tareas realizadas</td>";
        echo "<td style='padding: 10px;'>$tareas_realizadas</td>";
        echo "</tr>";
        echo "</table>";
        echo "<img src='archivos/$archivo' style='display: block; margin: 20px auto;' width='200' height='200'>";
        echo "</form>";
        echo "<div style='width: 600px;'>"; // Ajusta el ancho del contenedor
        echo "<canvas id='myChart' style='width: 100%; height: 100%;'></canvas>"; // Ajusta el tamaño del lienzo de la gráfica
        echo "</div>";
        echo "</div>";
    } else {
        echo "Empleado no encontrado.";
    }
} else {
    echo "ID de empleado no especificado.";
}

?>

<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados edicion</title>
    
    <style>
        #mensaje {
            color: #f00;
            font-size: 16px;
        }

        #yaUsado {
            color: #f00;
            font-size: 16px;
        }

        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 10px 0;
        }

        hr {
            height: 1px;
            background-color: black;
        }

        form {
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            width: 90%; /* Ajustar el ancho al 90% del contenedor */
            max-width: 600px; /* Limitar el ancho máximo */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #04AA6D;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
        }
        select {
            width: 100%; /* Ajustar al 100% del contenedor */
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        #yaUsado {
            color: #f00;
            font-size: 16px;
        }
    </style>
    <script src="js/jquery-3.3.1.min.js"></script>

    <script>
        function validar() {
            document.Forma01.method = 'post';
            document.Forma01.action = 'empleados_actualizar_rendimiento.php';
            document.Forma01.submit();

        }

    </script>
</head>

<body>
<div style='margin-left:500px; margin-top:-500'>
    <form name="Forma01" id="Forma01" >
        
        <label for="horas_trabajadas">Horas trabajadas</label>
        <input type="text" name="horas_trabajadas" id="horas_trabajadas" value="<?= $horas_trabajadas ?>"  /> <br>
        <div id="yaUsado"></div>
        <label for="tareas_realizadas">Tareas realizadas</label>
        <input type="text" name="tareas_realizadas" id="tareas_realizadas" value=" <?= $tareas_realizadas ?> " /> <br>
        <label for="asistenciaPorcentaje">% de asistencias</label>
        <input type="text" name="asistenciaPorcentaje" id="asistenciaPorcentaje" value=" <?= $asistenciaPorcentaje ?> " /> <br>

        <input type="submit" onclick="validar(); return false;" value="Salvar"/>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div id="mensaje"></div>
        
    </form>
    <div>
</body>
    
</html>