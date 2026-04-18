<?php
session_start();
if (!isset($_SESSION['id_usuario'])) { header("Location: ../index.php"); exit(); }

require_once '../config/conexion.php';
require_once '../modelo/ventasModelo.php';

$lista_ventas = obtenerHistorialVentas($conexion);

require_once '../vista/historial.php';
?>