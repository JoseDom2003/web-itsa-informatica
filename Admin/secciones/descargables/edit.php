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
$id = $_GET['id_descargables'] ?? null;

if (!$id) {
    die("ID no proporcionado.");
}

// Consultar los datos actuales del registro
$stmt = $pdo->prepare("SELECT * FROM tbl_descargables WHERE id_descargables = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Registro no encontrado.");
}

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

    // Validar si se subió un nuevo archivo
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
            // Mover el archivo al directorio de pdfs
            if (move_uploaded_file($tmpName, $uploadDir . $newName)) {
                // Eliminar el archivo anterior si existe
                if (!empty($item['archivo']) && file_exists($uploadDir . $item['archivo'])) {
                    unlink($uploadDir . $item['archivo']);
                }

                // Actualizar el registro con el nuevo archivo
                $stmt = $pdo->prepare(
                    "UPDATE tbl_descargables SET titulo = ?, descripcion = ?, archivo = ? WHERE id_descargables = ?"
                );
                $stmt->execute([$titulo, $descripcion, $newName, $id]);

                // Redirigir a config-descargables.php
                header("Location: /Admin/dashboard.php");
                exit();
            } else {
                echo "<div class='alert alert-danger text-center'>Error al mover el archivo.</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>El archivo subido no es un PDF válido.</div>";
        }
    } else {
        // Si no se subió un nuevo archivo, actualizar solo título y descripción
        $stmt = $pdo->prepare(
            "UPDATE tbl_descargables SET titulo = ?, descripcion = ? WHERE id_descargables = ?"
        );
        $stmt->execute([$titulo, $descripcion, $id]);

        // Redirigir a config-descargables.php
        header("Location: /Admin/dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Descargable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="padding-top: 15rem;">
        <div class="card p-4 shadow" style="width: 400px; border-radius: 10px;">
            <h2 class="text-center mb-4">Editar Descargable</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
                <!-- Título -->
                <div class="col-12">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control form-control-sm" id="titulo" name="titulo" value="<?php echo htmlspecialchars($item['titulo']); ?>" required>
                </div>
                <!-- Descripción -->
                <div class="col-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($item['descripcion']); ?></textarea>
                </div>
                <!-- Subir Archivo -->
                <div class="col-12">
                    <label for="archivo" class="form-label">Subir Nuevo Archivo (Opcional)</label>
                    <input type="file" class="form-control form-control-sm" id="archivo" name="archivo" accept="application/pdf">
                </div>
                <!-- Botón de Enviar -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Guardar Cambios</button>
                    <a href="../../dashboard.php" class="btn btn-danger btn-sm">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>