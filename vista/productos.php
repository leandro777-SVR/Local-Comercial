<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos - Minimarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4">🥫 Inventario de Productos</h2>
        
        <div class="mb-3">
            <a href="../vista/dashboard.php" class="btn btn-secondary">⬅ Volver al Inicio</a>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalNuevoProducto">
                ➕ Cargar Nuevo Producto
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Categoría</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($lista_productos) > 0): ?>
                            <?php foreach ($lista_productos as $prod): ?>
                                <tr>
                                    <td> <?php echo htmlspecialchars($prod['codigo_barras']); ?> </td>
                                    <td> <b><?php echo htmlspecialchars($prod['nombre']); ?></b> </td>
                                    <td> <?php echo $prod['stock_actual']; ?> unid. </td>
                                    <td> $<?php echo number_format($prod['precio_actual'], 2, ',', '.'); ?> </td>
                                    <td> <span class="badge bg-info text-dark"><?php echo htmlspecialchars($prod['nombre_categoria']); ?></span> </td>
                                    <td class="text-center">
                                        <a href="../controlador/editarProductoController.php?id=<?php echo $prod['id_productos']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        
                                        <a href="../controlador/eliminarProductoController.php?id=<?php echo $prod['id_productos']; ?>" 
                                           class="btn btn-danger btn-sm" 
                                           onclick="return confirm('¿Estás totalmente seguro de eliminar este producto del inventario?');">
                                           Borrar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    El inventario está vacío. Empezá a cargar tus primeros productos.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNuevoProducto" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Cargar Nuevo Producto</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="../controlador/guardarProductoController.php" method="POST">
              <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Código de Barras</label>
                        <input type="text" class="form-control" name="codigo_barras" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ej: Coca-Cola 2L" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock Actual</label>
                        <input type="number" class="form-control" name="stock_actual" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Precio ($)</label>
                        <input type="number" step="0.01" class="form-control" name="precio_actual" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoría</label>
                    <select class="form-select" name="id_categoria" required>
                        <option value="">Seleccione una categoría...</option>
                        <?php foreach ($lista_categorias as $cat): ?>
                            <option value="<?php echo $cat['id_categoria']; ?>">
                                <?php echo htmlspecialchars($cat['nombre_categoria']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Producto</button>
              </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>