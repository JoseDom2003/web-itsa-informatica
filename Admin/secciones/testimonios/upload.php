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

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';
    $calificacion = $_POST['calificacion'] ?? null;

    // Validar que los campos requeridos no estén vacíos
    if (!empty($nombre) && !empty($correo) && !empty($mensaje)) {
        try {
            // Insertar los datos en la base de datos
            $stmt = $pdo->prepare(
                "INSERT INTO tbl_testimonios (nombre, correo, mensaje, calificacion) VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$nombre, $correo, $mensaje, $calificacion]);

            // Redirigir o mostrar un mensaje de éxito
            header("Location: ../../../../../inicio.php");
            exit();
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger text-center'>Error al guardar los datos: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Por favor, completa todos los campos requeridos.</div>";
    }
}
?>