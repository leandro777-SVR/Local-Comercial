<?php
// controlador/procesarVentaController.php
session_start();

if (!isset($_SESSION['id_usuario']) || $_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/ventasModelo.php';

// Verificamos por seguridad que el carrito no esté vacío
if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0) {
    header("Location: ventasController.php");
    exit();
}

// Atrapamos al cliente (Puede venir vacío si es Consumidor Final)
$id_cliente = $_POST['id_cliente'];

// Calculamos el total real recorriendo el carrito
$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += ($item['cantidad'] * $item['precio']);
}

// MANDAMOS TODO A GUARDAR EN LA BASE DE DATOS
if (registrarVenta($conexion, $id_cliente, $total, $_SESSION['carrito'])) {
    
    // ¡Venta Exitosa! Destruimos el carrito para vaciarlo
    unset($_SESSION['carrito']);
    
    // Lo mandamos de vuelta a la pantalla de la caja (Le pasamos un "msg=exito" por si después queremos mostrar un cartelito)
    header("Location: ventasController.php?msg=exito");
    exit();
}
?>