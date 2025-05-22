<?php
// Incluir conexión a la base de datos
require_once __DIR__ . '/../../../database/conexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no hay sesión activa
    header("Location: ../../login.php");
    exit();
}


// Consultar los datos de la tabla tbl_descargables
$stmt = $pdo->query("SELECT * FROM tbl_descargables");
$descargables = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración Descargables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Configuración de Descargables</h2>
    <a href="./secciones/descargables/upload.php" class="btn btn-success mb-3">AGREGAR</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Archivo (PDF)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($descargables as $datos): ?>
                <tr>
                    <td><?php echo htmlspecialchars($datos['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($datos['descripcion']); ?></td>
                    <td>
                    <iframe src="./secciones/descargables/pdfs/<?php echo htmlspecialchars($datos['archivo']); ?>" style="width: 200px; height: 200px;" frameborder="0"></iframe>                        </a>
                    </td>
                    <td>
                        <a href="./secciones/descargables/edit.php?id_descargables=<?php echo $datos['id_descargables']; ?>" class="btn btn-warning">EDITAR</a> |
                        <a href="./secciones/descargables/delete.php?id_descargables=<?php echo $datos['id_descargables']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este elemento?');">BORRAR</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>