<?php
session_start();
include('./app/config/conexion.php');

// Verifica si el usuario ya está logueado
if (isset($_SESSION['usuario'])) {
    header('Location: admin.php'); // Redirige al admin si ya está logueado
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $anio_ingreso = $_POST['anio_ingreso'];
    $carrera = $_POST['carrera'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Inserta el nuevo alumno en la base de datos
    $sql = "INSERT INTO t_alumno (nombre, apellido, anio_ingreso, carrera, fecha_nacimiento, usuario, password) VALUES (:nombre, :apellido, :anio_ingreso, :carrera, :fecha_nacimiento, :usuario, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nombre' => $nombre,
        'apellido' => $apellido,
        'anio_ingreso' => $anio_ingreso,
        'carrera' => $carrera,
        'fecha_nacimiento' => $fecha_nacimiento,
        'usuario' => $usuario,
        'password' => $password // Recuerda que este es texto plano, asegúrate de manejarlo adecuadamente.
    ]);
    
    // Puedes redirigir a otra página o mostrar un mensaje
    header('Location: registro.php?success=1'); // Redirige después del registro
    exit;
}
?>
