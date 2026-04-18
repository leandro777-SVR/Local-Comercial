<?php
// controlador/editarCategoriaController.php
session_start();

// Seguridad
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/conexion.php';
require_once '../modelo/categoriaModelo.php';

// CASO 1: Cuando aprietan "Guardar Cambios" (Llega por POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_categoria'];
    $nombre_nuevo = trim($_POST['nombre_categoria']);

    if (!empty($nombre_nuevo)) {
        actualizarCategoria($conexion, $id, $nombre_nuevo);
    }
    // Lo devolvemos a la tabla
    header("Location: categoriaController.php");
    exit();
}

// CASO 2: Cuando hacen clic en el botón amarillo "Editar" (Llega por GET)
if (isset($_GET['id'])) {
    $id_editar = $_GET['id'];
    $categoria_actual = obtenerCategoriaPorId($conexion, $id_editar);

    // Si la categoría no existe, lo devolvemos a la tabla
    if (!$categoria_actual) {
        header("Location: categoriaController.php");
        exit();
    }

    // Si todo está bien, le mostramos la pantalla de edición
    require_once '../vista/editarCategoria.php';
} else {
    header("Location: categoriaController.php");
    exit();
}
?>