<?php
// controlador/guardarClienteController.php
session_start();

if (!isset($_SESSION['id_usuario']) || $_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/clienteModelo.php';

// Atrapamos los datos. Si el DNI viene vacío, le asignamos NULL
$dni = !empty($_POST['dni']) ? trim($_POST['dni']) : null;
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$telefono = trim($_POST['telefono']);
$saldo_deudora = !empty($_POST['saldo_deudora']) ? $_POST['saldo_deudora'] : 0;

if (!empty($nombre)) {
    agregarCliente($conexion, $dni, $nombre, $apellido, $telefono, $saldo_deudora);
}

header("Location: clienteController.php");
exit();
?>