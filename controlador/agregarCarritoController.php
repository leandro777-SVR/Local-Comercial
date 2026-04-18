<?php
// controlador/agregarCarritoController.php
session_start();

if (!isset($_SESSION['id_usuario']) || $_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/productoModelo.php';

// Atrapamos lo que el usuario eligió en el formulario
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];

if (!empty($id_producto) && $cantidad > 0) {
    // Buscamos el producto en la BD para saber su precio y stock REAL en este instante
    $producto = obtenerProductoPorId($conexion, $id_producto);

    if ($producto) {
        // Validamos que haya stock suficiente
        if ($cantidad <= $producto['stock_actual']) {
            
            // Armamos el "renglón" del ticket
            $item = [
                'id_producto' => $producto['id_productos'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio_actual'],
                'cantidad' => $cantidad
            ];

            // Lo guardamos en la memoria de la sesión (El changuito)
            $_SESSION['carrito'][] = $item;

        } else {
            // Acá a futuro podés mostrar un mensaje de "Stock insuficiente"
            // Por ahora, simplemente no lo agrega.
        }
    }
}

// Lo devolvemos a la pantalla de la caja
header("Location: ventasController.php");
exit();
?>