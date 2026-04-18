<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm border-warning">
            <div class="card-header bg-warning text-dark"><h4 class="mb-0">✏️ Editar Cliente</h4></div>
            <div class="card-body">
                <form action="../controlador/editarClienteController.php" method="POST">
                    <input type="hidden" name="id_clientes" value="<?php echo $cliente_actual['id_clientes']; ?>">
                    
                    <div class="mb-3">
                        <label>DNI</label>
                        <input type="number" class="form-control" name="dni" value="<?php echo htmlspecialchars($cliente_actual['dni'] ?? ''); ?>" (Opcional)>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($cliente_actual['nombre']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Apellido</label>
                            <input type="text" class="form-control" name="apellido" value="<?php echo htmlspecialchars($cliente_actual['apellido'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Teléfono</label>
                            <input type="text" class="form-control" name="telefono" value="<?php echo htmlspecialchars($cliente_actual['telefono'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Saldo Deudor ($)</label>
                            <input type="number" step="0.01" class="form-control" name="saldo_deudora" value="<?php echo $cliente_actual['saldo_deudora']; ?>">
                        </div>
                    </div>
                    <a href="../controlador/clienteController.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-warning float-end">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>