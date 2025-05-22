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
$id = $_GET['id_descargables'] ?? null;

if (!$id) {
    die("ID no proporcionado.");
}

// Consultar el registro para obtener el nombre del archivo
$stmt = $pdo->prepare("SELECT archivo FROM tbl_descargables WHERE id_descargables = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Registro no encontrado.");
}

// Directorio donde se guardan los archivos PDF
$uploadDir = __DIR__ . '/pdfs/';

// Eliminar el archivo asociado si existe
if (!empty($item['archivo']) && file_exists($uploadDir . $item['archivo'])) {
    unlink($uploadDir . $item['archivo']);
}

// Eliminar el registro de la base de datos
$stmt = $pdo->prepare("DELETE FROM tbl_descargables WHERE id_descargables = ?");
$stmt->execute([$id]);

// Redirigir a config-descargables.php después de eliminar
header("Location: /Admin/dashboard.php");
exit();