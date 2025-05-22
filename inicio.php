<?php
// Incluir conexión a la base de datos
require_once __DIR__ . '/database/conexion.php';

// Consultar los datos de la tabla tbl_carrusel
$stmt = $pdo->query("SELECT * FROM tbl_carrusel");
$carruselItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consultar los datos de la tabla tbl_redes
$stmt = $pdo->query("SELECT * FROM tbl_redes");
$redes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consultar los registros de la tabla tbl_eventos
$stmt = $pdo->query("SELECT * FROM tbl_eventos");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consultar los registros de la tabla tbl_testimonios
$stmt = $pdo->query("SELECT * FROM tbl_testimonios ORDER BY id_testimonio DESC");
$testimonios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Informática - ITSA</title>
  <link rel="icon" type="image/x-icon" href="./imagenes/Logo-icon.ico">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="styles/galeria-descargas.css">
  <link rel="stylesheet" href="styles/eventos-noticias.css">
  <link rel="stylesheet" href="styles/testimonios.css">
  <link rel="stylesheet" href="styles/carousel.css"> 
  <link rel="stylesheet" href="styles/carrera.css"> 
  <link rel="stylesheet" href="styles/plan-estudios.css">

  
  <!-- Estilos específicos para el Navbar en tonos azules -->
  <style>

    html, body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }

    img {
      max-width: 100%;
      height: auto;
      display: block;
    }

  a {
    text-decoration: none;
    color: inherit;
  }

   /* Navbar */
   .navbar {
    background: linear-gradient(90deg, #0062E6, #33AEFF);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  .navbar-brand {
    color: #fff !important;
    font-size: 1.5rem;
    font-weight: bold;
    display: flex;
    align-items: center;
  }
  .navbar-brand img {
    max-height: 40px;
    margin-right: 10px;
  }
  .navbar-nav .nav-link {
    color: rgba(255, 255, 255, 0.9);
    transition: color 0.3s ease;
    white-space: nowrap;
    padding-left: 10px;
  }
  .navbar-nav .nav-link:hover,
  .navbar-nav .nav-link:focus {
    transition: 0.3s ease;
  }
  .navbar-toggler {
    border: none;
  }
  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.9)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
  }

  /* Animación de los ítems del navbar */
.navbar-nav .nav-item {
  transition: transform 0.3s ease, color 0.3s ease; /* Transición suave */
}

/* Efecto cuando pasas el mouse sobre los ítems */
.navbar-nav .nav-item:hover {
  transform: translateY(-5px); /* Desplaza el ítem hacia arriba */
}

.star-rating {
        display: flex;
        flex-direction: row-reverse; /* Mantiene las estrellas en orden inverso */
        justify-content: flex-end; /* Alinea las estrellas a la izquierda */
    }

    .star-rating input[type="radio"] {
        display: none; /* Oculta los botones de radio */
    }

    .star-rating label {
        font-size: 2rem; /* Tamaño de las estrellas */
        color: #ddd; /* Color predeterminado */
        cursor: pointer; /* Cambia el cursor al pasar sobre las estrellas */
    }

    .star-rating input[type="radio"]:checked ~ label {
        color: #ffc107; /* Color de las estrellas seleccionadas */
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107; /* Color al pasar el cursor sobre las estrellas */
    }

@media (max-width: 767px) {

  body{
    padding-top: 75px;
  }

  .navbar{
    padding: 15px;
  }
    .navbar-nav {
        width: 100%;
    }

    .navbar-nav .nav-item:hover {
      transition: color 0.04s ease;
    }

    .container-fluid {
        padding: 0;
    }
}

  .video-container {
    position: relative;
    width: 100%; /* Más grande pero sin salirse de la pantalla */
    max-width: 900px; /* Límite para pantallas grandes */
    aspect-ratio: 16 / 9; /* Mantiene la relación de aspecto */
    margin: 0px auto; /* Centrado */
    border-radius: 12px; /* Bordes redondeados */
    overflow: hidden; /* Evita desbordes */
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2); /* Sombra para resaltar */
  }

  /* Estilos del iframe */
  .video-container iframe {
    width: 100%;
    height: 100%;
    border: none;
  }

  /* Título del video */
  .video-title {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
  }

  /* Ajuste para pantallas pequeñas */
  @media (max-width: 767px) {
    .video-container {
      width: 100%; /* Ocupa todo el ancho en móviles */
      border-radius: 10px; /* Bordes menos pronunciados en pantallas chicas */
    }

    .video-title {
      font-size: 1.5rem; /* Texto más pequeño para móviles */
    }
  }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
    <!-- Bloque superior: logo y botón -->
    <div class="d-flex justify-content-between w-100">
      <a class="navbar-brand d-flex align-items-center" href="index.php" style="white-space: nowrap;">
        <img src="imagenes/Logo.png" alt="AGENTS PIONERS Logo" class="me-2">
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
  
