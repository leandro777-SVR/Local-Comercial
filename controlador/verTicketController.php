<?php
session_start();
require_once '../config/conexion.php';
require_once '../modelo/ventasModelo.php';

$id = $_GET['id'];
$detalle = obtenerDetalleTicket($conexion, $id);
?>
<!DOCTYPE html>
<html lang="es">
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 500px;">
        <div class="card shadow">
            <div class="card-header bg-dark text-white text-center">
                <h5>Ticket #<?php echo $id; ?></h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php 
                    $total = 0;
                    foreach($detalle as $item): 
                        $sub = $item['cantidad'] * $item['precio_unitario_historico'];
                        $total += $sub;
                    ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <b><?php echo $item['nombre']; ?></b><br>
                                <small class="text-muted"><?php echo $item['cantidad']; ?> x $<?php echo $item['precio_unitario_historico']; ?></small>
                            </div>
                            <span>$<?php echo $sub; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card-footer text-end bg-white">
                <h4>Total: $<?php echo $total; ?></h4>
                <button onclick="window.history.back()" class="btn btn-primary w-100 mt-2">Volver al Historial</button>
            </div>
        </div>
    </div>
</body>
</html>