<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center">
        <h1>Bienvenido al Sistema de Gestión</h1>
        <div class="mt-4">
            <a href="login.php" class="btn btn-primary">Iniciar Sesión</a>
            <a href="registro.php" class="btn btn-success">Registrar Alumno</a>
        </div>
    </div>
</body>
</html>
