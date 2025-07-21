<?php
require "funciones/conecta.php";
$con = conecta();

$correo = $_POST['correo'];
$id_empleado = $_POST['id_empleado'];

$sql = "SELECT correo FROM empleados WHERE correo = '$correo' AND id != $id_empleado AND eliminado = 0";
$res = $con->query($sql);

if ($res->num_rows > 0) {
  echo 'si';
} else {
  echo 'no';
}
?>
