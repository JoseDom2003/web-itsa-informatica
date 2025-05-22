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

// Directorio donde se guardarán las imágenes
$uploadDir = __DIR__ . '/img_mosaico/';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener las imágenes del formulario
    $imagenes = $_FILES['imagenes'] ?? null;

    // Validar que se hayan subido imágenes
    if ($imagenes && $imagenes['error'][0] === UPLOAD_ERR_OK) {
        $imagenesGuardadas = [];

        // Procesar cada imagen
        foreach ($imagenes['tmp_name'] as $index => $tmpName) {
            $origName = basename($imagenes['name'][$index]);
            $ext = pathinfo($origName, PATHINFO_EXTENSION);
            $newName = uniqid('mosaico_') . '.' . $ext;

            // Validar tipo MIME
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $tmpName);
            finfo_close($finfo);

            if (str_starts_with($mime, 'image/')) {
                // Mover el archivo al directorio de imágenes
                if (move_uploaded_file($tmpName, $uploadDir . $newName)) {
                    $imagenesGuardadas[] = $newName; // Guardar el nombre de la imagen
                } else {
                    echo "<div class='alert alert-danger text-center'>Error al mover la imagen: $origName.</div>";
                }
            } else {
                echo "<div class='alert alert-danger text-center'>El archivo $origName no es una imagen válida.</div>";
            }
        }

        // Guardar los nombres de las imágenes en la base de datos como JSON
        if (!empty($imagenesGuardadas)) {
            $imagenesJson = json_encode($imagenesGuardadas);
            $stmt = $pdo->prepare("INSERT INTO tbl_mosaico (imagen) VALUES (?)");
            $stmt->execute([$imagenesJson]);

            // Redirigir o mostrar un mensaje de éxito
            header("Location: /Admin/dashboard.php");
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>No se pudieron guardar las imágenes.</div>";
        }
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
    <title>Agregar Imágenes al Mosaico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="padding-top: 15rem;">
        <div class="card p-4 shadow" style="width: 400px; border-radius: 10px;">
            <h2 class="text-center mb-4">Agregar Imágenes al Mosaico</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
                <!-- Subir Imágenes -->
                <div class="col-12">
                    <label for="imagenes" class="form-label">Subir Imágenes</label>
                    <input type="file" class="form-control form-control-sm" id="imagenes" name="imagenes[]" accept="image/*" multiple required>
                    <small class="text-muted">Puedes seleccionar varias imágenes.</small>
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