<div id="theCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-wrap="true">
    <!-- Indicadores -->
    <div class="carousel-indicators">
        <?php foreach ($carruselItems as $index => $item): ?>
            <button type="button" data-bs-target="#theCarousel" data-bs-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo $index + 1; ?>"></button>
        <?php endforeach; ?>
    </div>

    <!-- Contenido del carrusel -->
    <div class="carousel-inner">
        <?php foreach ($carruselItems as $index => $item): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <img src="./Admin/secciones/carrusel/imagenes/<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['titulo']); ?>" class="d-block w-100" style="object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h2><?php echo htmlspecialchars($item['titulo']); ?></h2>
                    <p><?php echo htmlspecialchars($item['subtitulo']); ?></p>
                    <a href="#inscripcion" class="btn btn-cta">¡Inscríbete ahora!</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Botones de navegación -->
    <button class="carousel-control-prev" type="button" data-bs-target="#theCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#theCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

  
  <!-- Sección de Inicio -->
  <section id="inicio" class="text-center py-5 bg-primary text-white">
    <div class="container">
      <h1 class="display-4">Ingeniería en Informática</h1>
      <p class="lead">Formamos profesionales capaces de innovar y transformar el mundo con tecnología.</p>
    </div>
  </section>
  
  <section id="carrera" class="py-5">
  <div class="container">
    <h2 class="text-center mb-4">¿De qué trata la carrera?</h2>
    <div class="row justify-content-center"> 
      <!-- Tarjeta 1: Programación -->
      <div class="col-10 col-md-4 mb-4">
        <div class="card carrera-card h-100 text-center">
          <img src="https://cdn-icons-png.flaticon.com/512/226/226777.png" alt="Programación">
          <div class="card-body">
            <h5 class="card-title">Programación y desarrollo de software</h5>
            <p class="card-text">Aprende a crear aplicaciones y sistemas innovadores utilizando lenguajes como Java, Python y C++.</p>
          </div>
        </div>
      </div>

      <!-- Tarjeta 2: Bases de Datos -->
      <div class="col-10 col-md-4 mb-4">
        <div class="card carrera-card h-100 text-center">
          <img src="https://cdn-icons-png.flaticon.com/512/2772/2772128.png" alt="Bases de datos">
          <div class="card-body">
            <h5 class="card-title">Bases de datos</h5>
            <p class="card-text">Gestiona y optimiza el almacenamiento de información con tecnologías como MySQL, PostgreSQL y MongoDB.</p>
          </div>
        </div>
      </div>

      <!-- Tarjeta 3: Inteligencia Artificial -->
      <div class="col-10 col-md-4 mb-4">
        <div class="card carrera-card h-100 text-center">
          <img src="https://cdn-icons-png.flaticon.com/512/2103/2103655.png" alt="Inteligencia Artificial">
          <div class="card-body">
            <h5 class="card-title">Inteligencia Artificial</h5>
            <p class="card-text">Desarrolla sistemas inteligentes y autónomos utilizando Python, TensorFlow y Machine Learning.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


  
  <!-- Sección Video -->
<section id="video" class="py-5">
  <div class="container text-center">
    <h2 class="video-title">🎬 ¡Disfruta el Video!</h2>
    <div class="video-container">
      <iframe src="https://www.youtube-nocookie.com/embed/ZTubbxN2_QE" title="Video" allowfullscreen></iframe>
    </div>
  </div>
