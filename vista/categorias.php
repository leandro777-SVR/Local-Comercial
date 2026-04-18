<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías - Minimarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4">📦 Gestión de Categorías</h2>
        
        <div class="mb-3">
            <a href="../vista/dashboard.php" class="btn btn-secondary">⬅ Volver al Inicio</a>
            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalNuevaCategoria">
    ➕ Agregar Nueva Categoría
</button>
            
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre de la Categoría</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($lista_categorias) > 0): ?>
                            <?php foreach ($lista_categorias as $cat): ?>
                                <tr>
                                    <td> <?php echo $cat['id_categoria']; ?> </td>
                                    <td> <?php echo htmlspecialchars($cat['nombre_categoria']); ?> </td>
                                    <td class="text-center">
                                        <a href="../controlador/editarCategoriaController.php?id=<?php echo $cat['id_categoria']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="../controlador/eliminarCategoriaController.php?id=<?php echo $cat['id_categoria']; ?>" 
       class="btn btn-danger btn-sm" 
       onclick="return confirm('¿Estás totalmente seguro de eliminar esta categoría?');">
       Eliminar
    </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center py-4">No hay categorías cargadas todavía.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
<div class="modal fade" id="modalNuevaCategoria" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Nueva Categoría</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="../controlador/guardarCategoriaController.php" method="POST">
              <div class="modal-body">
                <div class="mb-3">
                    <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
                    <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Ej: Fiambres" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>