<?php
// Iniciar sesión
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container-fluid">
    <div class="d-flex justify-content-between w-100">
      <a class="navbar-brand d-flex align-items-center" href="../inicio.php" style="white-space: nowrap;">
        <img src="../imagenes/Logo.png" alt="AGENTS PIONERS Logo" width="40" height="40" class="me-2">
        AGENTS PIONEERS
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="#video">Video</a></li>
        <li class="nav-item"><a class="nav-link" href="#galeria-descargas">Galería</a></li>
        <li class="nav-item"><a class="nav-link" href="#descargas">Descargas</a></li>
        <li class="nav-item"><a class="nav-link" href="#plan-estudios">Plan de estudios</a></li>
        <li class="nav-item"><a class="nav-link" href="#eventos">Eventos</a></li>
        <li class="nav-item"><a class="nav-link" href="#testimonios">Testimonios</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container d-flex justify-content-center align-items-center" style="padding-top: 150px;">
  <div class="card p-4 shadow" style="width: 400px; border-radius: 10px;">
    <h2 class="text-center mb-4">Iniciar Sesión</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger text-center" role="alert">
            <strong><?php echo htmlspecialchars($_SESSION['error']); ?></strong>
        </div>
        <?php unset($_SESSION['error']); // Eliminar el mensaje de error después de mostrarlo ?>
    <?php endif; ?>
    <form action="login/validacion_login.php" method="POST">
    <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" required>
    </div>
    <div class="mb-3">
        <label for="contraseña" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="contraseña" name="contraseña" required>
    </div>
    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary">Acceder</button>
        <a href="../inicio.php" class="btn btn-danger">Regresar</a>
    </div>
</form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