</section>

    <!-- Sección Galería y Descargas / Redes Sociales -->
  <section id="galeria-descargas" class="">
    <div class="container">
      <div class="row">
        <!-- Galería y Descargables -->
        <div class="col-lg-6 mb-4">
          <h2 class="fw-bold text-center pt-3">Galería y Descarga</h2>
          <div class="mt-3">
            <div class="card mb-4">
              <a href="./galeria/galeria.php">
                <img src="./imagenes/galeria.png" class="card-img-top" alt="Galería">
              </a>
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">Galería</h5>
                <p class="card-text">Explora nuestra galería de imágenes y eventos.</p>
                <a href="./galeria/galeria.php" class="btn btn-primary">IR</a>
              </div>
            </div>
            <div class="card">
              <a href="./descargables/descargable.php">
                <img src="imagenes/downloads.webp" class="card-img-top" alt="Descargables">
              </a>
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">Descargables</h5>
                <p class="card-text">Encuentra documentos, guías y recursos útiles para descargar.</p>
                <a href="./descargables/descargable.php" class="btn btn-primary">IR</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Redes Sociales -->
        <div class="col-lg-6 mb-4">
          <h2 class="fw-bold text-center pt-3">Redes Sociales</h2>
          <div class="row">
          <?php foreach ($redes as $item): ?>
            <div class="col-md-6 mb-4">
              <div class="card">
              <a href="<?php echo htmlspecialchars($item['url']); ?>" target="_blank">
              <img src="./Admin/secciones/redes_sociales/logos/<?php echo htmlspecialchars($item['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['titulo']); ?>">
                </a>
                <div class="card-body text-center">
                  <h5 class="card-title fw-bold"><?php echo htmlspecialchars($item['titulo']); ?></h5>
                  <p class="card-text"><?php echo htmlspecialchars($item['descripcion']); ?></p>
                  <a href="<?php echo htmlspecialchars($item['url']); ?>" target="_blank" class="btn btn-primary">Visitar</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  
<!-- Sección Plan de Estudios -->
<section id="plan-estudios" class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-4">Plan de Estudios</h2>
      <p class="lead">Explora nuestro plan de estudios detallado para conocer las materias, créditos y estructura del programa.</p>
    </div>

<div class="pdf-viewer-container text-center">
  <div class="pdf-card">
    <h2 class="pdf-title">📄 Vista del Documento</h2>
    <div class="pdf-iframe-container d-flex justify-content-center">
      <iframe src="PDF/IINF.pdf" frameborder="0" allowfullscreen></iframe>
    </div>
  </div>
</div>

    <div class="card-footer text-center">
      <a href="PDF/IINF.pdf" class="btn btn-primary btn-lg mx-2 d-inline-block" download>
        <i class="fas fa-download me-2"></i> Descargar PDF
      </a>
      <a href="PDF/IINF.pdf" target="_blank" class="btn btn-outline-secondary btn-lg mx-2 d-inline-block">
        <i class="fas fa-expand me-2"></i> Agrandar
      </a>
    </div>
  </div>
</section>

  
  <section id="testimonios" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Testimonios</h2>
        <div class="row">
        <?php foreach ($testimonios as $testimonio): ?>
            <div class="col-md-3 mb-3">
                <div class="card testimonio-card p-3">
                    <p class="testimonio-text"><?php echo htmlspecialchars($testimonio['mensaje']); ?></p>
                    <div class="testimonio-autor"><?php echo htmlspecialchars($testimonio['nombre']); ?></div>
                    <?php if (!empty($testimonio['calificacion'])): ?>
                            <div class="testimonio-calificacion mt-2">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="fa fa-star <?php echo $i <= $testimonio['calificacion'] ? 'text-warning' : 'text-muted'; ?>"></span>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="eventos" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Eventos y Noticias</h2>
        <div class="row">
            <?php foreach ($eventos as $evento): ?>
                <?php $imagenes = json_decode($evento['imagen'], true); ?>
                <div class="col-md-6 mb-4">
                    <div class="card event-card">
                        <div class="card-header text-center">
                            <strong><?php echo htmlspecialchars($evento['titulo']); ?></strong>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($imagenes)): ?>
                                <div id="carouselEvento<?php echo $evento['id_evento']; ?>" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($imagenes as $index => $imagen): ?>
                                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                <img src="Admin/secciones/eventos/imagenes/<?php echo htmlspecialchars($imagen); ?>" 
                                                     class="d-block w-100" 
                                                     alt="Imagen del evento: <?php echo htmlspecialchars($evento['titulo']); ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- Controles del carrusel -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselEvento<?php echo $evento['id_evento']; ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Anterior</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselEvento<?php echo $evento['id_evento']; ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Siguiente</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <p class="mt-3"><?php echo htmlspecialchars($evento['descripcion']); ?></p>
                            <?php if (!empty($evento['video'])): ?>
                                <!-- Botón para abrir el modal -->
                                <button type="button" 
                                        class="btn btn-primary btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#videoModal<?php echo $evento['id_evento']; ?>">
                                    Ver Video
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div> <!-- Cierre del .row -->

        <!-- Modales DEBEN estar FUERA del .row y en el mismo nivel -->
        <?php foreach ($eventos as $evento): ?>
            <?php if (!empty($evento['video'])): ?>
                <div class="modal fade" 
                     id="videoModal<?php echo $evento['id_evento']; ?>" 
                     tabindex="-1" 
                     role="dialog" 
                     aria-labelledby="videoModalLabel<?php echo $evento['id_evento']; ?>"
                     aria-modal="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="videoModalLabel<?php echo $evento['id_evento']; ?>">
                                    <?php echo htmlspecialchars($evento['titulo']); ?>
                                </h5>
                                <button type="button" 
                                        class="btn-close" 
                                        data-bs-dismiss="modal" 
                                        aria-label="Cerrar modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                <video controls class="w-100" style="max-height: 80vh;">
                                    <source src="Admin/secciones/eventos/videos/<?php echo htmlspecialchars($evento['video']); ?>" type="video/mp4">
                                    Tu navegador no soporta la reproducción de videos.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div> <!-- Cierre del .container -->
