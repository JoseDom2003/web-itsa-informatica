<?php
// Incluir conexión a la base de datos
require_once __DIR__ . '/../../database/conexion.php';

// Iniciar sesión
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $usuario = trim($_POST['usuario'] ?? '');
    $contraseña = trim($_POST['contraseña'] ?? '');

    // Validar que los campos no estén vacíos
    if (!empty($usuario) && !empty($contraseña)) {
        // Preparar la consulta para evitar inyecciones SQL
        $stmt = $pdo->prepare("SELECT * FROM tbl_usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verificar la contraseña
            if (password_verify($contraseña, $user['contraseña'])) {
                // Credenciales correctas, guardar datos en la sesión
                $_SESSION['id_usuario'] = $user['id_usuarios'];
                $_SESSION['usuario'] = $user['usuario'];

                // Redirigir al dashboard
                header("Location: ../dashboard.php");
                exit();
            } else {
                // Contraseña incorrecta
                $_SESSION['error'] = "La contraseña es incorrecta.";
            }
        } else {
            // Usuario no encontrado
            $_SESSION['error'] = "El usuario no existe.";
        }
    } else {
        // Campos vacíos
        $_SESSION['error'] = "Por favor, complete todos los campos.";
    }
}

// Redirigir a login.php si hay un error
header("Location: ../login.php");
exit();
?>