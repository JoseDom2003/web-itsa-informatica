<?php
/**
 * Archivo de conexión a la base de datos.
 * 
 * Base de datos: db_agents-pionners
 * Host: localhost
 * Usuario: root
 * Contraseña: (vacía)
 * 
 * Se utiliza PDO para conectar a la base de datos y se configuran opciones que
 * facilitan el manejo de errores y la seguridad en las consultas.
 */// Incluir archivo de configuración
require_once __DIR__ . '/config.php';

// Definir el DSN (Data Source Name)
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";

// Opciones de configuración para PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en caso de error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Devuelve los resultados como array asociativo
    PDO::ATTR_EMULATE_PREPARES   => false, // Deshabilita la emulación de sentencias preparadas
];

try {
    // Crear la instancia de PDO
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    // Registrar el error en un archivo de log
    error_log("Error de conexión a la base de datos: " . $e->getMessage(), 3, __DIR__ . '/logs/error.log');
    die("Error de conexión a la base de datos. Por favor, contacta al administrador.");
}

// Variables de conexión
$dbHost = 'localhost';
$dbName = 'db_agents-pionners';
$dbUser = 'root';
$dbPass = '';

// Definir el DSN (Data Source Name)
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";

// Opciones de configuración para PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en caso de error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Devuelve los resultados como array asociativo
    PDO::ATTR_EMULATE_PREPARES   => false, // Deshabilita la emulación de sentencias preparadas
];

try {
    // Crear la instancia de PDO
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    // Control de error: en un entorno real, podrías registrar el error en un log
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>