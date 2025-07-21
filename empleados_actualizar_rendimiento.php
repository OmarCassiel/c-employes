<?php 
require "funciones/conecta.php";

$con = conecta();
$id = $_REQUEST['id'];


$tareas_realizadas = $_REQUEST['tareas_realizadas'];
$horas_trabajadas = $_REQUEST['horas_trabajadas'];
$asistenciaPorcentaje = $_REQUEST['asistenciaPorcentaje'];

$sql = "UPDATE empleados SET tareas_realizadas = $tareas_realizadas, horas_trabajadas = $horas_trabajadas, asistenciaPorcentaje=$asistenciaPorcentaje WHERE id = $id";
$res = $con->query($sql);
header("Location: empleados_lista.php");

?>