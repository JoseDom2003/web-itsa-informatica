<?php
// filepath: /c:/xampp/htdocs/web-itsa-informatica/Admin/secciones/galeria/config-galeria.php

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


// Traer los datos de la tabla tbl_galeria
$stmt = $pdo->query("SELECT * FROM tbl_galeria");
$galeriaItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración Galería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Configuración de la Galería</h2>
        <a href="./secciones/galeria/upload.php" class="btn btn-success mb-3">AGREGAR</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>IMAGEN PORTADA</th>
                    <th>TÍTULO EVENTO</th>
                    <th>CONTENIDO</th>
                    <th>IMÁGENES DE CONTENIDO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($galeriaItems as $datos): ?>
                    <tr>
                        <!-- Imagen de portada -->
                        <td>
                            <img src="./secciones/galeria/logo_galeria/<?php echo htmlspecialchars($datos['img_portada']); ?>" alt="Portada" style="width: 100px; height: auto;">
                        </td>
                        <!-- Título del evento -->
                        <td><?php echo htmlspecialchars($datos['titulo_evento']); ?></td>
                        <!-- Contenido -->
                        <td><?php echo htmlspecialchars($datos['contenido']); ?></td>
                        <!-- Imágenes de contenido -->
                        <td>
                            <?php 
                            $imagenes = json_decode($datos['img_contenido'], true);
                            if (!empty($imagenes)):
                                foreach ($imagenes as $imagen): ?>
                                    <img src="./secciones/galeria/img_galeria/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen Contenido" style="width: 50px; height: auto; margin-right: 5px;">
                                <?php endforeach;
                            endif;
                            ?>
                        </td>
                        <!-- Acciones -->
                        <td>
                            <a href="./secciones/galeria/edit.php?id_evento_galeria=<?php echo $datos['id_evento_galeria']; ?>" class="btn btn-warning btn-sm">EDITAR</a> |
                            <a href="./secciones/galeria/delete.php?id_evento_galeria=<?php echo $datos['id_evento_galeria']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este elemento?');">ELIMINAR</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>