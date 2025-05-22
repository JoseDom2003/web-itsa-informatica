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

// Directorios donde se guardarán las imágenes y videos
$imagenesDir = __DIR__ . '/imagenes/';
$videosDir = __DIR__ . '/videos/';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $imagenes = $_FILES['imagenes'] ?? null;
    $video = $_FILES['video'] ?? null;

    // Validar que se haya subido al menos una imagen
    if ($imagenes && !empty($imagenes['name'][0])) {
        $imagenes_guardadas = [];

        // Subir imágenes
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

        // Subir video si se proporciona
        $video_guardado = null;
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
                    $video_guardado = $newVideoName;
                }
            }
        }

        // Insertar los datos en la base de datos
        $imagenes_json = json_encode($imagenes_guardadas);
        $stmt = $pdo->prepare(
            "INSERT INTO tbl_eventos (titulo, imagen, descripcion, video) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$titulo, $imagenes_json, $descripcion, $video_guardado]);

        // Redirigir o mostrar un mensaje de éxito
        header("Location: /Admin/dashboard.php");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Por favor, sube al menos una imagen.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="padding-top: 15rem;">
        <div class="card p-4 shadow" style="width: 400px; border-radius: 10px;">
            <h2 class="text-center mb-4">Agregar Evento</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
                <!-- Título -->
                <div class="col-12">
                    <label for="titulo" class="form-label">Título del Evento</label>
                    <input type="text" class="form-control form-control-sm" id="titulo" name="titulo" placeholder="Ingrese el título del evento" required>
                </div>
                <!-- Descripción -->
                <div class="col-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Ingrese la descripción del evento" required></textarea>
                </div>
                <!-- Subir Imágenes -->
                <div class="col-12">
                    <label for="imagenes" class="form-label">Subir Imágenes</label>
                    <input type="file" class="form-control form-control-sm" id="imagenes" name="imagenes[]" accept="image/*" multiple required>
                </div>
                <!-- Subir Video -->
                <div class="col-12">
                    <label for="video" class="form-label">Subir Video</label>
                    <input type="file" class="form-control form-control-sm" id="video" name="video" accept="video/*">
                </div>
                <!-- Botón de Enviar -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                    <a href="../../dashboard.php" class="btn btn-danger btn-sm">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>