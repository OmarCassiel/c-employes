<?php
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
        $asistenciaPorcentaje = $row['asistenciaPorcentaje'];
        $calidad = ($tareas_realizadas + $horas_trabajadas) / 2;

        if ($tareas_realizadas > $horas_trabajadas / 8) {
            $calificacionCalidad = "Bueno";
        } else {
            $calificacionCalidad = "Malo";
        }

        echo "<header style='background-color: #333; color: white; padding: 10px 0; text-align: center;'>
                <h1>Detalles del empleado</h1>
              </header>";
        echo "<div style='display: flex; flex-direction: column; align-items: center;'>";
        echo "<form style='background-color: white; max-width: 90%; margin: 20px; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>";
        echo "<table id='listaEmpleadosDetalle' style='width: 100%;'>";
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
        echo "<tr>";
        echo "<td style='background-color: #333; color: white; padding: 10px;'>Calidad</td>";
        echo "<td style='padding: 10px;'>$calificacionCalidad</td>";
        echo "</tr>";
        echo "</table>";
        echo "<img src='archivos/$archivo' style='width: 300px; height: auto;'>'>";
        echo "</form>";
        echo "<div style='width: 100%; max-width: 1200px;'>";
        echo "<canvas id='myChart'></canvas>";
        echo "</div>";
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

        const tareasRealizadas = <?php echo $tareas_realizadas ?>;
        const horasTrabajadas = <?php echo $horas_trabajadas ?>;
        const asistenciaPorcentaje = <?php echo $asistenciaPorcentaje ?>;

        var rendimiento = (tareasRealizadas + horasTrabajadas) / 2;



        const backgroundColorTareas = tareasRealizadas >= 10 ? 'rgba(0, 255, 0, 0.2)' : (tareasRealizadas <= 5 ? 'rgba(255, 0, 0, 0.2)' : 'rgba(255, 255, 0, 0.2)');
        const backgroundColorHoras = horasTrabajadas >= 48 ? 'rgba(0, 255, 0, 0.2)' : (horasTrabajadas <= 24 ? 'rgba(255, 0, 0, 0.2)' : 'rgba(255, 255, 0, 0.2)');
        const backgroundColorRendimiento = rendimiento >= 29 ? 'rgba(0, 255, 0, 0.2)' : (rendimiento <= 13 ? 'rgba(255, 0, 0, 0.2)' : 'rgba(255, 255, 0, 0.2)');
        const backgroundColorAsistenciaPorcentaje = asistenciaPorcentaje >= 10 ? 'rgba(0, 255, 0, 0.2)' : (asistenciaPorcentaje <= 5 ? 'rgba(255, 0, 0, 0.2)' : 'rgba(255, 255, 0, 0.2)');



        const labels = ['Tareas realizadas', 'Horas trabajadas', 'Rendimiento', '% de Asistencia'];
        const data = [tareasRealizadas, horasTrabajadas, rendimiento, asistenciaPorcentaje];
        const backgroundColors = [
            backgroundColorTareas,
            backgroundColorHoras,
            backgroundColorRendimiento,
            backgroundColorAsistenciaPorcentaje,
        ];

        const datasets = [{
            label: 'Rendimiento de <?php echo "$nombre" ?>',
            data: data,
            backgroundColor: backgroundColors,
            borderWidth: 1
        }];

        const chartData = {
            labels: labels,
            datasets: datasets
        };

        const chartOptions = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: chartOptions
        });

        // Guardar los datos originales del gráfico
        const originalData = data.slice();
        const originalBackgroundColors = backgroundColors.slice();

        // Función para ocultar o mostrar una columna según el estado de los checkboxes
        function toggleColumn() {
            // Restaurar los datos originales
            restoreOriginalData();

            // Obtener todos los checkboxes
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            // Iterar sobre los checkboxes y actualizar el gráfico
            checkboxes.forEach((checkbox, index) => {
                if (!checkbox.checked) {
                    myChart.data.datasets[0].data[index] = null;
                    myChart.data.datasets[0].backgroundColor[index] = 'rgba(0, 0, 0, 0)'; // Color transparente
                }
            });

            myChart.update();
        }

        // Función para restaurar los datos originales del gráfico
        function restoreOriginalData() {
            myChart.data.datasets[0].data = originalData.slice();
            myChart.data.datasets[0].backgroundColor = originalBackgroundColors.slice();
        }

        // Llamar a toggleColumn cuando la página se cargue por primera vez
        window.onload = toggleColumn;
    </script>

    <div style="text-align: center; margin-top: 40px;">
        <input type="checkbox" id="checkboxTareas" onchange="toggleColumn()" checked>
        <label for="checkboxTareas">Tareas realizadas</label>

        <input type="checkbox" id="checkboxHoras" onchange="toggleColumn()" checked>
        <label for="checkboxHoras">Horas trabajadas</label>

        <input type="checkbox" id="checkboxRendimiento" onchange="toggleColumn()">
        <label for="checkboxRendimiento">Rendimiento</label>

        <input type="checkbox" id="porcentajeFaltas" onchange="toggleColumn()">
        <label for="porcentajeFaltas">% de asistencias</label>
    </div>
    <div style='margin-top:100px;'>
    </div>

</body>

</html>
