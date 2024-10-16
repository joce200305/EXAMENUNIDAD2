<?php
session_start();
include('../config/conexion.php'); // Asegúrate de que la ruta es correcta

// Obtener los datos JSON del cuerpo de la petición
$data = json_decode(file_get_contents("php://input"), true);

// Obtener cada campo del formulario
$nombre = isset($data['nombre']) ? $data['nombre'] : null;
$apellido = isset($data['apellido']) ? $data['apellido'] : null;
$anio_ingreso = isset($data['anio_ingreso']) ? $data['anio_ingreso'] : null;
$carrera = isset($data['carrera']) ? $data['carrera'] : null;
$fecha_nacimiento = isset($data['fecha_nacimiento']) ? $data['fecha_nacimiento'] : null;
$usuario = isset($data['usuario']) ? $data['usuario'] : null;
$password = isset($data['password']) ? $data['password'] : null;

// Verifica que todos los campos están presentes
if ($nombre && $apellido && $anio_ingreso && $carrera && $fecha_nacimiento && $usuario && $password) {
    try {
        // Insertar en la base de datos
        $sql = "INSERT INTO t_alumno (nombre, apellido, anio_ingreso, carrera, fecha_nacimiento, usuario, password)
                VALUES (:nombre, :apellido, :anio_ingreso, :carrera, :fecha_nacimiento, :usuario, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':anio_ingreso' => $anio_ingreso,
            ':carrera' => $carrera,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':usuario' => $usuario,
            ':password' => $password // Almacenar la contraseña sin encriptar
        ]);

        echo json_encode(['success' => true, 'message' => 'Alumno registrado exitosamente.']);
    } catch (PDOException $e) {
        // Devolver mensaje de error
        echo json_encode(['success' => false, 'message' => 'Error al registrar: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error: Todos los campos son obligatorios.']);
}
?>
