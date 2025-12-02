<?php
// index.php (EN LA RAÍZ)
session_start();

// Si el usuario ya está logueado, redirigir directamente al dashboard
if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToolCraft | Ferretería Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="css/styles.css"> 
    
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="bi bi-hammer me-2"></i> ToolCraft
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#catalogo">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-principal ms-lg-3 px-3 py-1" href="login.php">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="display-3 fw-bolder mb-3">La Herramienta Perfecta para tu Proyecto.</h1>
                    <p class="lead mb-4">Descubre nuestro amplio inventario de materiales de construcción, herramientas eléctricas y manuales de la más alta calidad.</p>
                    <a href="#catalogo" class="btn btn-principal btn-lg shadow-lg me-3">
                        Ver Artículos <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-md-5 text-center d-flex align-items-center justify-content-center">
                    <i class="bi bi-tools" style="font-size: 8rem; color: #9c27b0;"></i> 
                </div>
            </div>
        </div>
    </header>

    <section class="container my-5 py-4" id="catalogo">
        <h2 class="text-center fw-bold mb-5 pb-2 text-dark">Categorías Destacadas</h2>
        
        <div class="row row-cols-1 row-cols-md-4 g-4 text-center">
            <div class="col">
                <div class="card h-100 border-0 shadow-sm p-3">
                    <i class="bi bi-drill feature-icon mb-3"></i>
                    <h5 class="fw-bold">Herramientas Eléctricas</h5>
                    <p class="text-muted">Potencia y precisión para profesionales.</p>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm p-3">
                    <i class="bi bi-plug feature-icon mb-3"></i>
                    <h5 class="fw-bold">Material Eléctrico</h5>
                    <p class="text-muted">Instalaciones seguras y certificadas.</p>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm p-3">
                    <i class="bi bi-water feature-icon mb-3"></i>
                    <h5 class="fw-bold">Plomería y Agua</h5>
                    <p class="text-muted">Soluciones de fontanería duraderas.</p>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm p-3">
                    <i class="bi bi-paint-bucket feature-icon mb-3"></i>
                    <h5 class="fw-bold">Pintura y Acabados</h5>
                    <p class="text-muted">La mejor calidad para todos tus espacios.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="container my-5 py-4" id="servicios">
        <h2 class="text-center fw-bold mb-5 pb-2 text-dark">Nuestros Servicios</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <i class="bi bi-truck feature-icon mb-3 text-success"></i>
                <h5 class="fw-bold">Entrega a Domicilio</h5>
                <p>Materiales pesados entregados directamente en tu obra.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-person-workspace feature-icon mb-3 text-info"></i>
                <h5 class="fw-bold">Asesoría Técnica</h5>
                <p>Expertos listos para ayudarte con tus proyectos complejos.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-wallet feature-icon mb-3 text-warning"></i>
                <h5 class="fw-bold">Múltiples Pagos</h5>
                <p>Aceptamos tarjetas de crédito, débito y transferencias.</p>
            </div>
        </div>
    </section>

    <footer class="footer-dark py-4" id="contacto">
        <div class="container text-center">
            <p class="mb-0">&copy; <?= date('Y') ?> ToolCraft Ferretería. | Dirección: Calle Falsa 123 | Teléfono: (555) 123-4567 | <a href="login.php" class="text-white-50">Acceso Admin</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>