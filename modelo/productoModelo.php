<?php
// modelo/productoModelo.php

function obtenerProductos($conexion) {
    try {
        // Pedimos los productos, pero los "unimos" (JOIN) con la tabla categoría 
        // para poder mostrar el nombre del rubro en vez de solo un número.
        $sql = "SELECT p.*, c.nombre_categoria 
                FROM productos p
                INNER JOIN categoria c ON p.id_categoria = c.id_categoria";
                
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(); 
    } catch (PDOException $e) {
        die("Error al consultar productos: " . $e->getMessage());
    }
}

// NUEVA FUNCIÓN PARA GUARDAR PRODUCTOS
function agregarProducto($conexion, $codigo, $nombre, $stock, $precio, $id_categoria) {
    try {
        $sql = "INSERT INTO productos (codigo_barras, nombre, stock_actual, precio_actual, id_categoria) 
                VALUES (:codigo, :nombre, :stock, :precio, :id_categoria)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':id_categoria', $id_categoria);
        return $stmt->execute();
    } catch (PDOException $e) {
        die("Error al guardar producto: " . $e->getMessage());
    }
}

// Función para eliminar un producto
function eliminarProducto($conexion, $id) {
    try {
        $sql = "DELETE FROM productos WHERE id_productos = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false; 
    }
}

// Buscar los datos de UN solo producto para rellenar el formulario
function obtenerProductoPorId($conexion, $id) {
    $sql = "SELECT * FROM productos WHERE id_productos = :id LIMIT 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

// Guardar los cambios editados
function actualizarProducto($conexion, $id, $codigo, $nombre, $stock, $precio, $id_categoria) {
    try {
        $sql = "UPDATE productos SET codigo_barras = :codigo, nombre = :nombre, stock_actual = :stock, precio_actual = :precio, id_categoria = :id_categoria WHERE id_productos = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        die("Error al actualizar: " . $e->getMessage());
    }
}
?>