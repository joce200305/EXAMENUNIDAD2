<?php
include('../config/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $anio_ingreso = $_POST['anio_ingreso'];
    $carrera = $_POST['carrera'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    $sql = "INSERT INTO t_alumno (nombre, apellido, anio_ingreso, carrera, fecha_nacimiento) 
            VALUES (:nombre, :apellido, :anio_ingreso, :carrera, :fecha_nacimiento)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['nombre' => $nombre, 'apellido' => $apellido, 'anio_ingreso' => $anio_ingreso, 'carrera' => $carrera, 'fecha_nacimiento' => $fecha_nacimiento]);

    echo "Alumno registrado correctamente";
}
