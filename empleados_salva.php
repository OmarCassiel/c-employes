<?php
//empleados_salva.php
require "funciones/conecta.php";
$con = conecta();

//Recibe variables
//lo que esta en los corchetes es el name del campo
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];
//$archivo_n = '';
//$archivo = '';
//el primer corchete es el name que esta en mi formulario
$archivo_n = $_FILES['archivo']['name'];   //Nombre real 
$archivo = $_FILES['archivo']['tmp_name']; //Nombre temporal
// explode toma una cadena, la separa dependiendo el paramatro y lo separado se guarda en un arreglo
$arreglo = explode(".",$archivo_n); //Separa el nombre
$len = count($arreglo); //cuenta elementos del arreglo
$pos = $len - 1; //obtiene posicion
$ext = $arreglo[$pos]; //extension
$dir = "archivos/"; //carpeta donde se guarda
$file_enc = md5_file($archivo); //nombre del archivo temporal
$passEnc = md5($pass);

if($archivo_n !=''){
	$fileName1 = "$file_enc.$ext";
	copy($archivo, $dir.$fileName1);
}
$archivo=$file_enc.".".$ext;

$sql = "INSERT INTO empleados (nombre, apellidos, correo, pass, rol, archivo_n, archivo) VALUES('$nombre','$apellidos', '$correo', '$passEnc', $rol, '$archivo_n', '$archivo')";

$res = $con->query($sql);
header("Location: empleados_lista.php");
?>