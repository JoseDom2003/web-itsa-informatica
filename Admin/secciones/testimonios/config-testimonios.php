<?php
// filepath: /c:/xampp/htdocs/web-itsa-informatica/Admin/secciones/testimonios/config-testimonios.php

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


// Consultar los datos de la tabla tbl_testimonios
$stmt = $pdo->query("SELECT * FROM tbl_testimonios ORDER BY id_testimonio DESC");
$testimonios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Testimonios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Configuración de Testimonios</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>CORREO ELECTRÓNICO</th>
                <th>MENSAJE</th>
                <th>CALIFICACIÓN</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($testimonios as $testimonio): ?>
            <tr>
                <td><?php echo htmlspecialchars($testimonio['nombre']); ?></td>
                <td><?php echo htmlspecialchars($testimonio['correo']); ?></td>
                <td><?php echo htmlspecialchars($testimonio['mensaje']); ?></td>
                <td><?php echo htmlspecialchars($testimonio['calificacion']); ?></td>
                <td>
                    <a href="./secciones/testimonios/delete.php?id_testimonio=<?php echo $testimonio['id_testimonio']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este elemento?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>