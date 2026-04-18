<?php
// controlador/guardarCategoriaController.php
session_start();

// Si no está logueado o si alguien intenta entrar sin enviar el formulario por POST, lo pateamos
if (!isset($_SESSION['id_usuario']) || $_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/categoriaModelo.php';

// Atrapamos el nombre que el usuario escribió en el formulario
$nombre = trim($_POST['nombre_categoria']);

// Si no está vacío, lo mandamos a la cocina para que lo guarde
if (!empty($nombre)) {
    agregarCategoria($conexion, $nombre);
}

// Una vez guardado, lo devolvemos automáticamente a la tabla para que vea el cambio
header("Location: categoriaController.php");
exit();
?>