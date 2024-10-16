<?php
session_start();
include('./app/config/conexion.php'); // Asegúrate de que la ruta es correcta

// Verificar si ya hay una sesión activa
if (isset($_SESSION['usuario'])) {
    // Redirigir al dashboard del usuario basado en su rol
    if ($_SESSION['rol'] === 'administrador') {
        header('Location: admin.php'); // Redirige a dashboard del administrador
    } else if ($_SESSION['rol'] === 'alumno') {
        header('Location: alumno.php'); // Redirige a dashboard del alumno
    }
    exit; // Asegúrate de llamar a exit después de header
}

// Manejar la autenticación del usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta para obtener el usuario y su rol
    $sql = "SELECT * FROM t_usuario WHERE usuario = :usuario AND password = :password"; // Cambia a tu tabla de usuarios
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['usuario' => $usuario, 'password' => $password]);

    if ($stmt->rowCount() > 0) {
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['usuario'] = $usuarioData['usuario']; // Almacena el nombre de usuario en la sesión
        $_SESSION['id'] = $usuarioData['id']; // Guarda el ID del usuario en la sesión
        $_SESSION['rol'] = $usuarioData['rol']; // Guarda el rol del usuario

        // Redirigir según el rol del usuario
        if ($usuarioData['rol'] === 'administrador') {
            header('Location: admin.php'); // Redirige al dashboard de administrador
        } else if ($usuarioData['rol'] === 'alumno') {
            header('Location: alumno.php'); // Redirige al dashboard de alumno
        }
        exit;
    } else {
        $error = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Usuario:</label>
                <input type="text" class="form-control" name="usuario" required>
            </div>
            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
        <p class="mt-3"><a href="registro.php">Registrar nuevo usuario</a></p>
    </div>
</body>
</html>
