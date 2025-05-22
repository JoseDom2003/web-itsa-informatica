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

// Obtener el ID del registro a eliminar
$id = $_GET['id_carrusel'] ?? null;

if (!$id) {
    die("ID no proporcionado.");
}

// Consultar el registro para obtener el nombre de la imagen
$stmt = $pdo->prepare("SELECT imagen FROM tbl_carrusel WHERE id_carrusel = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Registro no encontrado.");
}

// Directorio donde se guardan las imágenes
$uploadDir = __DIR__ . '/imagenes/';

// Eliminar la imagen asociada si existe
if (!empty($item['imagen']) && file_exists($uploadDir . $item['imagen'])) {
    unlink($uploadDir . $item['imagen']);
}

// Eliminar el registro de la base de datos
$stmt = $pdo->prepare("DELETE FROM tbl_carrusel WHERE id_carrusel = ?");
$stmt->execute([$id]);

// Redirigir a config-carrusel.php después de eliminar
header("Location: /Admin/dashboard.php");
exit();