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

// Directorio donde se guardarán los archivos PDF
$uploadDir = __DIR__ . '/pdfs/';

// Crear el directorio si no existe
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $archivo = $_FILES['archivo'] ?? null;

    // Validar que se haya subido un archivo
    if ($archivo && $archivo['error'] === UPLOAD_ERR_OK) {
        $tmpName = $archivo['tmp_name'];
        $origName = basename($archivo['name']);
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $newName = uniqid('file_') . '.' . $ext;

        // Validar tipo MIME
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $tmpName);
        finfo_close($finfo);

        if ($mime === 'application/pdf') {
            // Mover el archivo al directorio de archivos
            if (move_uploaded_file($tmpName, $uploadDir . $newName)) {
                // Insertar los datos en la base de datos
                $stmt = $pdo->prepare(
                    "INSERT INTO tbl_descargables (titulo, descripcion, archivo) VALUES (?, ?, ?)"
                );
                $stmt->execute([$titulo, $descripcion, $newName]);

                // Redirigir o mostrar un mensaje de éxito
                header("Location: /Admin/dashboard.php");
                exit();
            } else {
                echo "<div class='alert alert-danger text-center'>Error al mover el archivo.</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>El archivo subido no es un PDF válido.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Por favor, sube un archivo PDF.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Descargable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="padding-top: 15rem;">
        <div class="card p-4 shadow" style="width: 400px; border-radius: 10px;">
            <h2 class="text-center mb-4">Agregar seccion descargables</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
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
                <!-- Subir Archivo -->
                <div class="col-12">
                    <label for="archivo" class="form-label">Subir Archivo (PDF)</label>
                    <input type="file" class="form-control form-control-sm" id="archivo" name="archivo" accept="application/pdf" required>
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