<?php
// controlador/categoriaController.php

// 1. Seguridad: comprobamos que esté logueado
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

// 2. Traemos la conexión y el modelo (las herramientas que necesitamos)
require_once '../config/conexion.php';
require_once '../modelo/categoriaModelo.php';

// 3. Ejecutamos la función del modelo. Ahora la variable $lista_categorias tiene todos los datos.
$lista_categorias = obtenerCategorias($conexion);

// 4. Cargamos la vista (el HTML) para que use esa lista y la dibuje en pantalla
require_once '../vista/categorias.php';
?>