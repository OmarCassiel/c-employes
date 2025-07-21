<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 10px 0;
        }

        form {
            background-color: white;
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type=text], input[type=password] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type=submit] {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 3px;
        }

        input[type=submit]:hover {
            background-color: #555;
        }

        .mensaje {
            color: #f00;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>LOGIN EMPLEADOS</h1>
		<h5>C-Employers</h5>
    </header>
    <form id="Forma01" onsubmit="validar(); return false;">
        <label for="correo">Correo</label><br>
        <input type="text" name="correo" id="correo" placeholder="Escribe tu correo"><br>
        <label for="pass">Contraseña</label><br>
        <input type="password" name="pass" id="pass" placeholder="Escribe tu contraseña"><br>
        <input type="submit" value="Enviar">
        <div id="mensaje" class="mensaje"></div>
    </form>
    
    <!-- Recuerda incluir el archivo jQuery -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function validar() {
            var correo = document.getElementById('correo').value;
            var pass = document.getElementById('pass').value;
            
            if (correo === "" || pass === "") {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout(function() {
                    $('#mensaje').html('');
                }, 5000);
            } else {
                // Ejecutar ajax
                $.ajax({
                    url: './funciones/validaUsuario.php',
                    type: 'post',
                    dataType: 'text',
                    data: 'correo=' + correo + '&pass=' + pass,
                    success: function(res) {
                        console.log(res);
                        if (res === "1") {
                            window.location.href = 'empleados_lista.php';
                        } else {
                            $('#mensaje').html('Información errónea');
                            setTimeout(function() {
                                $('#mensaje').html('');
                            }, 5000);
                        }
                    }
                });
            }
        }
    </script>
</body>
</html>
