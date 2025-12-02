<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$view = $_GET['view'] ?? 'inicio';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ToolCraft Ferretería</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS LOCAL -->
    <link rel="stylesheet" href="css/dashboard.css?v=10">
    <link rel="stylesheet" href="css/styles.css?v=10">

</head>
<body>

    <div class="d-flex">

        <!-- ==========================
             SIDEBAR
        =========================== -->
        <div id="sidebar">
            <h4 class="text-center mb-4"><i class="bi bi-tools me-2"></i> ToolCraft Admin</h4>

            <div class="mb-3 text-center small">
                Bienvenido:<br>
                <b><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></b>
            </div>

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link <?= ($view == 'inicio') ? 'active' : '' ?>" 
                    href="dashboard.php?view=inicio">
                        <i class="bi bi-house-door-fill me-2"></i> Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($view == 'articulos') ? 'active' : '' ?>" 
                    href="dashboard.php?view=articulos">
                        <i class="bi bi-box-seam me-2"></i> Artículos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($view == 'categorias') ? 'active' : '' ?>" 
                    href="dashboard.php?view=categorias">
                        <i class="bi bi-tags-fill me-2"></i> Categorías
                    </a>
                </li>

                <hr class="text-white-50">

                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">
                        <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>

        <!-- ==========================
             CONTENIDO PRINCIPAL
        =========================== -->
        <div id="main-content" class="flex-grow-1">

            <header class="dashboard-header">
                <h1 class="display-6">Panel Administrativo</h1>
            </header>

            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET['msg']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>


            <!-- ROUTER -->
            <?php
                if ($view == 'inicio') {
                    include "inicio.php";
                } elseif ($view == 'articulos') {
                    include "articulos.php";
                } elseif ($view == 'categorias') {
                    include "categorias.php";
                } else {
                    echo "<div class='alert alert-warning'>Vista no encontrada.</div>";
                }
            ?>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
