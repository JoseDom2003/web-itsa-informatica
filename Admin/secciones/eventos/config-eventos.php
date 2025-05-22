<?php
// filepath: /c:/xampp/htdocs/web-itsa-informatica/Admin/secciones/eventos/config-eventos.php

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


// Traer los datos de la tabla tbl_eventos
$stmt = $pdo->query("SELECT * FROM tbl_eventos");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h2 class="text-center mb-4">Configuración del Carrusel</h2>
        <a href="./secciones/eventos/upload.php" class="btn btn-success mb-3">AGREGAR</a>
            <table class="table table-striped table-bordered p-4">
                <thead>
                    <tr>
                        <th>TITULO</th>
                        <th>IMAGENES</th>
                        <th>DESCRIPCION</th>
                        <th>VIDEO</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php foreach ($eventos as $evento): ?>
                        <tr>
                            <!-- Título -->
                            <td><?php echo htmlspecialchars($evento['titulo']); ?></td>
                            
                            <!-- Imágenes -->
                            <td>
                                <?php 
                                $imagenes = json_decode($evento['imagen'], true);
                                if (!empty($imagenes)):
                                    foreach ($imagenes as $imagen): ?>
                                        <img src="./secciones/eventos/imagenes/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen Evento" style="width: 50px; height: auto; margin-right: 5px;">
                                    <?php endforeach;
                                endif;
                                ?>
                            </td>
                            
                            <!-- Descripción -->
                            <td><?php echo htmlspecialchars($evento['descripcion']); ?></td>
                            
                            <!-- Video -->
                            <td>
                                <?php if (!empty($evento['video'])): ?>
                                    <a href="./secciones/eventos/videos/<?php echo htmlspecialchars($evento['video']); ?>" target="_blank">Ver Video</a>
                                <?php else: ?>
                                    No disponible
                                <?php endif; ?>
                            </td>
                            
                            <!-- Acciones -->
                            <td>
                                <a href="./secciones/eventos/edit.php?id_evento=<?php echo $evento['id_evento']; ?>" class="btn btn-warning btn-sm">EDITAR</a> |
                                <a href="./secciones/eventos/delete.php?id_evento=<?php echo $evento['id_evento']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este evento?');">ELIMINAR</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>