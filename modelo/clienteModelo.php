<?php
// modelo/clienteModelo.php

function obtenerClientes($conexion) {
    try {
        $sql = "SELECT * FROM clientes";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(); 
    } catch (PDOException $e) {
        die("Error al consultar clientes: " . $e->getMessage());
    }
}

// NUEVA FUNCIÓN PARA GUARDAR CLIENTES (Con DNI)
function agregarCliente($conexion, $dni, $nombre, $apellido, $telefono, $saldo_deudora) {
    try {
        $sql = "INSERT INTO clientes (dni, nombre, apellido, telefono, saldo_deudora) 
                VALUES (:dni, :nombre, :apellido, :telefono, :saldo_deudora)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':saldo_deudora', $saldo_deudora);
        return $stmt->execute();
    } catch (PDOException $e) {
        die("Error al guardar cliente: " . $e->getMessage());
    }
}
// Función para ELIMINAR un cliente
function eliminarCliente($conexion, $id) {
    try {
        $sql = "DELETE FROM clientes WHERE id_clientes = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

// Función para BUSCAR un solo cliente (para el formulario de editar)
function obtenerClientePorId($conexion, $id) {
    $sql = "SELECT * FROM clientes WHERE id_clientes = :id LIMIT 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

// Función para GUARDAR LOS CAMBIOS de la edición
function actualizarCliente($conexion, $id, $dni, $nombre, $apellido, $telefono, $saldo_deudora) {
    try {
        $sql = "UPDATE clientes SET dni = :dni, nombre = :nombre, apellido = :apellido, telefono = :telefono, saldo_deudora = :saldo_deudora WHERE id_clientes = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':saldo_deudora', $saldo_deudora);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        die("Error al actualizar: " . $e->getMessage());
    }
}
// Dejar el saldo del cliente en cero
function saldarDeuda($conexion, $id) {
    try {
        $sql = "UPDATE clientes SET saldo_deudora = 0 WHERE id_clientes = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}
?>