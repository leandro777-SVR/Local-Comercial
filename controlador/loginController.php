<?php
// controlador/loginController.php

// 1. Iniciamos la sesión (fundamental para mantener al usuario logueado)
session_start();

// 2. Traemos la conexión a la base de datos (ojo con la ruta de los ../ para salir de la carpeta)
require_once '../config/conexion.php';

// 3. Verificamos si los datos llegaron por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Capturamos lo que el usuario escribió en el formulario
    $usuario_ingresado = $_POST['usuario'];
    $password_ingresada = $_POST['password'];

    try {
        // 4. Buscamos al usuario en la base de datos
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :usuario LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':usuario', $usuario_ingresado);
        $stmt->execute();

        $usuario_db = $stmt->fetch();

        // 5. Verificamos si el usuario existe y si la contraseña coincide con el Hash
        if ($usuario_db && password_verify($password_ingresada, $usuario_db['password'])) {
            
            // ¡LOGIN EXITOSO! Guardamos sus datos en la sesión
            $_SESSION['id_usuario'] = $usuario_db['id_usuarios'];
            $_SESSION['nombre'] = $usuario_db['nombre_usuario'];
            $_SESSION['rol'] = $usuario_db['rol'];

            // Lo redirigimos a la pantalla principal (que crearemos después)
            header("Location: ../vista/dashboard.php");
            exit();

        } else {
            // ¡ERROR! Credenciales incorrectas
            echo "<script>
                    alert('Usuario o contraseña incorrectos');
                    window.location.href = '../index.php';
                  </script>";
        }

    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
} else {
    // Si alguien intenta entrar a este archivo directamente por la URL, lo pateamos al inicio
    header("Location: ../index.php");
    exit();
}
?>