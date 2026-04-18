<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm border-warning">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">✏️ Editar Categoría</h4>
            </div>
            <div class="card-body">
                <form action="../controlador/editarCategoriaController.php" method="POST">
                    
                    <input type="hidden" name="id_categoria" value="<?php echo $categoria_actual['id_categoria']; ?>">
                    
                    <div class="mb-4">
                        <label class="form-label">Nombre de la Categoría</label>
                        <input type="text" class="form-control" name="nombre_categoria" value="<?php echo htmlspecialchars($categoria_actual['nombre_categoria']); ?>" required>
                    </div>

                    <a href="../controlador/categoriaController.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-warning float-end">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>