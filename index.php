<!--localhost/proyecto_01/ PARA INICIAR PAGINA  -->
<?php

// index.php (El Controlador Principal)

// 1. Traemos la conexión a la base de datos (por si la necesitamos)
require_once 'config/conexion.php';

// 2. Por ahora, como es la puerta de entrada, cargamos directamente la vista del Login
require_once 'vista/login.php';


?>
