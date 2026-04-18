<?php
// modelo/categoriaModelo.php

function obtenerCategorias($conexion) {
    try {
        // Pedimos TODO lo que haya en la tabla categoria
        $sql = "SELECT * FROM categoria";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        
        // fetchAll() agarra todas las filas y las convierte en un array (lista) de PHP
        return $stmt->fetchAll(); 
    } catch (PDOException $e) {
        die("Error al consultar categorías: " . $e->getMessage());
    }
}

// modelo/categoriaModelo.php

// (Acá arriba está tu función obtenerCategorias que ya tenías)

// NUEVA FUNCIÓN PARA GUARDAR
function agregarCategoria($conexion, $nombre) {
    try {
        $sql = "INSERT INTO categoria (nombre_categoria) VALUES (:nombre)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        return $stmt->execute();
    } catch (PDOException $e) {
        die("Error al guardar la categoría: " . $e->getMessage());
    }
}

// NUEVA FUNCIÓN PARA ELIMINAR
function eliminarCategoria($conexion, $id) {
    try {
        $sql = "DELETE FROM categoria WHERE id_categoria = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        // Si a futuro intentamos borrar una categoría que ya tiene productos adentro, 
        // MySQL nos va a frenar por la Clave Foránea. Por ahora devolvemos falso.
        return false; 
    }
}

// Buscar los datos de UNA sola categoría
function obtenerCategoriaPorId($conexion, $id) {
    $sql = "SELECT * FROM categoria WHERE id_categoria = :id LIMIT 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

// Guardar el nuevo nombre modificado
function actualizarCategoria($conexion, $id, $nombre) {
    try {
        $sql = "UPDATE categoria SET nombre_categoria = :nombre WHERE id_categoria = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}
?>