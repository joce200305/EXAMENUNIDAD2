<?php
session_start();
include('../config/conexion.php');

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

$sql = "DELETE FROM t_alumno WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

echo json_encode(['success' => true, 'message' => 'Alumno eliminado exitosamente']);
?>
