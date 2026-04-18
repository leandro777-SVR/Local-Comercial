<?php
require_once '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];
    $pin_gerente = $_POST['pin_gerente'];

    // EL PIN SECRETO PARA CREAR USUARIOS (Podés cambiarlo por el que quieras)
    $pin_correcto = "1010"; 

    if ($pin_gerente === $pin_correcto) {
        // Encriptamos la contraseña para mantener la seguridad
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Guardamos el nuevo empleado en la base de datos
        // (Ajustá los nombres de las columnas 'usuario' y 'password' si en tu BD se llaman distinto)
        $sql = "INSERT INTO usuarios (usuario, password) VALUES (:usuario, :password)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':password', $password_hash);
        
        if ($stmt->execute()) {
            echo "<script>alert('¡Empleado registrado con éxito!'); window.location='../index.php';</script>";
        } else {
            echo "<script>alert('Error al registrar.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('❌ PIN de Gerente incorrecto. Operación cancelada.'); window.history.back();</script>";
    }
}
?>