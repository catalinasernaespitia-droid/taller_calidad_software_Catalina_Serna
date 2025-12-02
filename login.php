<?php
// login.php (EN LA RAÍZ)
session_start();
include 'db_conexion.php'; 

if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];

    if (empty($usuario) || empty($password)) {
        $error_message = "Por favor, ingrese el usuario y la contraseña.";
    } else {
        
        $stmt = $conn->prepare("SELECT id, usuario, password FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_data = $result->fetch_assoc();
        $stmt->close();
        
        // La clave del éxito: password_verify
        if ($user_data && password_verify($password, $user_data['password'])) {
            
            $_SESSION['usuario_id'] = $user_data['id'];
            $_SESSION['usuario_nombre'] = $user_data['usuario'];
            
            close_db_connection($conn);
            header("Location: dashboard.php");
            exit;
        } else {
            $error_message = "Credenciales incorrectas. Verifique su usuario y contraseña.";
        }
    }
}

close_db_connection($conn); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Admin - ToolCraft</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css"> 
    <style>
        .login-container { display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #553480; }
        .login-card { width: 100%; max-width: 400px; padding: 30px; background: white; border-radius: 8px; }
        .btn-principal { background-color: #553480; color: white; border: none; }
        .btn-principal:hover { background-color: #4a2a6a; }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card shadow-lg">
        <div class="text-center mb-4">
            <i class="bi bi-tools" style="font-size: 3rem; color: #553480;"></i>
            <h2 class="fw-bold mt-2 text-dark">Acceso al Dashboard</h2>
        </div>

        <?php if ($error_message): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn btn-principal w-100 btn-lg mb-3">
                <i class="bi bi-lock-fill me-1"></i> Ingresar
            </button>
        </form>
    </div>
</div>
</body>
</html>