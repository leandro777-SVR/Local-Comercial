<?php
// controlador/eliminarCategoriaController.php
session_start();

// Seguridad básica
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/categoriaModelo.php';

// Atrapamos el ID que nos llega por la URL (método GET)
if (isset($_GET['id'])) {
    $id_a_borrar = $_GET['id'];
    
    // Llamamos a la cocina para que lo elimine
    eliminarCategoria($conexion, $id_a_borrar);
}

// Lo devolvemos a la tabla para que vea que desapareció
header("Location: categoriaController.php");
exit();
?>