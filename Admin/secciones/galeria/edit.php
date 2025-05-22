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
$id = $_GET['id_evento_galeria'] ?? null;

if (!$id) {
    die("ID no proporcionado.");
}

// Consultar los datos actuales del registro
$stmt = $pdo->prepare("SELECT * FROM tbl_galeria WHERE id_evento_galeria = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Registro no encontrado.");
}

// Directorios donde se guardan las imágenes
$portadaDir = __DIR__ . '/logo_galeria/';
$contenidoDir = __DIR__ . '/img_galeria/';


// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $titulo_evento = $_POST['titulo_evento'] ?? '';
    $contenido = $_POST['contenido'] ?? '';
    $img_portada = $_FILES['img_portada'] ?? null;
    $img_contenido = $_FILES['img_contenido'] ?? null;

    // Verificar si se han subido demasiados archivos
    if ($img_contenido && count($img_contenido['name']) > 50) { // Cambia 50 por el límite deseado
        die("Has intentado subir demasiados archivos. El límite es 50.");
    }

    // Verificar el tamaño de cada archivo
    if ($img_contenido) {
        foreach ($img_contenido['size'] as $size) {
            if ($size > 10 * 1024 * 1024) { // 10 MB por archivo
                die("Uno de los archivos excede el tamaño máximo permitido de 10 MB.");
            }
        }
    }


    // Manejar la imagen de portada
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
                // Eliminar la imagen de portada anterior si existe
                if (!empty($item['img_portada']) && file_exists($portadaDir . $item['img_portada'])) {
                    unlink($portadaDir . $item['img_portada']);
                }
                $item['img_portada'] = $newPortadaName;
            } else {
                echo "<div class='alert alert-danger text-center'>Error al mover la nueva imagen de portada.</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>El archivo subido no es una imagen válida.</div>";
        }
    }

    $imagenes_guardadas = json_decode($item['img_contenido'], true) ?: [];

    // Agregar nuevas imágenes al array existente
    if ($img_contenido && !empty($img_contenido['name'][0])) {
        foreach ($img_contenido['tmp_name'] as $key => $tmpName) {
            $origName = basename($img_contenido['name'][$key]);
            $ext = pathinfo($origName, PATHINFO_EXTENSION);
            $newContenidoName = uniqid('contenido_') . '.' . $ext;
    
            if (move_uploaded_file($tmpName, $contenidoDir . $newContenidoName)) {
                $imagenes_guardadas[] = $newContenidoName; // Agregar la nueva imagen al array
            }
        }
    }

    // Eliminar imágenes seleccionadas
    if (!empty($_POST['eliminar_imagenes'])) {
        foreach ($_POST['eliminar_imagenes'] as $imagen) {
            if (($key = array_search($imagen, $imagenes_guardadas)) !== false) {
                unlink($contenidoDir . $imagen); // Eliminar del servidor
                unset($imagenes_guardadas[$key]); // Eliminar del array
            }
        }
    }

    // Actualizar los datos en la base de datos
    $imagenes_json = json_encode(array_values($imagenes_guardadas));
    $stmt = $pdo->prepare(
        "UPDATE tbl_galeria SET img_portada = ?, titulo_evento = ?, contenido = ?, img_contenido = ? WHERE id_evento_galeria = ?"
    );
    $stmt->execute([$item['img_portada'], $titulo_evento, $contenido, $imagenes_json, $id]);

    // Redirigir a config-galeria.php
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
    <div class="container d-flex justify-content-center align-items-center" style="padding-top: 11rem;">
        <div class="card p-4 shadow" style="width: 400px; border-radius: 10px;">
            <h2 class="text-center mb-4">Editar Evento</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
                <!-- Imagen de Portada -->
                <div class="col-12">
                    <label for="img_portada" class="form-label">Subir Nueva Imagen de Portada (Opcional)</label>
                    <input type="file" class="form-control form-control-sm" id="img_portada" name="img_portada" accept="image/*">
                </div>
                <!-- Título -->
                <div class="col-12">
                    <label for="titulo_evento" class="form-label">Título del Evento</label>
                    <input type="text" class="form-control form-control-sm" id="titulo_evento" name="titulo_evento" value="<?php echo htmlspecialchars($item['titulo_evento']); ?>" required>
                </div>
                <!-- Contenido -->
                <div class="col-12">
                    <label for="contenido" class="form-label">Contenido</label>
                    <textarea class="form-control form-control-sm" id="contenido" name="contenido" required><?php echo htmlspecialchars($item['contenido']); ?></textarea>
                </div>
                <!-- Imágenes de Contenido -->
                <div class="col-12">
                    <label for="img_contenido" class="form-label">Agregar Nuevas Imágenes de Contenido (Opcional)</label>
                    <input type="file" class="form-control form-control-sm" id="img_contenido" name="img_contenido[]" accept="image/*" multiple>
                    <small class="text-muted">Deja este campo vacío si no deseas agregar nuevas imágenes.</small>
                </div>
                <!-- Imágenes Existentes -->
                <div class="col-12">
                    <label class="form-label">Imágenes Existentes</label>
                    <div class="d-flex flex-wrap">
                        <?php 
                        $imagenes = json_decode($item['img_contenido'], true);
                        if (!empty($imagenes)): // Verificar si es un array válido
                            foreach ($imagenes as $imagen): ?>
                                <div class="me-2 mb-2">
                                    <img src="../../../Admin/secciones/galeria/img_galeria/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen" style="width: 50px; height: auto;">
                                    <div>
                                        <input type="checkbox" name="eliminar_imagenes[]" value="<?php echo htmlspecialchars($imagen); ?>"> Eliminar
                                    </div>
                                </div>
                            <?php endforeach; 
                        else: ?>
                            <p class="text-muted">No hay imágenes disponibles en la base de datos.</p>
                        <?php endif; ?>
                    </div>
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