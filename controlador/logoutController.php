<?php
// controlador/logoutController.php
session_start();

// Vaciamos y destruimos todas las variables de sesión
session_unset();
session_destroy();

// Lo mandamos de vuelta a la pantalla de login
header("Location: ../index.php");
exit();
?>