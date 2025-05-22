<?php
// Incluir conexión a la base de datos
require_once __DIR__ . '/../../../database/conexion.php';

// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no hay sesión activa
    header("Location: ../../login.php");
    exit();
}


// Traer los datos de la tabla tbl_mosaico
$stmt = $pdo->query("SELECT * FROM tbl_mosaico");
$mosaicoItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración Mosaico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Configuración del Mosaico</h2>
        <a href="./secciones/mosaico/upload.php" class="btn btn-success mb-3">AGREGAR</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>IMÁGENES</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mosaicoItems as $item): ?>
                    <tr>
                        <!-- Mostrar todas las imágenes del registro -->
                        <td>
                            <?php
                            // Decodificar el JSON de imágenes
                            $imagenes = json_decode($item['imagen'], true);
                            if (!empty($imagenes)):
                                foreach ($imagenes as $imagen): ?>
                                    <img src="./secciones/mosaico/img_mosaico/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen Mosaico" style="width: 100px; height: 80px; margin: 5px; border-radius: 2px;">
                                <?php endforeach;
                            else: ?>
                                <span class="text-muted">No hay imágenes</span>
                            <?php endif; ?>
                        </td>
                        <!-- Acciones -->
                        <td>
                            <a href="./secciones/mosaico/edit.php?id_mosaico=<?php echo $item['id_mosaico']; ?>" class="btn btn-warning btn-sm">EDITAR</a> |
                            <a href="./secciones/mosaico/delete.php?id_mosaico=<?php echo $item['id_mosaico']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?');">ELIMINAR</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>