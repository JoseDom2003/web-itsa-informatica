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

// Obtener el ID del usuario a eliminar
$id = $_GET['id_usuario'] ?? null;

if (!$id) {
    die("ID no proporcionado.");
}

// Verificar si el usuario existe en la base de datos
$stmt = $pdo->prepare("SELECT * FROM tbl_usuarios WHERE id_usuario = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuario no encontrado.");
}

// Eliminar el registro de la base de datos
$stmt = $pdo->prepare("DELETE FROM tbl_usuarios WHERE id_usuario = ?");
$stmt->execute([$id]);

// Redirigir a config-usuarios.php después de eliminar
header("Location: config-usuarios.php");
exit();