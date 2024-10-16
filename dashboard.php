<?php
session_start();
if ($_SESSION['rol'] !== 'alumno') {
    header('Location: login.php');
    exit;
}

include('./config/conexion.php');

// Obtener la información del alumno
$usuario = $_SESSION['usuario'];
$sql = "SELECT * FROM t_alumno WHERE usuario = :usuario";
$stmt = $pdo->prepare($sql);
$stmt->execute(['usuario' => $usuario]);
$alumno = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$alumno) {
    echo "No se encontró información del alumno.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno - Información</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Información de Alumno</h2>
        <p><strong>Nombre:</strong> <?= $alumno['nombre']; ?></p>
        <p><strong>Apellido:</strong> <?= $alumno['apellido']; ?></p>
        <p><strong>Año de Ingreso:</strong> <?= $alumno['anio_ingreso']; ?></p>
        <p><strong>Carrera:</strong> <?= $alumno['carrera']; ?></p>
        <p><strong>Fecha de Nacimiento:</strong> <?= $alumno['fecha_nacimiento']; ?></p>

        <a href="logout.php" class="btn btn-danger mt-3">Cerrar Sesión</a>
    </div>
</body>
</html>
