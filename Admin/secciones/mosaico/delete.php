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
$id = $_GET['id_mosaico'] ?? null;

if (!$id) {
    die("ID no proporcionado.");
}

// Consultar el registro para obtener las imágenes asociadas
$stmt = $pdo->prepare("SELECT * FROM tbl_mosaico WHERE id_mosaico = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Registro no encontrado.");
}

// Decodificar las imágenes del registro
$imagenes_guardadas = json_decode($item['imagen'], true) ?? [];

// Directorio donde se guardan las imágenes
$uploadDir = __DIR__ . '/img_mosaico/';

// Eliminar las imágenes del servidor
foreach ($imagenes_guardadas as $imagen) {
    $filePath = $uploadDir . $imagen;
    if (file_exists($filePath)) {
        unlink($filePath); // Eliminar la imagen
    }
}

// Eliminar el registro de la base de datos
$stmt = $pdo->prepare("DELETE FROM tbl_mosaico WHERE id_mosaico = ?");
$stmt->execute([$id]);

// Redirigir a config-mosaico.php con un mensaje de éxito
header("Location: /Admin/dashboard.php");
exit();
?>