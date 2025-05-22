<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no hay sesión activa
    header("Location: ../../login.php");
    exit();
}
// Incluir conexión a la base de datos
require_once __DIR__ . '/../../../database/conexion.php';

//OBTENER EL ID DEL REGISTRO PARA ELIMINARLO

$id = $_GET['id_testimonio'] ?? null;

if (!$id){
    die ("ID no proporcionado.");
}

// Consultar el registro para obtener el nombre de la imagen
$stmt = $pdo->prepare("SELECT * FROM tbl_testimonios WHERE id_testimonio = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Registro no encontrado.");
}

// Eliminar el registro de la base de datos
$stmt = $pdo->prepare("DELETE FROM tbl_testimonios WHERE id_testimonio = ?");
$stmt->execute([$id]);

// Redirigir a config-redes.php después de eliminar
header("Location: /Admin/dashboard.php");
exit();

