<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Punto de Venta - Minimarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>🛒 Punto de Venta</h2>
            <a href="../vista/dashboard.php" class="btn btn-outline-secondary">⬅ Volver al Inicio</a>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">1. Agregar Producto al Carrito</h5>
                    </div>
                    <div class="card-body">
                        <form action="../controlador/agregarCarritoController.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Buscar Producto</label>
                                <select class="form-select" name="id_producto" required>
                                    <option value="">Seleccione un producto...</option>
                                    <?php foreach ($lista_productos as $prod): ?>
                                        <option value="<?php echo $prod['id_productos']; ?>">
                                            <?php echo htmlspecialchars($prod['nombre']); ?> - $<?php echo $prod['precio_actual']; ?> (Stock: <?php echo $prod['stock_actual']; ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" value="1" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">➕ Agregar al Ticket</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">2. Detalle del Ticket</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Producto</th>
                                    <th>Cant.</th>
                                    <th>Precio U.</th>
                                    <th>Subtotal</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total_venta = 0;
                                if (count($_SESSION['carrito']) > 0): 
                                    foreach ($_SESSION['carrito'] as $indice => $item): 
                                        $subtotal = $item['cantidad'] * $item['precio'];
                                        $total_venta += $subtotal;
                                ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                                        <td><?php echo $item['cantidad']; ?></td>
                                        <td>$<?php echo number_format($item['precio'], 2, ',', '.'); ?></td>
                                        <td><b>$<?php echo number_format($subtotal, 2, ',', '.'); ?></b></td>
                                        <td>
                                            <a href="../controlador/quitarCarritoController.php?indice=<?php echo $indice; ?>" class="btn btn-sm btn-danger">❌</a>
                                        </td>
                                    </tr>
                                <?php 
                                    endforeach;
                                else: 
                                ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">El carrito está vacío. Agregá productos a la izquierda.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <td colspan="3" class="text-end h5 mb-0">TOTAL A COBRAR:</td>
                                    <td colspan="2" class="h5 mb-0 text-warning">$<?php echo number_format($total_venta, 2, ',', '.'); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="card-footer bg-white p-3">
                        <form action="../controlador/procesarVentaController.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label text-muted">Seleccionar Cliente (Opcional)</label>
                                <select class="form-select" name="id_cliente">
                                    <option value="">Consumidor Final (Sin registrar)</option>
                                    <?php foreach ($lista_clientes as $cli): ?>
                                        <option value="<?php echo $cli['id_clientes']; ?>">
                                            <?php echo htmlspecialchars($cli['nombre'] . ' ' . $cli['apellido']); ?> 
                                            (Saldo: $<?php echo $cli['saldo_deudora']; ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-lg w-100" <?php echo ($total_venta > 0) ? '' : 'disabled'; ?>>
                                💵 CONFIRMAR Y COBRAR
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>