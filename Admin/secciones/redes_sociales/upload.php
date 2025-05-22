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
$uploadDir = __DIR__ . '/logos/';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $url = $_POST['url'] ?? '';
    $imagen = $_FILES['imagen'] ?? null;

    // Validar que se haya subido una imagen
    if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
        $tmpName = $imagen['tmp_name'];
        $origName = basename($imagen['name']);
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $newName = uniqid('img_') . '.' . $ext;

        // Validar tipo MIME
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) { // Validar extensiones permitidas
            // Validar tipo MIME
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $tmpName);
            finfo_close($finfo);

            if (str_starts_with($mime, 'image/')) {
                // Mover el archivo al directorio de imágenes
                if (move_uploaded_file($tmpName, $uploadDir . $newName)) {
                    // Insertar los datos en la base de datos
                    $stmt = $pdo->prepare(
                        "INSERT INTO tbl_redes (imagen, titulo, descripcion, url) VALUES (?, ?, ?, ?)"
                    );
                    $stmt->execute([$newName, $titulo, $descripcion, $url]);

                    // Redirigir o mostrar un mensaje de éxito
                    header("Location: /Admin/dashboard.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger text-center'>Error al mover la imagen.</div>";
                }
            } else {
                echo "<div class='alert alert-danger text-center'>El archivo subido no es una imagen válida.</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Por favor, sube una imagen.</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Red Social</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="padding-top: 15rem;">
        <div class="card p-4 shadow" style="width: 400px; border-radius: 10px;">
            <h2 class="text-center mb-4">Agregar Red Social</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
                <!-- Subir Imagen -->
                <div class="col-12">
                    <label for="imagen" class="form-label">Subir logo</label>
                    <input type="file" class="form-control form-control-sm" id="imagen" name="imagen" accept="image/*" required>
                </div>
                <!-- Título -->
                <div class="col-12">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control form-control-sm" id="titulo" name="titulo" placeholder="Ingrese el título" required>
                </div>
                <!-- Descripción -->
                <div class="col-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Ingrese una descripción" rows="3" required></textarea>
                </div>
                <!-- URL -->
                <div class="col-12">
                    <label for="url" class="form-label">URL</label>
                    <input type="url" class="form-control form-control-sm" id="url" name="url" placeholder="Ingrese la URL" required>
                </div>
                <!-- Botón de Enviar -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                    <a href="../../dashboard.php" class="btn btn-danger btn-sm">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>