<?php
// vista/dashboard.php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

// AGREGAMOS ESTO: Conectamos a la BD y buscamos el stock crítico UNIFICADO
require_once '../config/conexion.php';
$sql_alerta = "SELECT nombre, SUM(stock_actual) as stock_total 
               FROM productos 
               GROUP BY nombre 
               HAVING stock_total <= 5";
$stmt_alerta = $conexion->prepare($sql_alerta);
$stmt_alerta->execute();
$productos_criticos = $stmt_alerta->fetchAll();

// EL PATOVICA: Si el usuario no tiene una sesión activa, lo pateamos al Login
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal - Minimarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">🛒 Minimarket Oscar Flores</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">
                    👋 Hola, <b><?php echo htmlspecialchars($_SESSION['nombre']); ?></b> 
                    <span class="badge bg-secondary"><?php echo htmlspecialchars($_SESSION['rol']); ?></span>
                </span>
                <a href="../controlador/logoutController.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="container mt-5">
        
      <?php if (count($productos_criticos) > 0): ?>
            <div class="alert alert-warning alert-dismissible fade show shadow-sm border-warning text-start" role="alert">
                <h5 class="alert-heading">⚠️ Atención: Stock Crítico</h5>
                <p class="mb-1">Los siguientes productos tienen 5 o menos unidades y necesitan reposición:</p>
                <ul class="mb-0">
                    <?php foreach ($productos_criticos as $pc): ?>
                        <li><b><?php echo htmlspecialchars($pc['nombre']); ?></b> (Quedan: <?php echo $pc['stock_total']; ?>)</li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

    
                <div class="text-center mb-5">
            <h1 class="display-5">¡Bienvenido al Sistema!</h1>
            <p class="lead text-muted">Panel de control principal del Minimarket.</p>
        </div>

        <div class="row justify-content-center g-4 mb-5">
            
            <div class="col-md-4">
                <div class="card shadow border-primary h-100 text-center">
                    <div class="card-body d-flex flex-column">
                        <h1 class="display-4 mb-3">📦</h1>
                        <h4 class="card-title text-primary">Categorías</h4>
                        <p class="card-text text-muted mb-4">Administra los rubros y familias de tus productos.</p>
                        <a href="../controlador/categoriaController.php" class="btn btn-primary mt-auto w-100 fw-bold">Gestionar Categorías</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-success h-100 text-center">
                    <div class="card-body d-flex flex-column">
                        <h1 class="display-4 mb-3">🥫</h1>
                        <h4 class="card-title text-success">Productos</h4>
                        <p class="card-text text-muted mb-4">Controlá tu stock, precios y códigos de barras.</p>
                        <a href="../controlador/productoController.php" class="btn btn-success mt-auto w-100 fw-bold">Gestionar Productos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-info h-100 text-center">
                    <div class="card-body d-flex flex-column">
                        <h1 class="display-4 mb-3">👥</h1>
                        <h4 class="card-title text-info">Clientes</h4>
                        <p class="card-text text-muted mb-4">Manejá la agenda de tus clientes y sus cuentas corrientes.</p>
                        <a href="../controlador/clienteController.php" class="btn btn-info text-white mt-auto w-100 fw-bold">Gestionar Clientes</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-danger h-100 text-center">
                    <div class="card-body d-flex flex-column bg-danger bg-opacity-10">
                        <h1 class="display-4 mb-3">🛒</h1>
                        <h4 class="card-title text-danger">Nueva Venta</h4>
                        <p class="card-text text-muted mb-4">Abrí la caja registradora, armá el changuito y cobrá.</p>
                        <a href="../controlador/ventasController.php" class="btn btn-danger mt-auto w-100 fw-bold">Ir a la Caja</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-secondary h-100 text-center">
                    <div class="card-body d-flex flex-column bg-secondary bg-opacity-10">
                        <h1 class="display-4 mb-3">📊</h1>
                        <h4 class="card-title text-secondary">Reportes</h4>
                        <p class="card-text text-muted mb-4">Generá balances en PDF de tus ventas y recaudación.</p>
                        <a href="../vista/reportes.php" class="btn btn-secondary mt-auto w-100 fw-bold">Ver Reportes</a>
                    </div>
                </div>
            </div>

        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>