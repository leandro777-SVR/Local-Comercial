<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes - Minimarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4">👥 Agenda de Clientes y Deudores</h2>
        
        <div class="mb-3">
            <a href="../vista/dashboard.php" class="btn btn-secondary">⬅ Volver al Inicio</a>
            <button type="button" class="btn btn-info text-white float-end" data-bs-toggle="modal" data-bs-target="#modalNuevoCliente">
                ➕ Agregar Nuevo Cliente
            </button>
        </div>

        <div class="card shadow-sm border-info">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Teléfono</th>
                            <th>Saldo Deudor</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($lista_clientes) > 0): ?>
                            <?php foreach ($lista_clientes as $cli): ?>
                                <tr>
                                    <td> <?php echo htmlspecialchars($cli['dni'] ?? ''); ?> </td>
<td> <b><?php echo htmlspecialchars($cli['nombre'] ?? ''); ?></b> </td>
<td> <?php echo htmlspecialchars($cli['apellido'] ?? ''); ?> </td>
<td> <?php echo htmlspecialchars($cli['telefono'] ?? ''); ?> </td>
<td class="<?php echo ($cli['saldo_deudora'] > 0) ? 'text-danger fw-bold' : 'text-success'; ?>"> 
    $<?php echo number_format($cli['saldo_deudora'], 2, ',', '.'); ?> 
</td>
<td class="text-center">
    <?php if ($cli['saldo_deudora'] > 0): ?>
        <a href="../controlador/saldarDeudaController.php?id=<?php echo $cli['id_clientes']; ?>" 
           class="btn btn-success btn-sm me-1" 
           onclick="return confirm('¿Confirmás que el cliente pagó toda su deuda?');">💰 Saldar</a>
    <?php endif; ?>

    <a href="../controlador/editarClienteController.php?id=<?php echo $cli['id_clientes']; ?>" class="btn btn-warning btn-sm">Editar</a>
    <a href="../controlador/eliminarClienteController.php?id=<?php echo $cli['id_clientes']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que querés borrar este cliente?');">Borrar</a>
</td>

                                    
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Todavía no tenés clientes registrados en el sistema.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNuevoCliente" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title">Cargar Nuevo Cliente</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="../controlador/guardarClienteController.php" method="POST">
              <div class="modal-body">
                
                <div class="mb-3">
                    <label class="form-label">DNI</label>
                    <input type="number" class="form-control" name="dni" placeholder="Sin puntos" (Opcional)>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ej: Leandro" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="apellido" placeholder="Ej: Flores" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Saldo Deudor Inicial ($)</label>
                        <input type="number" step="0.01" class="form-control" name="saldo_deudora" value="0">
                    </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-info text-white">Guardar Cliente</button>
              </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>