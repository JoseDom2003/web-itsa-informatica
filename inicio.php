<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Informática - ITSA</title>
  
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
      width: 100%;
      overflow-x: hidden; /* Si aún persiste el scroll, forzar ocultarlo */
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }

    img, iframe {
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
    padding: 1rem 2rem;
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
    margin: 0 0.5rem;
  }
  .navbar-nav .nav-link:hover,
  .navbar-nav .nav-link:focus {
    color: #fff;
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

@media (max-width: 767px) {
    .navbar-nav {
        width: 100%;
    }

    .navbar-nav .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .navbar-nav .nav-item:hover {
        transform: none;
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
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <!-- Bloque superior: logo y botón -->
    <div class="d-flex justify-content-between w-100">
      <a class="navbar-brand d-flex align-items-center" href="#" style="white-space: nowrap;">
        <img src="imagenes/imagen_2025-02-18_091508716-Photoroom.png" alt="AGENTS PIONERS Logo" class="me-2">
        AGENTS PIONERS
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
        <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
        <li class="nav-item"><a class="nav-link" href="#acerca-de">Acerca de</a></li>
        <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div id="theCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#theCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#theCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#theCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="imagenes/Principal.jpeg" alt="Innovación" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
                <h2>¡Bienvenido a Informática!</h2>
                <p>Descubre el futuro de la tecnología</p>
                <a href="#inscripcion" class="btn btn-cta">¡Inscríbete ahora!</a>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="imagenes/laboratori.jpeg" alt="Laboratorio" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
                <h2>Laboratorios de última generación</h2>
                <p>Prepárate con la mejor tecnología</p>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="imagenes/InShot_20250225_120434416.jpg" alt="Comunidad" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
                <h2>Forma parte de nuestra comunidad</h2>
                <p>Aprende, colabora y crece</p>
            </div>
        </div>
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
  <section id="galeria-descargas" class="py-5">
    <div class="container">
      <div class="row">
        <!-- Galería y Descargables -->
        <div class="col-lg-6 mb-4">
          <h2 class="text-primary fw-bold text-center">Galería y Descarga</h2>
          <div class="mt-3">
            <div class="card mb-4">
              <a href="https://www.ejemplo.com">
                <img src="imagenes/6052178.webp" class="card-img-top" alt="Galería">
              </a>
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">Galería</h5>
                <p class="card-text">Explora nuestra galería de imágenes y eventos.</p>
                <a href="./galeria/galeria.php" class="btn btn-primary">IR</a>
              </div>
            </div>
            <div class="card">
              <a href="./descargables/downloads.php">
                <img src="imagenes/6d2e6223980af30947f1f37270215eca-descargar-icono-de-circulo.webp" class="card-img-top" alt="Descargables">
              </a>
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">Descargables</h5>
                <p class="card-text">Encuentra documentos, guías y recursos útiles para descargar.</p>
                <a href="./descargables/downloads.php" class="btn btn-primary">IR</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Redes Sociales -->
        <div class="col-lg-6 mb-4">
          <h2 class="text-primary fw-bold text-center">Redes Sociales</h2>
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="card">
                <a href="https://www.facebook.com/TECNMAcayucanNOOFICIAL" target="_blank">
                  <img src="imagenes/pagina itsa todas.jpg" class="card-img-top" alt="ITSA">
                </a>
                <div class="card-body text-center">
                  <h5 class="card-title fw-bold">TECNMAcayucanNOOFICIAL</h5>
                  <p class="card-text">Tecnológico Nacional de México Campus Acayucan.</p>
                  <a href="https://www.facebook.com/TECNMAcayucanNOOFICIAL" class="btn btn-primary">IR</a>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card">
                <a href="https://www.facebook.com/profile.php?id=61571717986549" target="_blank">
                  <img src="imagenes/logo-carrera-informatica.jpg" class="card-img-top" alt="Ingeniería Informática">
                </a>
                <div class="card-body text-center">
                  <h5 class="card-title fw-bold">Ingeniería Informática</h5>
                  <p class="card-text">Página oficial de la carrera de Ingeniería Informática.</p>
                  <a href="https://www.facebook.com/profile.php?id=61571717986549" class="btn btn-primary">IR</a>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card">
                <a href="https://igluitsa.blogspot.com/p/desktopview.html" target="_blank">
                  <img src="imagenes/iglu itsa.jpeg" class="card-img-top" alt="Iglú ITSA">
                </a>
                <div class="card-body text-center">
                  <h5 class="card-title fw-bold">Iglú ITSA</h5>
                  <p class="card-text">Un medio de difusión de conocimientos en la comunidad informática.</p>
                  <a href="https://igluitsa.blogspot.com/p/desktopview.html" class="btn btn-primary">IR</a>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card">
                <a href="https://acayucan.sistemasie.app/cgi-bin/sie.pl?Opc=PINDEXESTUDIANTE&psie=acayucan&dummy=0" target="_blank">
                  <img src="imagenes/itsa.png" class="card-img-top" alt="SIE">
                </a>
                <div class="card-body text-center">
                  <h5 class="card-title fw-bold">SIE</h5>
                  <p class="card-text">Sistema de Integración Escolar.</p>
                  <a href="https://acayucan.sistemasie.app/cgi-bin/sie.pl?Opc=PINDEXESTUDIANTE&psie=acayucan&dummy=0" class="btn btn-primary">IR</a>
                </div>
              </div>
            </div>
          </div> <!-- Fin de la fila de redes -->
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
    <div class="pdf-iframe-container">
      <iframe src="PDF/IINF.pdf" frameborder="0" allowfullscreen></iframe>
    </div>
  </div>
</div>

    <div class="card-footer text-center">
      <a href="PDF/IINF.pdf" class="btn btn-primary btn-lg mx-2" download>
        <i class="fas fa-download me-2"></i> Descargar PDF
      </a>
      <a href="PDF/IINF.pdf" target="_blank" class="btn btn-outline-secondary btn-lg mx-2">
        <i class="fas fa-expand me-2"></i> Agrandar
      </a>
    </div>
  </div>
</section>

  
  <section id="testimonios" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Testimonios</h2>
        <div class="row">
            
            <?php 
            /*
            // Conexión a la base de datos (descomentar en el futuro)
            $conexion = new mysqli("localhost", "usuario", "contraseña", "base_de_datos");
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Obtener 4 testimonios aleatorios sin repetir
            $sql = "SELECT nombre, comentario FROM testimonios ORDER BY RAND() LIMIT 4";
            $resultado = $conexion->query($sql);
            
            while ($fila = $resultado->fetch_assoc()) {
                echo '<div class="col-md-3 mb-3">
                        <div class="card testimonio-card p-3">
                            <p class="testimonio-text">"' . $fila["comentario"] . '"</p>
                            <div class="testimonio-autor">' . $fila["nombre"] . '</div>
                        </div>
                      </div>';
            }
            
            $conexion->close();
            */
            ?>

            <!-- Testimonios Estáticos -->
            <div class="col-md-3 mb-3">
                <div class="card testimonio-card p-3">
                    <p class="testimonio-text">"ITSA me ha dado las herramientas para crecer en el mundo laboral."</p>
                    <div class="testimonio-autor">marcos palmeros</div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card testimonio-card p-3">
                    <p class="testimonio-text">"El ambiente de aprendizaje es increíble, profesores altamente capacitados."</p>
                    <div class="testimonio-autor">José domingues</div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card testimonio-card p-3">
                    <p class="testimonio-text">"Gracias a ITSA conseguí mi primer empleo en tecnología."</p>
                    <div class="testimonio-autor">marcel chipol</div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card testimonio-card p-3">
                    <p class="testimonio-text">"La mejor experiencia académica que he tenido. Recomiendo ITSA 100%."</p>
                    <div class="testimonio-autor">aleman librado</div>
                </div>
            </div>

        </div>
    </div>
</section>

  
  <!-- Sección Eventos y Noticias -->
  <section id="eventos" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Eventos y Noticias</h2>
      <div class="row">
        <!-- Evento 1 -->
        <div class="col-md-6 mb-4">
          <div class="card event-card">
            <div class="card-header text-center"><strong>IK-TON 2024</strong></div>
            <div class="card-body">
              <div id="carouselIkTon" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="imagenes/iK-TON 1.webp" class="d-block w-100" alt="IK-TON 1">
                  </div>
                  <div class="carousel-item">
                    <img src="imagenes/iK-TON 2.webp" class="d-block w-100" alt="IK-TON 2">
                  </div>
                  <div class="carousel-item">
                    <img src="imagenes/iK-TON 3.webp" class="d-block w-100" alt="IK-TON 3">
                  </div>
                </div>
              </div>
              <p class="mt-3">El IK-TON 2024 es un evento anual que reúne a profesionales y entusiastas de la tecnología para compartir conocimientos y experiencias.</p>
              <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#videoModalIkTon">
                Ver Video
              </button>
            </div>
          </div>
        </div>
        <!-- Evento 2 -->
        <div class="col-md-6 mb-4">
          <div class="card event-card">
            <div class="card-header text-center"><strong>FLISOL 2024</strong></div>
            <div class="card-body">
              <div id="carouselFlisol" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="imagenes/flisol 1.webp" class="d-block w-100" alt="FLISOL 1">
                  </div>
                  <div class="carousel-item">
                    <img src="imagenes/flisol 2.webp" class="d-block w-100" alt="FLISOL 2">
                  </div>
                  <div class="carousel-item">
                    <img src="imagenes/flisol 3.webp" class="d-block w-100" alt="FLISOL 3">
                  </div>
                </div>
              </div>
              <p class="mt-3">FLISOL es el evento de difusión de Software Libre más grande en Latinoamérica, promoviendo el uso del software libre desde 2005.</p>
              <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#videoModalFlisol">
                Ver Video
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Video IK-TON -->
    <div class="modal fade" id="videoModalIkTon" tabindex="-1" aria-labelledby="videoModalIkTonLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="videoModalIkTonLabel">Video de IK-TON 2024</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div class="ratio ratio-16x9">
              <iframe src="https://www.youtube.com/embed/TUQirJHHyfE" title="Video de IK-TON 2024" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Video FLISOL -->
    <div class="modal fade" id="videoModalFlisol" tabindex="-1" aria-labelledby="videoModalFlisolLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="videoModalFlisolLabel">Video de FLISOL</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div class="ratio ratio-16x9">
              <iframe src="https://www.youtube.com/embed/VIDEO_ID_FLISOL" title="Video de FLISOL" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Sección Contacto -->
  <section id="contacto" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Contacto</h2>
      <div class="row">
        <div class="col-md-6">
          <form id="formulario-contacto">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre:</label>
              <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa tu nombre" required>
            </div>
            <div class="mb-3">
              <label for="email-contacto" class="form-label">Correo electrónico:</label>
              <input type="email" id="email-contacto" name="email-contacto" class="form-control" placeholder="Ingresa tu correo" required>
            </div>
            <div class="mb-3">
              <label for="mensaje" class="form-label">Mensaje:</label>
              <textarea id="mensaje" name="mensaje" class="form-control" placeholder="Escribe tu mensaje aquí..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>
        </div>
        <div class="col-md-6">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d496.1417080772632!2d-94.92202260883872!3d18.04315309101915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85e9f9b0610e807f%3A0xbffd3888fcad8496!2sTecNM%20-%20Campus%20Acayucan!5e0!3m2!1ses-419!2smx!4v1740089699895!5m2!1ses-419!2smx" 
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </section>
  
<!-- Footer -->
<footer class="text-center py-4" style="background: linear-gradient(90deg, #0062E6, #33AEFF); color: #fff;">
    <div class="container">
      <p>&copy; 2025 ITSA - Carrera de Informática</p>
      <div class="footer-links">
        <a href="#inicio" class="text-white me-2">Inicio</a> |
        <a href="#acerca-de" class="text-white me-2">Acerca de</a> |
        <a href="#contacto" class="text-white">Contacto</a>
      </div>
    </div>
  </footer>
  
  
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
</body>
</html>