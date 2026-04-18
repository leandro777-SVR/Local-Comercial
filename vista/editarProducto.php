<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5" style="max-width: 700px;">
        <div class="card shadow-sm border-warning">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">✏️ Editar Producto</h4>
            </div>
            <div class="card-body">
                <form action="../controlador/editarProductoController.php" method="POST">
                    <input type="hidden" name="id_productos" value="<?php echo $producto_actual['id_productos']; ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Código de Barras</label>
                            <input type="text" class="form-control" name="codigo_barras" value="<?php echo htmlspecialchars($producto_actual['codigo_barras']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($producto_actual['nombre']); ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock Actual</label>
                            <input type="number" class="form-control" name="stock_actual" value="<?php echo $producto_actual['stock_actual']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio ($)</label>
                            <input type="number" step="0.01" class="form-control" name="precio_actual" value="<?php echo $producto_actual['precio_actual']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" name="id_categoria" required>
                            <?php foreach ($lista_categorias as $cat): ?>
                                <option value="<?php echo $cat['id_categoria']; ?>" <?php echo ($cat['id_categoria'] == $producto_actual['id_categoria']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['nombre_categoria']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <a href="../controlador/productoController.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-warning float-end">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>