<?php
session_start();
if(!isset($_SESSION["correo"])){
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
        $status = $row["status"] == '1' ? 'Activo' : 'Inactivo';      
    } else {
        echo "Empleado no encontrado.";
    }
} else {
    echo "ID de empleado no especificado.";
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados edicion</title>
    
    <style>

        #yaUsado {
            color: #f00;
            font-size: 16px;
        }

        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            width: 100%;
            background-color: #333;
            color: white;
            padding: 10px 0;
        }

        hr {
            height: 1px;
            background-color: black;
        }

        form {
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            max-width: 600px; /* Ajusta el ancho máximo */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type=text], input[type=password], select {
            width: 100%; /* Haz que los campos de entrada ocupen todo el ancho disponible */
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type=submit] {
            background-color: #04AA6D;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 0;
            cursor: pointer;
            display: block; /* Haz que el botón ocupe todo el ancho disponible */
            border-radius: 5px;
            width: 100%;
        }

        select {
            width: 50%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        #mensaje, #yaUsado {
            color: #f00;
            font-size: 16px;
            margin-top: 8px;
        }
    </style>
    <script src="js/jquery-3.3.1.min.js"></script>

    <script>
        function validar() {
            var correo = document.getElementById('correo').value;
            var pass = document.getElementById('pass').value;
            var rol = document.getElementById('rol').value;
            var nombre = document.getElementById('nombre').value;
            var apellidos = document.getElementById('apellidos').value;

            if (correo == "" || rol == 0 || nombre == "" || apellidos == "") {
                $('#mensaje').html('Faltan campos por llenar...');
                setTimeout("$('#mensaje').html('');", 5000);
            } else {
                //alert("Campos llenos")
                document.Forma01.method = 'post';
                document.Forma01.action = 'empleados_actualizar.php';
                document.Forma01.submit();
            }
        }

           function validarCorreo() {
            var correo = $('#correo').val();
            var id_empleado = <?= $id ?>;
            $.ajax({
                url: 'verificaCorreoActualizado.php',
                type: 'post',
                data: {correo: correo, id_empleado: id_empleado},
                success: function (response) {
                    console.log(response);
                    if (response === "si") {
                        $('#yaUsado').html('El correo ' + correo + ' ya está registrado');
                        setTimeout("$('#yaUsado').html('');", 5000);
                        document.getElementById('correo').value = '';
                    }
                }
            });
        }
    </script>
</head>
<body>

<form name="Forma01" id="Forma01" enctype="multipart/form-data">
        <header><h1>EDICION EMPLEADO</h1></header>
        <hr>
        <a href="empleados_lista.php" style="text-decoration: none; color: white; background-color: #333; border: none; padding: 10px 20px; margin-bottom: 20px; display: inline-block; border-radius: 5px;">Regresar al listado</a> <br>
        <input type="text" name="nombre" id="nombre" value="<?= $nombre ?>"/> <br>
        <input type="text" name="apellidos" id="apellidos" value="<?= $apellidos ?>" /> <br>
        <input type="text" name="correo" id="correo" value="<?= $correo ?>" onBlur="validarCorreo();" /> <br>
        <div id="yaUsado"></div>
        <input type="text" name="pass" id="pass" placeholder="Nuevo pass(opcional)" /> <br>

        <select name="rol" id="rol">
            <option value="0">Selecciona</option>
            <option value="1" <?php if ($rol == 'Gerente') echo 'selected="selected"'; ?>>Gerente</option>
            <option value="2" <?php if ($rol == 'Ejecutivo') echo 'selected="selected"'; ?>>Ejecutivo</option>
        </select> <br>
        <input type="file" id="archivo" name="archivo"><br>
        <input type="submit" onclick="validar(); return false;" value="Salvar"/>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div id="mensaje"></div>
    </form>

</body>
</html>
