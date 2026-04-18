<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h2>🧾 Historial de Tickets</h2>
            <a href="dashboard.php" class="btn btn-secondary">⬅ Volver</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Nº Ticket</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista_ventas as $v): ?>
                            <tr>
                                <td>#<?php echo $v['id_ventas']; ?></td>
                                <td><?php echo $v['fecha_hora']; ?></td>
                                <td><?php echo $v['nombre'] ? $v['nombre'].' '.$v['apellido'] : 'Consumidor Final'; ?></td>
                                <td><b>$<?php echo number_format($v['total'], 2, ',', '.'); ?></b></td>
                                <td>
                                    <a href="../controlador/verTicketController.php?id=<?php echo $v['id_ventas']; ?>" class="btn btn-info btn-sm text-white">👀 Ver Productos</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>