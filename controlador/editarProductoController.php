<?php
// controlador/editarProductoController.php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/productoModelo.php';
require_once '../modelo/categoriaModelo.php';

// CASO 1: Apretaron "Guardar Cambios"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_productos'];
    $codigo = trim($_POST['codigo_barras']);
    $nombre = trim($_POST['nombre']);
    $stock = $_POST['stock_actual'];
    $precio = $_POST['precio_actual'];
    $id_categoria = $_POST['id_categoria'];

    if (!empty($nombre)) {
        actualizarProducto($conexion, $id, $codigo, $nombre, $stock, $precio, $id_categoria);
    }
    header("Location: productoController.php");
    exit();
}

// CASO 2: Apretaron el botón amarillo "Editar" en la tabla
if (isset($_GET['id'])) {
    $id_editar = $_GET['id'];
    
    // Traemos el producto específico y TODAS las categorías
    $producto_actual = obtenerProductoPorId($conexion, $id_editar);
    $lista_categorias = obtenerCategorias($conexion);

    if (!$producto_actual) {
        header("Location: productoController.php");
        exit();
    }

    require_once '../vista/editarProducto.php';
} else {
    header("Location: productoController.php");
    exit();
}
?>