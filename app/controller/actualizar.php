<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config/conexion.php'; // Incluye el archivo de conexión a la base de datos

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['nombre']) && isset($data['apellido']) && isset($data['anio_ingreso']) && isset($data['carrera']) && isset($data['fecha_nacimiento'])) {
    $id = $data['id'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $anio_ingreso = $data['anio_ingreso'];
    $carrera = $data['carrera'];
    $fecha_nacimiento = $data['fecha_nacimiento'];

    $query = "UPDATE t_producto SET nombre = ?, apellido = ?, anio_ingreso = ?, carrera = ?, fecha_nacimiento = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $nombre, $apellido, $anio_ingreso, $carrera, $fecha_nacimiento, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Alumno actualizado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el alumno.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}

$conn->close();
?>
