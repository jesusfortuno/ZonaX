<?php
// categoria.php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia la sesión solo si no está activa
}

// Aquí no es necesario incluir connectaDb.php ni categoria_controller.php, ya que se hace en el controlador

// Aquí puedes incluir el diseño HTML común para todas las categorías
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos de la Categoría</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Estilos para la visualización de productos */
        .productos-container {
            padding: 2rem;
        }

        .producto-card {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            margin: 1rem;
            padding: 1rem;
            text-align: center;
        }

        .producto-card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
            background-color: #222;
            color: #fff;
        }
    </style>
</head>
<body>

<?php
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] === 'admin') {
        include __DIR__ . '/header_admin.php';
    } else {
        include __DIR__ . '/header_usuario.php';
    }
}
?>

<div class="productos-container">
    <h1>Productos de la Categoría</h1>
    <?php if (!empty($productos)): ?>
        <?php foreach ($productos as $producto): ?>
            <div class="producto-card">
                <a href="?action=producto&id=<?php echo htmlspecialchars($producto['id_producto']); ?>">
                    <?php if (!empty($producto['imagen'])): ?>
                        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                    <?php else: ?>
                        <img src="img/default.jpg" alt="Imagen no disponible">
                    <?php endif; ?>
                    <h2><?php echo htmlspecialchars($producto['nombre_producto']); ?></h2>
                    <p><?php echo htmlspecialchars($producto['descripción']); ?></p>
                    <p>Precio: <?php echo htmlspecialchars($producto['coste']); ?> €</p>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay productos disponibles en esta categoría.</p>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 ZonaX. Todos los derechos reservados.</p>
</footer>

</body>
</html> 