<?php
// empleado_detalle.php
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
        $asistenciaPorcentaje = $row["asistenciaPorcentaje"];

        // Mostrar los detalles del empleado
        echo "<header style='background-color: #333; color: white; padding: 10px 0; text-align: center;'>
                <h1>Detalles del empleado</h1>
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
        echo "<td style='background-color: #333; color: white; padding: 10px;'>Correo</td>";
        echo "<td style='padding: 10px;'>$correo</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td style='background-color: #333; color: white; padding: 10px;'>Rol</td>";
        echo "<td style='padding: 10px;'>$rol</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td style='background-color: #333; color: white; padding: 10px;'>Status</td>";
        echo "<td style='padding: 10px;'>$status</td>";
        echo "</tr>";
        echo "</table>";
        echo "<img src='archivos/$archivo' style='display: block; margin: 20px auto;' width='200' height='200'>";
        echo "</form>";
        echo "<div style='width: 600px;'>"; // Ajusta el ancho del contenedor
        echo "<form method='POST'>"; // Elimina el atributo 'action'
        echo "<select name='parametro'>";
        echo "<option value='horas_trabajadas'>Horas Trabajadas</option>";
        echo "<option value='tareas_realizadas'>Tareas Realizadas</option>"; // Agrega otras opciones según necesites
        echo "<option value='asistenciaPorcentaje'>Porcentaje de asistencias</option>";
        echo "</select>";
        echo "<button type='button' id='generarGrafica'>Generar Gráfica</button>"; // Cambia a un botón de tipo 'button'
        echo "</form>";
        echo "<canvas id='myChart' style='width: 100%; height: 100%;'></canvas>"; // Ajusta el tamaño del lienzo de la gráfica
        echo "</div>";
        
    } else {
        echo "Empleado no encontrado.";
    }
} else {
    echo "ID de empleado no especificado.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle empleados</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; margin: 0; padding: 0;">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tareas realizadas', 'Horas trabajadas'],
                datasets: [{
                    label: 'Rendimiento de <?php echo "$nombre" ?>',
                    data: [<?php echo $tareas_realizadas ?>, <?php echo $horas_trabajadas ?>],
                    backgroundColor: [
                        'rgba(255, 0, 0, 0.2)',
                        'rgba(0, 0, 255, 0.2)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


</body>
<script>
    let myChart;

    function dibujarGrafica() {
        const parametro = document.getElementById("parametro").value;
        const ctx = document.getElementById('myChart');

        if (myChart) {
            myChart.destroy();
        }

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = JSON.parse(xhr.responseText);
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data), // Usamos las claves como etiquetas
                        datasets: [{
                            label: 'Rendimiento de <?php echo "$nombre" ?>',
                            data: Object.values(data), // Usamos los valores como datos
                            backgroundColor: [
                                'rgba(255, 0, 0, 0.2)',
                                'rgba(0, 0, 255, 0.2)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        };
        xhr.open("GET", "empleado_detalle.php?parametro=" + parametro, true); // Cambia el nombre del archivo PHP si es diferente
        xhr.send();
    }

    dibujarGrafica();

    document.getElementById("generarGrafica").addEventListener("click", function(event) {
        event.preventDefault();
        dibujarGrafica();
    });
</script>
</html>
