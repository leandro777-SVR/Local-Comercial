<?php
// controlador/guardarProductoController.php
session_start();

if (!isset($_SESSION['id_usuario']) || $_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/productoModelo.php';

// Atrapamos todos los datos del formulario
$codigo = trim($_POST['codigo_barras']);
$nombre = trim($_POST['nombre']);
$stock = $_POST['stock_actual'];
$precio = $_POST['precio_actual'];
$id_categoria = $_POST['id_categoria']; // Recibimos el ID numérico de la categoría elegida

if (!empty($nombre) && !empty($id_categoria)) {
    agregarProducto($conexion, $codigo, $nombre, $stock, $precio, $id_categoria);
}

// Lo devolvemos a la tabla de productos
header("Location: productoController.php");
exit();
?>