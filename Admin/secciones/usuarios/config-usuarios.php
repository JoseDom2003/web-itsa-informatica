<?php
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

// Consultar todos los usuarios
$stmt = $pdo->query("SELECT * FROM tbl_usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../styles/dashboard.css">
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
        <a class="nav-link" href="../../dashboard.php" onclick="mostrarPrincipal();">
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
    <li><a class="dropdown-item" href="./login/cerrar_sesion.php">Cerrar sesión</a></li>
  </ul>
</div>
</nav>

    <div class="container mt-5 pt-5">
        <h1 class="text-center mb-4">Usuarios Registrados</h1>
        <div class="card shadow p-4">
            <a href="upload.php" class="btn btn-success mb-3" style="width: 100px;">AGREGAR</a>
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['id_usuario']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['contraseña']); ?></td>
                            <td>
                                <a href="delete.php?id_usuario=<?php echo $usuario['id_usuario']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/layouts.js"></script>
</body>
</html>