<?php
// views/producto.php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia la sesión solo si no está activa
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Estilos para la visualización del detalle del producto */
        .producto-detalle {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .producto-imagen {
            flex: 1;
            min-width: 300px;
        }

        .producto-imagen img {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .producto-info {
            flex: 1;
            min-width: 300px;
        }

        .producto-titulo {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .producto-descripcion {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            color: #555;
        }

        .producto-precio {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e63946;
            margin-bottom: 2rem;
        }

        .btn-carrito {
            background-color: #2a9d8f;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 1rem;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-carrito:hover {
            background-color: #1d7d70;
        }

        .btn-volver {
            display: inline-block;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }

        .btn-volver:hover {
            text-decoration: underline;
        }

        .error-mensaje {
            color: #e63946;
            font-size: 1.2rem;
            text-align: center;
            margin: 2rem 0;
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

<div class="producto-detalle">
    <?php if (!empty($error)): ?>
        <div class="error-mensaje">
            <p><?php echo htmlspecialchars($error); ?></p>
            <a href="javascript:history.back()" class="btn-volver">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    <?php elseif (!empty($producto)): ?>
        <div class="producto-imagen">
            <?php if (!empty($producto['imagen'])): ?>
                <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
            <?php else: ?>
                <img src="img/default.jpg" alt="Imagen no disponible">
            <?php endif; ?>
        </div>
        <div class="producto-info">
            <h1 class="producto-titulo"><?php echo htmlspecialchars($producto['nombre_producto']); ?></h1>
            <p class="producto-descripcion"><?php echo htmlspecialchars($producto['descripción']); ?></p>
            <p class="producto-precio"><?php echo htmlspecialchars($producto['coste']); ?> €</p>
            
            <!-- Botón para añadir al carrito -->
            <!-- En views/producto.php, reemplazar el botón actual por un formulario -->
            <form action="index.php?action=carrito&op=add" method="post">
                <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto['id_producto']); ?>">
                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                <input type="hidden" name="precio" value="<?php echo htmlspecialchars($producto['coste']); ?>">
                <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
                <input type="number" name="cantidad" value="1" min="1" max="10" style="width: 60px; padding: 8px; margin-right: 10px;">
                <button type="submit" class="btn-carrito">
                    <i class="fas fa-shopping-cart"></i> Añadir al carrito
                </button>
            </form>
            
            <div>
                <a href="javascript:history.back()" class="btn-volver">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 ZonaX. Todos los derechos reservados.</p>
</footer>

</body>
</html>