<?php
session_start();
if ($_SESSION['rol'] !== 'administrador') {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Alumnos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Registro de Alumnos</h2>
        <form id="registroForm">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="anio_ingreso">Año de Ingreso</label>
                <input type="number" id="anio_ingreso" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="carrera">Carrera</label>
                <input type="text" id="carrera" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" id="fecha_nacimiento" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Alumno</button>
        </form>

        <h3 class="mt-5">Lista de Alumnos</h3>
        <div id="listaAlumnos">
            <!-- Aquí se cargan los alumnos -->
        </div>
    </div>

    <script src="./public/js/admin.js"></script> <!-- Aquí enlazamos el archivo JS -->
</body>
</html>
