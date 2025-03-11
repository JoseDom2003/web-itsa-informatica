<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="galeria.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
/* Asegura que las imágenes dentro de las columnas sean responsivas */
.row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 1rem; /* Espacio entre las columnas */
}

.column {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* Estilo para las imágenes */
.column img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 5px; /* Bordes redondeados */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transición suave */
}

/* Efecto hover en las imágenes */
.column img:hover {
    transform: scale(1.02); /* Aumenta el tamaño de la imagen */
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3); /* Sombra más intensa */
}

/* Modal más grande y centrado */
        .modal-dialog {
            max-width: 95%; /* Establece el ancho máximo del modal */
            width: 90%; /* Ocupa el 90% del ancho de la pantalla */
            margin: 0 auto; /* Centra el modal */
            padding-top: 10px;
        }
        .modal-content {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 0; /* Quitar padding para ajustar la imagen */
        }
        .modal-body {
            text-align: center;
            padding: 0;
            overflow: hidden; /* Evita que la imagen se desborde */
        }
        .modal-body img {
            width: 100%;
            max-width: 100%; /* Asegura que no sobrepase el contenedor */
            height: auto;
            max-height: 90vh; /* Ajusta la imagen al 90% de la altura de la ventana */
            object-fit: contain; /* Mantiene la proporción de la imagen */
            border-radius: 8px;
        }
        .modal-footer {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
/* Responsividad: En pantallas pequeñas, las imágenes ocupan el 100% del ancho */
@media (max-width: 768px) {
    .row {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Aumenta el tamaño mínimo */
    }

    .modal-dialog {
                width: 95%; /* El modal ocupará el 95% en pantallas más pequeñas */
            }
            .modal-body img {
                max-height: 70vh; /* Limita la altura de la imagen en pantallas pequeñas */
            }
        }

</style>

</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="../index.html">
                <img src="../imagenes/imagen_2025-02-18_091508716-Photoroom.png" alt="AGENTS PIONERS Logo" class="me-2">
                AGENTS PIONERS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
</header>

<div class="container-fluid">
        <div class="heading pt-4 ">
            <h1 class="text-center text-white pt-4">IMAGENES IK-TON</h1>
            <h4 class="text-center text-light py-1">Aqui encontraras todas las imagenes relacionadas con el ikton 2024.</h4>
        </div>
        <div class="row py-5 px-lg-5 px-sm-0">

            <div class="column">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/IMG_20221208_094553_HDR.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_647edac1.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.49_c1090c45.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.49_c2614200.jpg" alt="" onclick="openModal(this)">
            </div>

            <div class="column">
                <img src="../imagenes/img_galeria/IMG_20221208_094556_HDR.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/IMG_20221208_095436.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/IMG_20221208_095439.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/IMG_20221208_113956_HDR.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/IMG_20221208_115002_HDR.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/IMG_20221208_115009_HDR.jpg" alt="" onclick="openModal(this)">
            </div>
            <div class="column">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
            </div>
            <div class="column">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">
                <img src="../imagenes/img_galeria/Imagen de WhatsApp 2025-02-26 a las 22.37.48_326fceb3.jpg" alt="" onclick="openModal(this)">

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
    let isLarge = false;

    function openModal(imgElement) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imgElement.src;
        document.getElementById('downloadBtn').href = imgElement.src;

        isLarge = false;
        modalImage.style.maxHeight = "75vh"; // Tamaño normal

        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="main.js"></script>
</body>
</html>