</section>

<!-- Sección Contacto -->
<section id="contacto" class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <!-- Encabezado y formulario de contacto -->
            <div class="col-md-6">
                <h2 class="text-center mb-4 position-relative">Contacto</h2>
                <div class="border border-primary bg-primary mx-auto" style="width: 80px; height: 4px; border-radius: 4px; margin-bottom: 40px; padding-top:0%"></div>
                <form action="/Admin/secciones/testimonios/upload.php" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa tu nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico:</label>
                        <input type="email" id="correo" name="correo" class="form-control" placeholder="Ingresa tu correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje:</label>
                        <textarea id="mensaje" name="mensaje" class="form-control" placeholder="Escribe tu mensaje aquí..." required></textarea>
                    </div>
                    <!-- Calificación con estrellas -->
                    <div class="mb-3">
                        <label class="form-label">Califica nuestro sitio:</label>
                        <div class="star-rating">
                            <input type="radio" id="estrella5" name="calificacion" value="5"><label for="estrella5" title="5 estrellas">&#9733;</label>
                            <input type="radio" id="estrella4" name="calificacion" value="4"><label for="estrella4" title="4 estrellas">&#9733;</label>
                            <input type="radio" id="estrella3" name="calificacion" value="3"><label for="estrella3" title="3 estrellas">&#9733;</label>
                            <input type="radio" id="estrella2" name="calificacion" value="2"><label for="estrella2" title="2 estrellas">&#9733;</label>
                            <input type="radio" id="estrella1" name="calificacion" value="1"><label for="estrella1" title="1 estrella">&#9733;</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                <br>
                <small class="text-muted">*Cualquier comentario fuera de lugar, con contenido explicito, será eliminado.*</small>
            </div>

            <!-- Encabezado y ubicación -->
            <div class="col-md-6">
                <h2 class="text-center mb-4 position-relative">Nos encontramos aquí</h2>
                <div class="border border-primary bg-primary mx-auto" style="width: 80px; height: 4px; border-radius: 4px; margin-bottom: 50px; padding-top:0%"></div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d496.1417080772632!2d-94.92202260883872!3d18.04315309101915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85e9f9b0610e807f%3A0xbffd3888fcad8496!2sTecNM%20-%20Campus%20Acayucan!5e0!3m2!1ses-419!2smx!4v1740089699895!5m2!1ses-419!2smx" 
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
  
<!-- Footer -->
<footer class="text-center py-4" style="background: linear-gradient(90deg, #0062E6, #33AEFF); color: #fff;">
  <div class="container">
    <p>&copy; 2025 ITSA - Carrera de Informática |  <a href="Admin/login.php" class="text-white">Admin</a></p>
  </div>
</footer>

<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="aaVNGM8GyOGNvrd1e0leq";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
  
  
  <!-- Bootstrap Bundle JS (incluye Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
  <!-- Script personalizado (ejemplo para estrellas de calificación) -->
  <script>
    const stars = document.querySelectorAll('.fa-star');
    const ratingInput = document.getElementById('calificacion');
    stars.forEach(star => {
      star.addEventListener('click', () => {
        let rating = star.getAttribute('data-index');
        ratingInput.value = rating;
        stars.forEach(s => s.classList.remove('checked'));
        for (let i = 0; i < rating; i++) {
          stars[i].classList.add('checked');
        }
      });
    });
  </script>


<script>
    // Detener el video cuando se cierra el modal
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function () {
            const video = modal.querySelector('video');
            if (video) {
                video.pause(); // Pausar el video
                video.currentTime = 0; // Reiniciar el video
            }
        });
    });
</script>
</body>
</html>