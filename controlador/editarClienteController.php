<?php
session_start();
if (!isset($_SESSION['id_usuario'])) { header("Location: ../index.php"); exit(); }

require_once '../config/conexion.php';
require_once '../modelo/clienteModelo.php';

// Si apretaron "Guardar Cambios"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_clientes'];
    $dni = !empty($_POST['dni']) ? trim($_POST['dni']) : null;
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $telefono = trim($_POST['telefono']);
    $saldo = !empty($_POST['saldo_deudora']) ? $_POST['saldo_deudora'] : 0;

    actualizarCliente($conexion, $id, $dni, $nombre, $apellido, $telefono, $saldo);
    header("Location: clienteController.php");
    exit();
}

// Si apretaron el botón amarillo de la tabla
if (isset($_GET['id'])) {
    $cliente_actual = obtenerClientePorId($conexion, $_GET['id']);
    if (!$cliente_actual) { header("Location: clienteController.php"); exit(); }
    require_once '../vista/editarCliente.php';
} else {
    header("Location: clienteController.php");
    exit();
}
?>