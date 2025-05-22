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
$id = $_GET['id_evento'] ?? null;

if (!$id) {
    die("ID no proporcionado.");
}

// Consultar el registro para obtener los nombres de las imágenes y el video
$stmt = $pdo->prepare("SELECT imagen, video FROM tbl_eventos WHERE id_evento = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Registro no encontrado.");
}

// Directorios donde se guardan las imágenes y videos
$imagenesDir = __DIR__ . '/imagenes/';
$videosDir = __DIR__ . '/videos/';

// Eliminar las imágenes asociadas si existen
if (!empty($item['imagen'])) {
    $imagenes = json_decode($item['imagen'], true);
    if (is_array($imagenes)) { // Asegurarse de que sea un array válido
        foreach ($imagenes as $imagen) {
            if (file_exists($imagenesDir . $imagen)) {
                unlink($imagenesDir . $imagen); // Eliminar del servidor
            }
        }
    }
}

// Eliminar el video asociado si existe
if (!empty($item['video']) && file_exists($videosDir . $item['video'])) {
    unlink($videosDir . $item['video']);
}

// Eliminar el registro de la base de datos
$stmt = $pdo->prepare("DELETE FROM tbl_eventos WHERE id_evento = ?");
$stmt->execute([$id]);

// Redirigir a config-eventos.php después de eliminar
header("Location: /Admin/dashboard.php");
exit();