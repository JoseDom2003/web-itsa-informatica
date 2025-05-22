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


// Consultar los datos de la tabla tbl_descargables
$stmt = $pdo->query("SELECT * FROM tbl_redes");
$redes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Configuración de Redes sociales</h2>
    <a href="./secciones/redes_sociales/upload.php" class="btn btn-success mb-3">AGREGAR</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>LOGO</th>
                <th>TITULO</th>
                <th>DESCRIPCION</th>
                <th>URL</th>
                <th>Acciones</th>
            </tr>
        </thead>
    <tbody>
    <?php foreach ($redes as $datos): ?>
        <tr>
            <td><img src="./secciones/redes_sociales/logos/<?php echo htmlspecialchars($datos['imagen']); ?>" alt="Imagen" style="width: 100px; height: auto;"</td>
            <td><?php echo htmlspecialchars($datos['titulo']); ?></td>
            <td><?php echo htmlspecialchars($datos['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($datos['url']); ?></td>
            <td>
                <a href="./secciones/redes_sociales/edit.php?id_redes=<?php echo $datos['id_redes']; ?>" class="btn btn-warning mb-2">Editar</a> |
                <a href="./secciones/redes_sociales/edit.php?id_redes=<?php echo $datos['id_redes']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este elemento?');" >Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>