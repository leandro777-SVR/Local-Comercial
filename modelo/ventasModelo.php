<?php
// modelo/ventasModelo.php

function registrarVenta($conexion, $id_cliente, $total, $carrito) {
    try {
        // 1. INICIAMOS LA TRANSACCIÓN (Si algo falla más adelante, nada de esto se guarda)
        $conexion->beginTransaction();

        // 2. GUARDAR LA CABECERA (El Ticket general)
        $sql_venta = "INSERT INTO ventas (fecha_hora, total, estado_pago, id_clientes) 
                      VALUES (NOW(), :total, 'Pagado', :id_cliente)";
        $stmt_venta = $conexion->prepare($sql_venta);
        $stmt_venta->bindParam(':total', $total);
        
        // Si no eligió cliente (Consumidor Final), guardamos NULL
        $id_cliente_final = !empty($id_cliente) ? $id_cliente : null;
        $stmt_venta->bindParam(':id_cliente', $id_cliente_final, PDO::PARAM_INT);
        $stmt_venta->execute();

        // ATRAPAMOS EL ID DEL TICKET QUE SE ACABA DE CREAR (Lo necesitamos para el detalle)
        $id_venta = $conexion->lastInsertId();

        // 3. RECORRER EL CHANGUITO, GUARDAR EL DETALLE Y DESCONTAR STOCK
        foreach ($carrito as $item) {
            
            // A) Guardamos el renglón en detalle_venta
            $sql_detalle = "INSERT INTO detalle_venta (id_ventas, id_productos, cantidad, precio_unitario_historico) 
                            VALUES (:id_venta, :id_producto, :cantidad, :precio)";
            $stmt_detalle = $conexion->prepare($sql_detalle);
            $stmt_detalle->bindParam(':id_venta', $id_venta);
            $stmt_detalle->bindParam(':id_producto', $item['id_producto']);
            $stmt_detalle->bindParam(':cantidad', $item['cantidad']);
            $stmt_detalle->bindParam(':precio', $item['precio']);
            $stmt_detalle->execute();

            // B) Descontamos el stock del producto vendido
            $sql_stock = "UPDATE productos SET stock_actual = stock_actual - :cantidad WHERE id_productos = :id_producto";
            $stmt_stock = $conexion->prepare($sql_stock);
            $stmt_stock->bindParam(':cantidad', $item['cantidad']);
            $stmt_stock->bindParam(':id_producto', $item['id_producto']);
            $stmt_stock->execute();
        }

        // 4. SI LLEGAMOS HASTA ACÁ SIN ERRORES, CONFIRMAMOS LA TRANSACCIÓN (Se guarda todo definitivamente)
        $conexion->commit();
        return true;

    } catch (PDOException $e) {
        // Si explotó algo, damos marcha atrás (Rollback) para no arruinar la BD
        $conexion->rollBack();
        die("Error crítico al procesar la venta: " . $e->getMessage());
    }
}
// Traer todas las ventas
function obtenerHistorialVentas($conexion) {
    $sql = "SELECT v.*, c.nombre, c.apellido FROM ventas v LEFT JOIN clientes c ON v.id_clientes = c.id_clientes ORDER BY v.fecha_hora DESC";
    $stmt = $conexion->query($sql);
    return $stmt->fetchAll();
}

// Traer los renglones (productos) de un ticket específico
function obtenerDetalleTicket($conexion, $id_venta) {
    $sql = "SELECT d.*, p.nombre FROM detalle_venta d JOIN productos p ON d.id_productos = p.id_productos WHERE d.id_ventas = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id_venta);
    $stmt->execute();
    return $stmt->fetchAll();
}
?>