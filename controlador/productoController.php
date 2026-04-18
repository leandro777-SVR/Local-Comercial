<?php
// controlador/productoController.php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/productoModelo.php';
// AGREGAMOS EL MODELO DE CATEGORÍAS
require_once '../modelo/categoriaModelo.php'; 

// Le pedimos al modelo los productos...
$lista_productos = obtenerProductos($conexion);

// ...Y también le pedimos las categorías para armar el menú desplegable (El <select>)
$lista_categorias = obtenerCategorias($conexion);

require_once '../vista/productos.php';
?>