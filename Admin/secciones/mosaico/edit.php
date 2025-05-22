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
$id = $_GET['id_mosaico'] ?? null;

if (!$id) {
    die("ID no proporcionado.");
}

// Consultar los datos actuales del registro
$stmt = $pdo->prepare("SELECT * FROM tbl_mosaico WHERE id_mosaico = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Registro no encontrado.");
}

// Decodificar las imágenes actuales del registro
$imagenes_guardadas = json_decode($item['imagen'], true) ?? [];

// Directorio donde se guardan las imágenes
$uploadDir = __DIR__ . '/img_mosaico/';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Manejar la eliminación de imágenes seleccionadas
    if (!empty($_POST['eliminar_imagen'])) {
        foreach ($_POST['eliminar_imagen'] as $imagen) {
            if (($key = array_search($imagen, $imagenes_guardadas)) !== false) {
                unlink($uploadDir . $imagen); // Eliminar del servidor
                unset($imagenes_guardadas[$key]); // Eliminar del array
            }
        }
    }

    // Manejar la adición de nuevas imágenes
    $nuevas_imagenes = $_FILES['imagenes'] ?? null;
    if ($nuevas_imagenes && $nuevas_imagenes['error'][0] === UPLOAD_ERR_OK) {
        foreach ($nuevas_imagenes['tmp_name'] as $index => $tmpName) {
            $origName = basename($nuevas_imagenes['name'][$index]);
            $ext = pathinfo($origName, PATHINFO_EXTENSION);
            $newName = uniqid('mosaico_') . '.' . $ext;

            // Validar tipo MIME
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $tmpName);
            finfo_close($finfo);

            if (str_starts_with($mime, 'image/')) {
                // Mover el archivo al directorio de imágenes
                if (move_uploaded_file($tmpName, $uploadDir . $newName)) {
                    $imagenes_guardadas[] = $newName; // Agregar al array de imágenes guardadas
                } else {
                    echo "<div class='alert alert-danger text-center'>Error al mover la imagen: $origName.</div>";
                }
            } else {
                echo "<div class='alert alert-danger text-center'>El archivo $origName no es una imagen válida.</div>";
            }
        }
    }

    // Actualizar el registro en la base de datos
    $imagenes_json = json_encode(array_values($imagenes_guardadas)); // Reindexar el array
    $stmt = $pdo->prepare("UPDATE tbl_mosaico SET imagen = ? WHERE id_mosaico = ?");
    $stmt->execute([$imagenes_json, $id]);

    // Redirigir a config-mosaico.php
    header("Location: /Admin/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Imágenes del Mosaico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="padding-top: 9rem;">
        <div class="card p-4 shadow" style="width: 600px; border-radius: 10px;">
            <h2 class="text-center mb-4">Editar Imágenes del Mosaico</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
                <!-- Imágenes Actuales -->
                <div class="col-12">
                    <label class="form-label">Imágenes Actuales</label>
                    <div class="d-flex flex-wrap">
                        <?php foreach ($imagenes_guardadas as $imagen): ?>
                            <div class="me-2 mb-2 text-center">
                                <img src="./img_mosaico/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen Actual" style="width: 100px; height: auto; border-radius: 5px;">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="eliminar_<?php echo htmlspecialchars($imagen); ?>" name="eliminar_imagen[]" value="<?php echo htmlspecialchars($imagen); ?>">
                                    <label class="form-check-label" for="eliminar_<?php echo htmlspecialchars($imagen); ?>">Eliminar</label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Subir Nuevas Imágenes -->
                <div class="col-12">
                    <label for="imagenes" class="form-label">Agregar Nuevas Imágenes</label>
                    <input type="file" class="form-control form-control-sm" id="imagenes" name="imagenes[]" accept="image/*" multiple>
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