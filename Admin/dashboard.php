<?php
require_once __DIR__ . '/../database/conexion.php';

// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no hay sesión activa
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/dashboard.css">
</head>

<body>
  
<div class="d-flex">
    <!-- Sidebar -->
    <nav id="sidebar" class="p-3">
      <h4>Administrador</h4>
      <hr>
      <div class="sidebar-heading">Core</div>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
        <a class="nav-link" href="#" onclick="mostrarPrincipal();">
            <span>&#x1F4CA;</span> Dashboard
          </a>
        </li>
      </ul>
      <div class="sidebar-heading">INTERFAZ</div>
      <ul class="nav flex-column">
        <li class="nav-item">
        <a id="toggleLayoutBtn" class="nav-link" href="#" onclick="toggleLayouts(); return false;">
            <span>&#x1F5C2;</span> Secciones
          </a>
          <div class="collapse" id="layoutsCollapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="javascript:void(0)" class="nav-link" onclick="mostrarSeccion('config-carrusel')">Carrusel</a></li>
              <li><a href="javascript:void(0)" class="nav-link" onclick="mostrarSeccion('config-galeria')">Galeria</a></li>
              <li><a href="javascript:void(0)" class="nav-link" onclick="mostrarSeccion('config-descargables')">Descargables</a></li>
              <li><a href="javascript:void(0)" class="nav-link" onclick="mostrarSeccion('config-redes')">Redes sociales</a></li>
              <li><a href="javascript:void(0)" class="nav-link" onclick="mostrarSeccion('config-testimonios')">Testimonios</a></li>
              <li><a href="javascript:void(0)" class="nav-link" onclick="mostrarSeccion('config-eventos')">Eventos y noticias</a></li>
              <li><a href="javascript:void(0)" class="nav-link" onclick="mostrarSeccion('config-mosaico')">Mosaico incio</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
    
    <!-- Contenido Principal -->
    <div class="flex-grow-1">
    <nav class="navbar navbar-dark bg-dark px-3">
  <button class="btn btn-outline-light me-3" id="toggleSidebar">☰</button>

  <div class="dropdown ms-3">
  <a
    href="#"
    class="d-block text-white text-decoration-none dropdown-toggle"
    aria-expanded="false"
  >
    <i class="bi bi-person-circle"></i> Cuenta
  </a>
  <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="./secciones/usuarios/config-usuarios.php">Perfiles</a></li>
    <li><a class="dropdown-item" href="./login/cerrar_sesion.php">Cerrar sesión</a></li>
  </ul>
</div>
</nav>
      
      <!-- Área principal de contenido -->
      <main class="p-4" id="contenido-principal">
        <h2>Bienvenido al panel de administración</h2>
        <?php
          echo "<p>Contenido cargado dinámicamente desde PHP.</p>";
        ?>
      </main>
      
      <!-- Contenedor para cargar layouts vía PHP -->
      <div id="layout-content" class="p-4">
        <!-- Sección Carrusel -->
        <div id="config-carrusel" class="d-none">
          <?php
            include "./secciones/carrusel/config-carrusel.php";
          ?>
        </div>
        
        <!-- Sección Galeria -->
        <div id="config-galeria" class="d-none">
          <?php
            include "./secciones/galeria/config-galeria.php";
          ?>
        </div>

        <!-- Sección Descargas -->
        <div id="config-descargables" class="d-none">
          <?php
            include "./secciones/descargables/config-descargables.php";
          ?>
        </div>
        
        <!-- Sección Redes sociales -->
        <div id="config-redes" class="d-none">
          <?php
            include "./secciones/redes_sociales/config-sociales.php";
          ?>
        </div>

        <div id="config-testimonios" class="d-none">
          <?php
            include "./secciones/testimonios/config-testimonios.php";
          ?>
        </div>

        <div id="config-eventos" class="d-none">
          <?php
            include "./secciones/eventos/config-eventos.php";
          ?>
        </div>

        <div id="config-mosaico" class="d-none">
          <?php
            include "./secciones/mosaico/config-mosaico.php";
          ?>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Scripts -->
   
<script>
  document.addEventListener('DOMContentLoaded', function() {
  // Para cada dropdown en la página
  document.querySelectorAll('.dropdown').forEach(function(dropdown) {
    const toggle = dropdown.querySelector('.dropdown-toggle');
    const menu = dropdown.querySelector('.dropdown-menu');

    // Al hacer clic en el trigger, abrimos/cerramos
    toggle.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();            // evitamos burbujeo
      menu.classList.toggle('show');
      // Actualizamos el aria-expanded
      toggle.setAttribute('aria-expanded', menu.classList.contains('show'));
    });

    // Si el usuario hace clic fuera del dropdown, lo cerramos
    document.addEventListener('click', function(e) {
      if (!dropdown.contains(e.target)) {
        menu.classList.remove('show');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  });
});
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="./js/layouts.js"></script>
</body>
</html>
