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

// Obtener el ID del registro a editar
$id = $_GET['id_evento'] ?? null;

if (!$id) {
    die("ID no proporcionado.");
}

// Consultar los datos actuales del registro
$stmt = $pdo->prepare("SELECT * FROM tbl_eventos WHERE id_evento = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Registro no encontrado.");
}

// Directorios donde se guardan las imágenes y videos
$imagenesDir = __DIR__ . '/imagenes/';
$videosDir = __DIR__ . '/videos/';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $imagenes = $_FILES['imagenes'] ?? null;
    $video = $_FILES['video'] ?? null;

    // Manejar las imágenes existentes
    $imagenes_guardadas = json_decode($item['imagen'], true) ?: [];

    // Agregar nuevas imágenes al array existente
    if ($imagenes && !empty($imagenes['name'][0])) {
        foreach ($imagenes['tmp_name'] as $key => $tmpName) {
            $origName = basename($imagenes['name'][$key]);
            $ext = pathinfo($origName, PATHINFO_EXTENSION);
            $newImageName = uniqid('evento_img_') . '.' . $ext;

            // Validar tipo MIME de la imagen
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $tmpName);
            finfo_close($finfo);

            if (str_starts_with($mime, 'image/')) {
                // Mover la imagen al directorio correspondiente
                if (move_uploaded_file($tmpName, $imagenesDir . $newImageName)) {
                    $imagenes_guardadas[] = $newImageName;
                }
            }
        }
    }

    // Eliminar imágenes seleccionadas
    if (!empty($_POST['eliminar_imagenes'])) {
        foreach ($_POST['eliminar_imagenes'] as $imagen) {
            if (($key = array_search($imagen, $imagenes_guardadas)) !== false) {
                unlink($imagenesDir . $imagen); // Eliminar del servidor
                unset($imagenes_guardadas[$key]); // Eliminar del array
            }
        }
    }

    // Manejar el video
    $video_guardado = $item['video']; // Mantener el video actual por defecto
    if ($video && $video['error'] === UPLOAD_ERR_OK) {
        $tmpName = $video['tmp_name'];
        $origName = basename($video['name']);
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $newVideoName = uniqid('evento_video_') . '.' . $ext;

        // Validar tipo MIME del video
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $tmpName);
        finfo_close($finfo);

        if (str_starts_with($mime, 'video/')) {
            // Mover el video al directorio correspondiente
            if (move_uploaded_file($tmpName, $videosDir . $newVideoName)) {
                // Eliminar el video anterior si existe
                if (!empty($item['video']) && file_exists($videosDir . $item['video'])) {
                    unlink($videosDir . $item['video']);
                }
                $video_guardado = $newVideoName;
            }
        }
    }

    // Actualizar los datos en la base de datos
    $imagenes_json = json_encode(array_values($imagenes_guardadas));
    $stmt = $pdo->prepare(
        "UPDATE tbl_eventos SET titulo = ?, imagen = ?, descripcion = ?, video = ? WHERE id_evento = ?"
    );
    $stmt->execute([$titulo, $imagenes_json, $descripcion, $video_guardado, $id]);

    // Redirigir a config-eventos.php
    header("Location: /Admin/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="padding-top: 9rem;">
        <div class="card p-4 shadow" style="width: 400px; border-radius: 10px;">
            <h2 class="text-center mb-4">Editar Evento</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
                <!-- Título -->
                <div class="col-12">
                    <label for="titulo" class="form-label">Título del Evento</label>
                    <input type="text" class="form-control form-control-sm" id="titulo" name="titulo" value="<?php echo htmlspecialchars($item['titulo']); ?>" required>
                </div>
                <!-- Descripción -->
                <div class="col-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" required><?php echo htmlspecialchars($item['descripcion']); ?></textarea>
                </div>
                <!-- Imágenes -->
                <div class="col-12">
                    <label for="imagenes" class="form-label">Agregar Nuevas Imágenes (Opcional)</label>
                    <input type="file" class="form-control form-control-sm" id="imagenes" name="imagenes[]" accept="image/*" multiple>
                    <small class="text-muted">Deja este campo vacío si no deseas agregar nuevas imágenes.</small>
                </div>
                <!-- Imágenes Existentes -->
                <div class="col-12">
                    <label class="form-label">Imágenes Existentes</label>
                    <div class="d-flex flex-wrap">
                        <?php 
                        $imagenes = json_decode($item['imagen'], true);
                        if (!empty($imagenes)): 
                            foreach ($imagenes as $imagen): ?>
                                <div class="me-2 mb-2">
                                    <img src="../../../Admin/secciones/eventos/imagenes/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen" style="width: 50px; height: auto;">
                                    <div>
                                        <input type="checkbox" name="eliminar_imagenes[]" value="<?php echo htmlspecialchars($imagen); ?>"> Eliminar
                                    </div>
                                </div>
                            <?php endforeach; 
                        else: ?>
                            <p class="text-muted">No hay imágenes disponibles.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Video -->
                <div class="col-12">
                    <label for="video" class="form-label">Subir Nuevo Video (Opcional)</label>
                    <input type="file" class="form-control form-control-sm" id="video" name="video" accept="video/*">
                    <small class="text-muted">Deja este campo vacío si no deseas cambiar el video actual.</small>
                </div>
                <!-- Botones -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Guardar Cambios</button>
                    <a href="../../dashboard.php" class="btn btn-danger btn-sm">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>