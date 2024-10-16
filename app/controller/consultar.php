<?php
session_start();
include('../config/conexion.php');

// Consulta para obtener todos los alumnos
$sql = "SELECT * FROM t_alumno";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver resultados como JSON
header('Content-Type: application/json');
echo json_encode($alumnos);
?>
