<?php
// controlador/eliminarProductoController.php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/productoModelo.php';

// Atrapamos el ID que viene por la URL
if (isset($_GET['id'])) {
    $id_a_borrar = $_GET['id'];
    eliminarProducto($conexion, $id_a_borrar);
}

// Volvemos al inventario
header("Location: productoController.php");
exit();
?>