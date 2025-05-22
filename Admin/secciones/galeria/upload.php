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

// Directorios donde se guardarán las imágenes
$portadaDir = __DIR__ . '/logo_galeria/';
$contenidoDir = __DIR__ . '/img_galeria/';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $titulo_evento = $_POST['titulo_evento'] ?? '';
    $contenido = $_POST['contenido'] ?? '';
    $img_portada = $_FILES['img_portada'] ?? null;
    $img_contenido = $_FILES['img_contenido'] ?? null;

    // Validar que se haya subido una imagen de portada
    if ($img_portada && $img_portada['error'] === UPLOAD_ERR_OK) {
        $tmpName = $img_portada['tmp_name'];
        $origName = basename($img_portada['name']);
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $newPortadaName = uniqid('portada_') . '.' . $ext;

        // Validar tipo MIME
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $tmpName);
        finfo_close($finfo);

        if (str_starts_with($mime, 'image/')) {
            // Mover el archivo al directorio de portada
            if (move_uploaded_file($tmpName, $portadaDir . $newPortadaName)) {
                // Subir imágenes de contenido
                $imagenes_guardadas = [];

                if ($img_contenido && !empty($img_contenido['name'][0])) {
                    foreach ($img_contenido['tmp_name'] as $key => $tmpName) {
                        $origName = basename($img_contenido['name'][$key]);
                        $ext = pathinfo($origName, PATHINFO_EXTENSION);
                        $newContenidoName = uniqid('contenido_') . '.' . $ext;

                        if (move_uploaded_file($tmpName, $contenidoDir . $newContenidoName)) {
                            $imagenes_guardadas[] = $newContenidoName;
                        }
                    }
                }

                // Insertar los datos en la base de datos
                $imagenes_json = json_encode($imagenes_guardadas);
                $stmt = $pdo->prepare(
                    "INSERT INTO tbl_galeria (img_portada, titulo_evento, contenido, img_contenido) VALUES (?, ?, ?, ?)"
                );
                $stmt->execute([$newPortadaName, $titulo_evento, $contenido, $imagenes_json]);

                // Redirigir o mostrar un mensaje de éxito
                header("Location: /Admin/dashboard.php");
                exit();
            } else {
                echo "<div class='alert alert-danger text-center'>Error al mover la imagen de portada.</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>El archivo subido no es una imagen válida.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Por favor, sube una imagen de portada.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Evento a la Galería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="padding-top: 15rem;">
        <div class="card p-4 shadow" style="width: 400px; border-radius: 10px;">
            <h2 class="text-center mb-4">Agregar Evento a la Galería</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
                <!-- Subir Imagen de Portada -->
                <div class="col-12">
                    <label for="img_portada" class="form-label">Subir Imagen de Portada</label>
                    <input type="file" class="form-control form-control-sm" id="img_portada" name="img_portada" accept="image/*" required>
                </div>
                <!-- Título -->
                <div class="col-12">
                    <label for="titulo_evento" class="form-label">Título del Evento</label>
                    <input type="text" class="form-control form-control-sm" id="titulo_evento" name="titulo_evento" placeholder="Ingrese el título del evento" required>
                </div>
                <!-- Contenido -->
                <div class="col-12">
                    <label for="contenido" class="form-label">Contenido</label>
                    <textarea class="form-control form-control-sm" id="contenido" name="contenido" placeholder="Ingrese el contenido del evento" required></textarea>
                </div>
                <!-- Subir Imágenes de Contenido -->
                <div class="col-12">
                    <label for="img_contenido" class="form-label">Subir Imágenes de Contenido</label>
                    <input type="file" class="form-control form-control-sm" id="img_contenido" name="img_contenido[]" accept="image/*" multiple>
                </div>
                <!-- Botón de Enviar -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                    <a href="/Admin/dashboard.php" class="btn btn-danger btn-sm">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>