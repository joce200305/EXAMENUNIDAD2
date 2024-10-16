<?php
session_start();
include('./app/config/conexion.php');

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Obtiene la información del alumno
$usuario = $_SESSION['usuario'];
$sql = "SELECT * FROM t_usuario WHERE usuario = :usuario";
$stmt = $pdo->prepare($sql);
$stmt->execute(['usuario' => $usuario]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Muestra la información del alumno
if ($user) {
    echo "Nombre de usuario: " . $user['usuario'] . "<br>";
    echo "Rol: " . $user['rol'] . "<br>";
    // Puedes agregar más información que desees mostrar
} else {
    echo "No se encontró información para este usuario.";
}
?>
