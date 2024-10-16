<?php
session_start();
include('../config/conexion.php');

$data = json_decode(file_get_contents("php://input"), true);

$nombre = $data['nombre'];
$apellido = $data['apellido'];
$anio_ingreso = $data['anio_ingreso'];
$carrera = $data['carrera'];
$fecha_nacimiento = $data['fecha_nacimiento'];

$sql = "INSERT INTO t_alumno (nombre, apellido, anio_ingreso, carrera, fecha_nacimiento) 
        VALUES (:nombre, :apellido, :anio_ingreso, :carrera, :fecha_nacimiento)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'nombre' => $nombre,
    'apellido' => $apellido,
    'anio_ingreso' => $anio_ingreso,
    'carrera' => $carrera,
    'fecha_nacimiento' => $fecha_nacimiento
]);

echo json_encode(['success' => true, 'message' => 'Alumno registrado exitosamente']);
?>
