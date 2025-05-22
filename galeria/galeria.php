<?php
// Incluir conexión a la base de datos
require_once __DIR__ . '/../database/conexion.php';

// Consultar los datos de la tabla tbl_galeria
$stmt = $pdo->query("SELECT * FROM tbl_galeria");
$galeriaItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria de imagenes</title>
    <link rel="icon" type="image/x-icon" href="../imagenes/Logo-icon.ico">
    <link rel="stylesheet" href="galeria.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
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

<!-- Swiper Container -->
<div class="swiper mySwiper" style="padding-top: 180px; padding-left: 20px; padding-right: 20px;">
    <div class="swiper-wrapper">
        <?php foreach ($galeriaItems as $item): ?>
            <div class="swiper-slide">
                <div class="card mb-3">
                    <!-- Imagen de portada -->
                    <img src="../Admin/secciones/galeria/logo_galeria/<?php echo htmlspecialchars($item['img_portada']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['titulo_evento']); ?>">
                    <div class="card-body">
                        <!-- Título del evento -->
                        <h5 class="card-title text-center"><?php echo htmlspecialchars($item['titulo_evento']); ?></h5>
                        <!-- Contenido -->
                        <p class="card-text"><?php echo htmlspecialchars($item['contenido']); ?></p>
                        <!-- Botón para ver imágenes -->
                        <a href="img-section.php?id_evento_galeria=<?php echo $item['id_evento_galeria']; ?>" class="btn btn-primary">VER IMÁGENES</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Botones de navegación -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    <!-- Paginación -->
    <div class="swiper-pagination"></div>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Swiper JS Initialization -->
<script>
    var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        loop: true,
        spaceBetween: 10,
        loop: true,
        coverflowEffect: {
            depth:450,
            modifier:1,
            slidesShadows:true,
            rotate:0,
            stretch:0
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 5,
            },
        },
    });

     // Ocultar botones manualmente si la pantalla es pequeña
     if (window.innerWidth <= 768) {
            document.querySelector(".swiper-button-next").style.display = "none";
            document.querySelector(".swiper-button-prev").style.display = "none";
        }

    // Reajustar Swiper cuando la pantalla cambie de tamaño
    window.addEventListener("resize", function() {
        location.reload(); // Recarga la página para reiniciar Swiper con la configuración correcta
    });

</script>

<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="aaVNGM8GyOGNvrd1e0leq";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
</body>
</html>