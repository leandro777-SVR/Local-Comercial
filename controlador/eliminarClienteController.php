<?php
session_start();
if (!isset($_SESSION['id_usuario'])) { header("Location: ../index.php"); exit(); }

require_once '../config/conexion.php';
require_once '../modelo/clienteModelo.php';

if (isset($_GET['id'])) {
    eliminarCliente($conexion, $_GET['id']);
}
header("Location: clienteController.php");
exit();
?>