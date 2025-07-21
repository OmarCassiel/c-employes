<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
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

        nav {
            text-align: center;
            margin-top: 20px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 3px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #ccc;
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
        <h1>Menú Principal</h1>
    </header>
    <nav>
        <a href="empleados_lista.php">Empleados</a>
        <!-- Agrega más enlaces aquí según sea necesario -->
    </nav>
</body>
</html>
