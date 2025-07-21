<?php
//el primer corchete es el name que esta en mi formulario
$file_name = $_FILES['archivo']['name'];   //Nombre real 
$file_tmp = $_FILES['archivo']['tmp_name']; //Nombre temporal
// explode toma una cadena, la separa dependiendo el paramatro y lo separado se guarda en un arreglo
$arreglo = explode(".",$file_name); //Separa el nombre
$len = count($arreglo); //cuenta elementos del arreglo
$pos = $len - 1; //obtiene posicion
$ext = $arreglo[$pos]; //extension
$dir = "archivos/"; //carpeta donde se guarda
$file_enc = md5_file($file_tmp); //nombre del archivo temporal

echo "file_name: $file_name <br>";
echo "file_tmp: $file_tmp <br>";
echo "ext: $ext <br>";
echo "file_enc: $file_enc <br>";

if($file_name !=''){
	$fileName1 = "$file_enc.$ext";
	copy($file_tmp, $dir.$fileName1);
}

?>