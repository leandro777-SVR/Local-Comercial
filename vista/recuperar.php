<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary bg-opacity-25 d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 25rem;">
        <h4 class="text-center mb-4">🔑 Blanquear Clave</h4>
        
        <form action="../controlador/recuperarController.php" method="POST">
            <div class="mb-3">
                <label>Tu Usuario</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Nueva Contraseña</label>
                <input type="password" name="nueva_password" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="text-danger fw-bold">PIN de Autorización (Gerente)</label>
                <input type="password" name="pin_gerente" class="form-control border-danger" required>
            </div>
            
            <button type="submit" class="btn btn-warning w-100 fw-bold">Actualizar Contraseña</button>
        </form>
        <div class="text-center mt-3">
            <a href="../index.php" class="text-decoration-none text-muted">⬅ Volver al Login</a>
        </div>
    </div>
</body>
</html>