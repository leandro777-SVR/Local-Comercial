<?php
require_once '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $nueva_password = $_POST['nueva_password'];
    $pin_gerente = $_POST['pin_gerente'];

    $pin_correcto = "1010"; 

    if ($pin_gerente === $pin_correcto) {
        $password_hash = password_hash($nueva_password, PASSWORD_DEFAULT);

        // Actualizamos la clave del usuario que lo solicitó
        $sql = "UPDATE usuarios SET password = :password WHERE usuario = :usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        
        // Verificamos si realmente se modificó alguna fila (por si escribieron mal el usuario)
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('¡Contraseña actualizada! Ya podés ingresar.'); window.location='../index.php';</script>";
        } else {
            echo "<script>alert('No se encontró ese nombre de usuario en el sistema.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('❌ PIN de Gerente incorrecto. Operación cancelada.'); window.history.back();</script>";
    }
}
?>