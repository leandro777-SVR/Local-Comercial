<?php
// controlador/quitarCarritoController.php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Atrapamos qué número de renglón quiere borrar (0, 1, 2...)
if (isset($_GET['indice'])) {
    $indice = $_GET['indice'];
    
    // Lo borramos de la memoria
    unset($_SESSION['carrito'][$indice]);
    
    // Reordenamos la lista para que no queden espacios vacíos en la memoria
    $_SESSION['carrito'] = array_values($_SESSION['carrito']);
}

// Volvemos a la pantalla de la caja
header("Location: ventasController.php");
exit();
?>