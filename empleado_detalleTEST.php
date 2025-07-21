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

        // Mostrar los detalles del empleado
        echo "<header style='background-color: #333; color: white; padding: 10px 0; text-align: center;'>
                <h1>Detalles del empleado</h1>
              </header>";
              echo "<div style='display: flex; justify-content: space-around;'>";
              echo "<form id='formActualizar' style='background-color: white; width: 300px; margin: 20px; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>";
              echo "<select id='selectOpciones'>";
              echo "<option value='tareas'>Tareas realizadas</option>";
              echo "<option value='horas'>Horas trabajadas</option>";
              echo "<option value='rendimiento'>Rendimiento</option>";
              echo "</select>";
              echo "<button type='button' onclick='actualizarGrafica()'>Confirmar</button>";
              echo "</form>";
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

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle empleados</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

</head>

<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; margin: 0; padding: 0;">
   

    <script>
        const ctx = document.getElementById('myChart');

         const tareasRealizadas = <?php echo $tareas_realizadas ?>;
         const horasTrabajadas = <?php echo $horas_trabajadas ?>;

         var rendimiento = (tareasRealizadas+horasTrabajadas)/2;

const backgroundColorTareas = tareasRealizadas >= 10 ? 'rgba(0, 255, 0, 0.2)' : (tareasRealizadas <= 5 ? 'rgba(255, 0, 0, 0.2)' : 'rgba(255, 255, 0, 0.2)');
const backgroundColorHoras = horasTrabajadas >= 48 ? 'rgba(0, 255, 0, 0.2)' : (horasTrabajadas <= 24 ? 'rgba(255, 0, 0, 0.2)' : 'rgba(255, 255, 0, 0.2)');
const backgroundColorRendimiento = rendimiento >= 29 ? 'rgba(0, 255, 0, 0.2)' : (rendimiento <= 13 ? 'rgba(255, 0, 0, 0.2)' : 'rgba(255, 255, 0, 0.2)');


  

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tareas realizadas', 'Horas trabajadas', 'Rendimiento'],
                datasets: [{
                    label: 'Rendimiento de <?php echo "$nombre" ?>',
                    data: [tareasRealizadas, horasTrabajadas, rendimiento],
                    backgroundColor: [
                        backgroundColorTareas,
                        backgroundColorHoras,
                        backgroundColorRendimiento
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
    <div style='width: 600px;'> <!-- Ajusta el ancho del contenedor -->
    <canvas id='myChart' style='width: 100%; height: 100%;'></canvas> <!-- Ajusta el tamaño del lienzo de la gráfica -->
</div>

<div style='width: 600px;'> <!-- Ajusta el ancho del contenedor -->
    <canvas id='myChart' style='width: 100%; height: 100%;'></canvas> <!-- Ajusta el tamaño del lienzo de la gráfica -->
</div>

<script>
let myChart = null;

function actualizarGrafica() {
    const select = document.getElementById('selectOpciones');
    const opcionSeleccionada = select.value;
    let newData = [];

    <?php
    // Incorpora el código PHP para obtener los nuevos datos según la opción seleccionada por el usuario.
    echo "const nombre = '$nombre';";
    ?>

    switch (opcionSeleccionada) {
        case 'tareas':
            newData = [<?php echo $tareas_realizadas; ?>, <?php echo $horas_trabajadas; ?>, (<?php echo $tareas_realizadas; ?> + <?php echo $horas_trabajadas; ?>) / 2];
            break;
        case 'horas':
            newData = [<?php echo $horas_trabajadas; ?>, <?php echo $tareas_realizadas; ?>, (<?php echo $tareas_realizadas; ?> + <?php echo $horas_trabajadas; ?>) / 2];
            break;
        case 'rendimiento':
            newData = [(<?php echo $tareas_realizadas; ?> + <?php echo $horas_trabajadas; ?>) / 2, <?php echo $tareas_realizadas; ?>, <?php echo $horas_trabajadas; ?>];
            break;
    }

    // Destruir la instancia anterior del gráfico si existe
    if (myChart !== null && myChart !== undefined) {
        myChart.destroy();
    }

    // Crear una nueva instancia de Chart
    myChart = new Chart(document.getElementById('myChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Tareas realizadas', 'Horas trabajadas', 'Rendimiento'],
            datasets: [{
                label: 'Rendimiento de ' + nombre,
                data: newData,
                backgroundColor: [
                    <?php
                    // Agrega aquí la lógica para establecer los colores de fondo según los nuevos datos.
                    echo "newData[0] >= 10 ? 'rgba(0, 255, 0, 0.2)' : (newData[0] <= 5 ? 'rgba(255, 0, 0, 0.2)' : 'rgba(255, 255, 0, 0.2)'),";
                    echo "newData[1] >= 48 ? 'rgba(0, 255, 0, 0.2)' : (newData[1] <= 24 ? 'rgba(255, 0, 0, 0.2)' : 'rgba(255, 255, 0, 0.2)'),";
                    echo "newData[2] >= 29 ? 'rgba(0, 255, 0, 0.2)' : (newData[2] <= 13 ? 'rgba(255, 0, 0, 0.2)' : 'rgba(255, 255, 0, 0.2)')";
                    ?>
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
</script>

</body>
</html>
