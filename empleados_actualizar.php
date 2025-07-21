<?php
//empleados_actualizar.php
require "funciones/conecta.php";

$con = conecta();
$id = $_REQUEST['id'];

// Recibe variables
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];
$archivo_n = $_FILES['archivo']['name'];
$archivo = $_FILES['archivo']['tmp_name'];

$arreglo = explode(".", $archivo_n);
$len = count($arreglo);
$pos = $len - 1;
$ext = $arreglo[$pos];
$dir = "archivos/";
//$file_enc = md5_file($archivo);
$file_enc = !empty($archivo) ? md5_file($archivo) : '';
$passEnc = md5($pass);

// Inicializa un array para almacenar los campos a actualizar
$updateData = array();

// Verifica y agrega los campos que están llenos
if (!empty($nombre)) {
    $updateData[] = "nombre = '$nombre'";
}
if (!empty($apellidos)) {
    $updateData[] = "apellidos = '$apellidos'";
}
if (!empty($correo)) {
    $updateData[] = "correo = '$correo'";
}
if (!empty($pass)) {
    $updateData[] = "pass = '$passEnc'";
}
if (!empty($rol)) {
    $updateData[] = "rol = $rol";
}
//if (!empty($archivo_n)) {
  //  $fileName1 = "$file_enc.$ext";
    //copy($archivo, $dir . $fileName1);
    //$updateData[] = "archivo_n = '$archivo_n', archivo = '$file_enc.$ext'";
//}
if (!empty($archivo_n) && !empty($archivo)) {
    $fileName1 = "$file_enc.$ext";
    copy($archivo, $dir . $fileName1);
    $updateData[] = "archivo_n = '$archivo_n', archivo = '$file_enc.$ext'";
} elseif (!empty($archivo_n)) {
    $updateData[] = "archivo_n = '$archivo_n'";
}

// Construye la parte SET de la consulta solo si hay campos para actualizar
$updateSet = !empty($updateData) ? implode(", ", $updateData) : '';

// Construye la consulta final
$sql = "UPDATE empleados SET $updateSet WHERE id = $id";

$res = $con->query($sql);
header("Location: empleados_lista.php");
?>