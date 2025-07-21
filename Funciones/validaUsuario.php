<?php
//validUsuario.php
//inicia una sesion
require "conecta.php";
$con = conecta();

$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$pass = md5($pass);

$sql = "SELECT * FROM empleados WHERE status = 1 AND eliminado = 0 AND correo = '$correo' AND pass = '$pass'";

$res = $con->query($sql);
$num = $res->num_rows;
echo $num;
session_start();
$_SESSION["correo"] = $correo;

/*if($num == 1){
	session_start();
	$row = $res->fetch_array();
	$id = $row["id"];
	$nombre = $row["nombre"].' '.$row["apellidos"];
	$correo = $row['correo'];
	//LO QUE ESTA EN LOS CORCHETES ES LO QUE SE QUIERE SALVAR
	$_SESSION['id'] = $id;
	$_SESSION['nombre'] = $nombre;
	$_SESSION['correo'] = $correo;
}*/
?>