<?php
require "funciones/conecta.php";
$con = conecta();
$idEmpleado = $_GET['id'];

// Consulta para obtener el empleado buscado
$sqlEmpleadoBuscado = "SELECT * FROM empleados WHERE id = $idEmpleado AND status = 1 AND eliminado = 0";
$resEmpleadoBuscado = $con->query($sqlEmpleadoBuscado);

// Consulta para obtener el resto de los empleados
$sqlEmpleadosRestantes = "SELECT * FROM empleados WHERE id != $idEmpleado AND status = 1 AND eliminado = 0";
$resEmpleadosRestantes = $con->query($sqlEmpleadosRestantes);

// Imprimir fila de encabezados de la tabla
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Nombre</th>";
echo "<th>Apellidos</th>";
echo "<th>Correo</th>";
echo "<th>Rol</th>";
echo "<th></th>";
echo "<th></th>";
echo "<th></th>";
echo "</tr>";

// Si se encontró el empleado buscado
if ($resEmpleadoBuscado->num_rows > 0) {
    // Imprimir la fila del empleado buscado
    while($row = $resEmpleadoBuscado->fetch_array()) {
        // Generar la fila del empleado buscado
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["apellidos"] . "</td>";
        echo "<td>" . $row["correo"] . "</td>";
        echo "<td>" . ($row["rol"] == '1' ? 'Gerente' : 'Ejecutivo') . "</td>";
        echo "<td><button onclick=\"enviaAjax(" . $row["id"] . ");\">Eliminar</button></td>";
        echo "<td><button onclick=\"verDetalle(" . $row["id"] . ");\">Detalle</button></td>";
        echo "<td><button onclick=\"editar(" . $row["id"] . ");\">Editar</button></td>";
        echo "</tr>";
    }
}

// Si hay más empleados, imprimir el resto de la lista
if ($resEmpleadosRestantes->num_rows > 0) {
    while($row = $resEmpleadosRestantes->fetch_array()) {
        // Generar la fila para el resto de los empleados
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["apellidos"] . "</td>";
        echo "<td>" . $row["correo"] . "</td>";
        echo "<td>" . ($row["rol"] == '1' ? 'Gerente' : 'Ejecutivo') . "</td>";
        echo "<td><button onclick=\"enviaAjax(" . $row["id"] . ");\">Eliminar</button></td>";
        echo "<td><button onclick=\"verDetalle(" . $row["id"] . ");\">Detalle</button></td>";
        echo "<td><button onclick=\"editar(" . $row["id"] . ");\">Editar</button></td>";
        echo "</tr>";
    }
}
?>

