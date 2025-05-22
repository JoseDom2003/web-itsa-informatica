<?php
// Incluir conexión a la base de datos
require_once __DIR__ . '/database/conexion.php';

// Consultar los datos de la tabla tbl_mosaico
$stmt = $pdo->query("SELECT * FROM tbl_mosaico");
$mosaicoItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agents Pioneer</title>
    <link rel="stylesheet" href="./styles/inicio.css">
     <!-- icono -->
     <link rel="icon" type="image/x-icon" href="./imagenes/Logo-icon.ico">

     <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            transition: opacity 0.5s ease, transform 0.5s ease;
            opacity: 1;
            transform: scale(1) rotate(0deg);
            background-color: transparent;
        }

        .fade-out {
            opacity: 0;
            transform: scale(0.8) rotate(-360deg); /* Efecto bellako 🔥 */
            background: linear-gradient(90deg, #0062E6, #33AEFF);
            backdrop-filter: blur(15px); /* Desenfoque elegante */
        }

        .btn-inicio {
            display: inline-block;
            padding: 12px 24px;
            font-size: 18px;
            color: #fff;
            background-color: #ff004c; /* Rojo intenso para más actitud 😎 */
            text-decoration: none;
            border-radius: 12px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-inicio:hover {
            background-color: #e60045;
            transform: scale(1.05);
        }
    </style>

</head>
<body>
<div class="fullscreen-collage">
    <div class="collage-grid">
    <?php for ($i = 0; $i < 4; $i++): ?>
        <?php foreach ($mosaicoItems as $item): ?>
            <?php $imagenes = json_decode($item['imagen'], true); ?>
                    <div class="collage-item">
                        <img src="/Admin/secciones/mosaico/img_mosaico/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen Mosaico">
                    </div>
        <?php endforeach; ?>
        <?php endfor; ?>
    </div>
</div>

      <!-- Apartado central -->
      <div class="welcome-overlay">
        <div id="welcome-content" class="welcome-content">
            <!-- Imagen arriba de "Bienvenidos" -->
            <img id="bouncing-image" src="./imagenes/logo.png" alt="Logo" class="welcome-image">
            <h1>Bienvenidos</h1>
            <p class="slogan">La Tecnología e innovación al alcance del usuario final...</p>
            <a href="#" class="btn-inicio" onclick="navigateTo('inicio.php')">Inicio</a>
        </div>
    </div>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Bienvenidos</h1>
        <p class="slogan text-center">La Tecnología e innovación al alcance del usuario final...</p>
        <div class="text-center mb-4">
            <a href="#" class="btn btn-primary" onclick="navigateTo('inicio.php')">Inicio</a>
        </div>


<script>
    // Crear un array de imágenes desde los registros de la base de datos
    const images = [];
    <?php foreach ($mosaicoItems as $item): ?>
        <?php
        // Decodificar el JSON de imágenes
        $imagenes = json_decode($item['imagen'], true);
        if (!empty($imagenes)):
            foreach ($imagenes as $imagen): ?>
                images.push("Admin/secciones/mosaico/img_mosaico/<?php echo htmlspecialchars($imagen); ?>");
            <?php endforeach;
        endif; ?>
    <?php endforeach; ?>
</script>

    <script>
        function navigateTo(url) {
            // Añade la clase de desvanecimiento
            document.body.classList.add('fade-out');
            
            // Redirige después de que termine la animación
            setTimeout(() => {
                window.location.href = url;
            }, 500); // El tiempo debe coincidir con el valor de `transition` en CSS
        }
    </script>
    <script src="inicio.js"></script>
</body>
</html>