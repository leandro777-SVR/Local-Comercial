<?php
session_start();
if (!isset($_SESSION['id_usuario'])) { header("Location: ../index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes - Minimarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5" style="max-width: 800px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>📊 Centro de Reportes PDF</h2>
            <a href="dashboard.php" class="btn btn-outline-secondary">⬅ Volver al Inicio</a>
        </div>

        <div class="card shadow-sm border-secondary">
            <div class="card-body p-4 text-center">
                <p class="text-muted mb-4">Seleccioná el período del cual querés emitir el reporte de ventas. Se descargará automáticamente un documento PDF con el detalle y los totales.</p>
                
                <div class="d-grid gap-3 col-md-8 mx-auto">
                    <a href="../controlador/generarPdfController.php?tipo=semanal" target="_blank" class="btn btn-outline-primary btn-lg d-flex justify-content-between align-items-center">
                        <span>📅 Reporte de los últimos 7 días</span>
                        <span>📄 PDF</span>
                    </a>
                    
                    <a href="../controlador/generarPdfController.php?tipo=mensual" target="_blank" class="btn btn-outline-success btn-lg d-flex justify-content-between align-items-center">
                        <span>📆 Reporte del Mes Actual</span>
                        <span>📄 PDF</span>
                    </a>
                    
                    <a href="../controlador/generarPdfController.php?tipo=anual" target="_blank" class="btn btn-outline-danger btn-lg d-flex justify-content-between align-items-center">
                        <span>🗓️ Reporte del Año Actual</span>
                        <span>📄 PDF</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

</body>
</html>