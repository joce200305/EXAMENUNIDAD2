<?php
$host = 'localhost';
$db = 'escuela'; // Asegúrate de que esta base de datos exista
$user = 'root'; // Cambia esto si tu usuario es diferente
$pass = ''; // Cambia esto si tienes una contraseña

try {
    // Establece la conexión
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Muestra el error si no se puede conectar
    echo "Error de conexión: " . $e->getMessage();
    exit(); // Asegúrate de salir si hay un error
}
?>

