<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Minimarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9; /* Un gris muy clarito de fondo */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background-color: white;
        }
    </style>
</head>
<body>

    <div class="card shadow p-4" style="width: 25rem;">
        <div class="text-center mb-4">
            <h3>🛒 Sistema Minimarket</h3>
        </div>
        
        <form action="controlador/loginController.php" method="POST">
            <div class="mb-3">
                <label class="form-label text-muted">Nombre de Usuario</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-muted">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mt-2 fw-bold">Ingresar al Sistema</button>
        </form>

        <div class="mt-4 text-center border-top pt-3">
            <a href="vista/recuperar.php" class="text-secondary small text-decoration-none">¿Olvidaste tu contraseña?</a>
            <br>
            <a href="vista/registro.php" class="text-secondary small text-decoration-none mt-2 d-inline-block text-primary">➕ Registrar nuevo empleado</a>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>