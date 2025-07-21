<?php
session_start();
if(!isset($_SESSION["correo"])){
	header("Location: index.php");
}
?>

<html>
	<head>
		<style>
			body {
				font-family: Arial, sans-serif;
				background-color: white;
				margin: 0;
				padding: 0;
			}
			*{
				margin: 0;
				padding: 0;	
			}

			header {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 10px 0;
        }

		hr {
 		   	height: 1px;
 			background-color: black;
		}
		a {
            text-decoration: none;
            color: white;
            background-color: gray;
            text-align: center;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin: 20px auto;
        }
		</style>
		<script src="js/jquery-3.3.1.min.js"></script>

	</head>
	
	<body>
		<header><h1>Pagina principal</h1></header>
		<hr>
		Bienvenido al sistema 
		<br>
		<a href="empleados_lista.php">Lista empleados</a>
   		<a href="Funciones/cerrarSesion.php">Cerrar sesion</a>
              
	</body>
</html>