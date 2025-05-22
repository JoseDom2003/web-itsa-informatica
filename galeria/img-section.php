<?php
// filepath: /c:/xampp/htdocs/web-itsa-informatica/galeria/img-section.php

// Incluir conexión a la base de datos
require_once __DIR__ . '/../database/conexion.php';

// Obtener el ID del evento desde la URL
$id_evento_galeria = $_GET['id_evento_galeria'] ?? null;

if (!$id_evento_galeria) {
    die("ID del evento no proporcionado.");
}

// Consultar los datos del registro correspondiente
$stmt = $pdo->prepare("SELECT titulo_evento, contenido, img_contenido FROM tbl_galeria WHERE id_evento_galeria = ?");
$stmt->execute([$id_evento_galeria]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    die("Registro no encontrado.");
}

// Decodificar las imágenes de contenido
$imagenes = json_decode($evento['img_contenido'], true);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagenes de galeria</title>
    <link rel="icon" type="image/x-icon" href="../imagenes/Logo-icon.ico">
    <link rel="stylesheet" href="galeria.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="../inicio.php">
                <img src="../imagenes/Logo.png" alt="AGENTS PIONERS Logo" class="me-2">
                AGENTS PIONERS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#video">Video</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeria-descargas">Galeria</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeria-descargas">Descargas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#plan-estudios">Plan de estudios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#eventos">Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonios">Testimonios</a></li>
                </ul>
            </div>
            </div>
        </nav>
</header>

<div class="container-fluid container-section">
        <div class="heading pt-4 ">
            <!-- Mostrar el título del evento -->
        <h1 class="text-center text-white pt-4"><?php echo htmlspecialchars($evento['titulo_evento']); ?></h1>
        <!-- Mostrar el contenido del evento -->
        <h4 class="text-center text-light py-1"><?php echo htmlspecialchars($evento['contenido']); ?></h4>
        </div>
        <div class="row py-5 px-lg-5 px-sm-0">
            <div class="d-flex flex-wrap justify-content-center">
            <?php if (!empty($imagenes) && is_array($imagenes)): ?>
                    <?php foreach ($imagenes as $imagen): ?>
                        <div class="col-md-4 mb-4 p-2">
                            <img src="../Admin/secciones/galeria/img_galeria/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen del Evento" class="img-fluid" onclick="openModal(this)">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-muted">No hay imágenes disponibles para este evento.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Imagen">
            </div>
            <div class="modal-footer">
                <a id="downloadBtn" class="btn btn-success" download>Descargar</a>
            </div>
        </div>
    </div>
</div>


<script>
    // Función para abrir el modal al hacer clic en una imagen
    function openModal(img) {
        const modal = document.createElement('div');
        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100%';
        modal.style.height = '100%';
        modal.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        modal.style.display = 'flex';
        modal.style.flexDirection = 'column';
        modal.style.justifyContent = 'center';
        modal.style.alignItems = 'center';
        modal.style.zIndex = '1000';

        // Imagen en el modal
        const modalImg = document.createElement('img');
        modalImg.src = img.src;
        modalImg.style.maxWidth = '90%';
        modalImg.style.maxHeight = '70%';
        modalImg.style.borderRadius = '10px';
        modalImg.style.marginBottom = '20px';

        // Botón para cerrar el modal
        const closeButton = document.createElement('button');
        closeButton.textContent = 'Cerrar';
        closeButton.style.margin = '10px';
        closeButton.style.padding = '10px 20px';
        closeButton.style.backgroundColor = '#dc3545';
        closeButton.style.color = '#fff';
        closeButton.style.border = 'none';
        closeButton.style.borderRadius = '5px';
        closeButton.style.cursor = 'pointer';
        closeButton.addEventListener('click', () => {
            modal.remove();
        });

        // Botón para descargar la imagen
        const downloadButton = document.createElement('a');
        downloadButton.textContent = 'Descargar';
        downloadButton.style.margin = '10px';
        downloadButton.style.padding = '10px 20px';
        downloadButton.style.backgroundColor = '#28a745';
        downloadButton.style.color = '#fff';
        downloadButton.style.border = 'none';
        downloadButton.style.borderRadius = '5px';
        downloadButton.style.cursor = 'pointer';
        downloadButton.style.textDecoration = 'none';
        downloadButton.href = img.src; // Ruta de la imagen
        downloadButton.download = img.src.split('/').pop(); // Nombre del archivo para descargar

        // Agregar elementos al modal
        modal.appendChild(modalImg);
        modal.appendChild(closeButton);
        modal.appendChild(downloadButton);

        // Agregar el modal al documento
        document.body.appendChild(modal);
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="main.js"></script>
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="aaVNGM8GyOGNvrd1e0leq";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
</body>
</html>