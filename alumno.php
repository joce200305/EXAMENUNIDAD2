<?php
session_start();
include('./app/config/conexion.php');

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Obtiene la información del usuario
$sql = "SELECT usuario, rol FROM t_usuario WHERE usuario = :usuario";
$stmt = $pdo->prepare($sql);
$stmt->execute(['usuario' => $_SESSION['usuario']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Aquí va tu formulario -->
        <form id="registroForm">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="anio_ingreso">Año de Ingreso:</label>
                <input type="number" id="anio_ingreso" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="carrera">Carrera:</label>
                <input type="text" id="carrera" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>

        <!-- Aquí va la lista de alumnos -->
        <div id="listaAlumnos" class="mt-5"></div>
    </div>

    <script src="./public/js/admin.js"></script> <!-- Carga de tu archivo JavaScript -->
</body>
</html>
