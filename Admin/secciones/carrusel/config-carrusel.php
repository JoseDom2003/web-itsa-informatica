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

// Traer los datos de la tabla tbl_carrusel
$stmt = $pdo->query("SELECT * FROM tbl_carrusel");
$carruselItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración Carrusel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Configuración del Carrusel</h2>
        <a href="./secciones/carrusel/upload.php" class="btn btn-success mb-3">AGREGAR</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>IMAGEN</th>
                    <th>TÍTULO</th>
                    <th>SUBTITULO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carruselItems as $datos): ?>
                    <tr>
                        <td><img src="./secciones/carrusel/imagenes/<?php echo htmlspecialchars($datos['imagen']); ?>" alt="Imagen" style="width: 100px; height: auto;"></td>
                        <td><?php echo htmlspecialchars($datos['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($datos['subtitulo']); ?></td>
                        <td>
                            <a href="./secciones/carrusel/edit.php?id_carrusel=<?php echo $datos['id_carrusel']; ?>" class="btn btn-warning btn-sm">EDITAR</a> |
                            <a href="./secciones/carrusel/delete.php?id_carrusel=<?php echo $datos['id_carrusel']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este elemento?');">ELIMINAR</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>