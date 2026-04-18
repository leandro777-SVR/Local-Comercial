<?php
// config/conexion.php
$host = '127.0.0.1'; 
$dbname = 'proyecto_01'; 
$username = 'root'; 
$password = '1234567'; 

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $opciones = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $conexion = new PDO($dsn, $username, $password, $opciones);
} catch (PDOException $e) {
    die("Error crítico de conexión: " . $e->getMessage());
}
?>