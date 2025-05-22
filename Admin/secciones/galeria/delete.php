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
$id = $_GET['id_evento_galeria'] ?? null;

if (!$id) {
    die("ID no proporcionado.");
}

// Consultar el registro para obtener los nombres de las imágenes
$stmt = $pdo->prepare("SELECT img_portada, img_contenido FROM tbl_galeria WHERE id_evento_galeria = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Registro no encontrado.");
}

// Directorios donde se guardan las imágenes
$portadaDir = __DIR__ . '/logo_galeria/';
$contenidoDir = __DIR__ . '/img_galeria/';

// Eliminar la imagen de portada asociada si existe
if (!empty($item['img_portada']) && file_exists($portadaDir . $item['img_portada'])) {
    unlink($portadaDir . $item['img_portada']);
}

// Eliminar las imágenes de contenido asociadas si existen
if (!empty($item['img_contenido'])) {
    $imagenes_contenido = json_decode($item['img_contenido'], true);
    if (is_array($imagenes_contenido)) { // Asegurarse de que sea un array válido
        foreach ($imagenes_contenido as $imagen) {
            if (file_exists($contenidoDir . $imagen)) {
                unlink($contenidoDir . $imagen); // Eliminar del servidor
            }
        }
    }
}

// Eliminar el registro de la base de datos
$stmt = $pdo->prepare("DELETE FROM tbl_galeria WHERE id_evento_galeria = ?");
$stmt->execute([$id]);

// Redirigir a config-galeria.php después de eliminar
header("Location: /Admin/dashboard.php");
exit();