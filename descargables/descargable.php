<?php
// Incluir conexión a la base de datos
require_once __DIR__ . '/../database/conexion.php';

// Consultar los datos de la tabla tbl_descargables
$stmt = $pdo->query("SELECT * FROM tbl_descargables");
$descargables = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargables PDF</title>
    <link rel="stylesheet" href="descargable.css">
    <link rel="icon" type="image/x-icon" href="../imagenes/Logo-icon.ico">
      <!-- Bootstrap 5 CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <!-- Bloque superior: logo y botón -->
      <div class="d-flex justify-content-between w-100">
        <a class="navbar-brand d-flex align-items-center" href="../inicio.php" style="white-space: nowrap;">
          <img src="../imagenes/Logo.png" alt="AGENTS PIONERS Logo" class="me-2">
          AGENTS PIONEERS
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
                aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
  
      <!-- Bloque inferior: menú colapsable -->
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

    <main>
        <section class="pdf-container">
                <?php foreach ($descargables as $item): ?>
                    <article class="pdf-item">
                        <h2><?php echo htmlspecialchars($item['titulo']); ?></h2>
                        <p><?php echo htmlspecialchars($item['descripcion']); ?></p>
                        <div class="pdf-preview">
                            <iframe src="../Admin/secciones/descargables/pdfs/<?php echo htmlspecialchars($item['archivo']); ?>" width="100%" height="200px" frameborder="0"></iframe>
                        </div>
                        <button class="download-btn" data-bs-toggle="modal" data-bs-target="#pdfModal" data-pdf="../Admin/secciones/descargables/pdfs/<?php echo htmlspecialchars($item['archivo']); ?>">Ver PDF</button>
                        <a href="../Admin/secciones/descargables/pdfs/<?php echo htmlspecialchars($item['archivo']); ?>" download class="download-btn">Descargar</a>
                    </article>
                <?php endforeach; ?>
        </section>
    </main>

    <!-- Modal para visualizar el PDF -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Vista Previa del PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfViewer" src="" width="100%" height="700px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="download-btn" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Script para cargar el PDF en el modal
    const pdfModal = document.getElementById('pdfModal');
    pdfModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que activó el modal
        const pdfUrl = button.getAttribute('data-pdf'); // Obtener la URL del PDF
        const pdfViewer = document.getElementById('pdfViewer'); // Iframe del modal
        pdfViewer.src = pdfUrl; // Establecer la URL del PDF en el iframe
    });

    // Limpiar el iframe cuando se cierra el modal
    pdfModal.addEventListener('hidden.bs.modal', function () {
        const pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = ''; // Limpiar el iframe
    });
</script>

      <!-- Bootstrap JS (requiere Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="aaVNGM8GyOGNvrd1e0leq";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
</body>
</html>

