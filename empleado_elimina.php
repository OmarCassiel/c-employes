<?php
// empleado_elimina.php
require "funciones/conecta.php";

// Siempre que quieras hacer una conexión a una base de datos, se ocupan las siguientes líneas
$con = conecta();

// Obtén el ID del empleado a eliminar desde la solicitud
$id = $_POST['id'];

// Sintaxis para actualizar el estado del empleado a "eliminado"
$sql = "UPDATE empleados SET eliminado = 1 WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);

// Ejecuta la consulta preparada
if ($stmt->execute()) {
    // Si la eliminación fue exitosa, devuelve "si" como respuesta
    echo "si";
} else {
    // Si hubo un error en la eliminación, devuelve "no" como respuesta
    echo "no";
}
?>
