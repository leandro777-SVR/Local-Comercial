<?php
// controlador/clienteController.php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/clienteModelo.php';

// Le pedimos al modelo que traiga la agenda
$lista_clientes = obtenerClientes($conexion);

// Se lo mandamos a la vista
require_once '../vista/clientes.php';
?>