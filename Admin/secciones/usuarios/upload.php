<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no hay sesión activa
    header("Location: ../../login.php");
    exit();
}
// Incluir conexión a la base de datos
require_once __DIR__ . '/../../../database/conexion.php';

// Inicializar variables
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $usuario = trim($_POST['usuario'] ?? '');
    $contraseña = trim($_POST['contraseña'] ?? '');

    // Validar que los campos no estén vacíos
    if (empty($usuario) || empty($contraseña)) {
        $error = 'Por favor, completa todos los campos.';
    } else {
        try {
            // Verificar si el usuario ya existe
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_usuarios WHERE usuario = ?");
            $stmt->execute([$usuario]);
            $existe = $stmt->fetchColumn();

            if ($existe) {
                $error = 'El usuario ya existe. Por favor, elige otro nombre de usuario.';
            } else {
                // Encriptar la contraseña
                $hashContraseña = password_hash($contraseña, PASSWORD_DEFAULT);

                // Insertar el nuevo usuario en la base de datos
                $stmt = $pdo->prepare("INSERT INTO tbl_usuarios (usuario, contraseña) VALUES (?, ?)");
                $stmt->execute([$usuario, $hashContraseña]);
                $success = 'Usuario agregado exitosamente.';
                // Redirigir a la página de configuración de usuarios
                header('Location: config-usuarios.php');
                exit();
            }
        } catch (PDOException $e) {
            $error = 'Error al agregar el usuario: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../styles/admin.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="../../dashboard.php" style="white-space: nowrap;">
                <img src="../../../imagenes/Logo.png" alt="AGENTS PIONERS Logo" width="40" height="40" class="me-2">
                AGENTS PIONEERS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../../dashboard.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="config-usuarios.php">Usuarios</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <h1 class="text-center mb-4">Agregar Usuario</h1>
        <div class="card p-4 shadow" style="width: 400px; margin: 0 auto; border-radius: 10px;">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success text-center"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                </div>
                <div class="mb-3">
                    <label for="contraseña" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                    <a href="config-usuarios.php" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>