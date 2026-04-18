<?php
// controlador/ventasController.php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/productoModelo.php';
require_once '../modelo/clienteModelo.php';

// MAGIA ACÁ: Si el changuito no existe en la memoria, lo creamos como una lista vacía
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Buscamos datos para llenar los desplegables de la pantalla
$lista_productos = obtenerProductos($conexion);
$lista_clientes = obtenerClientes($conexion);

require_once '../vista/ventas.php';
?>