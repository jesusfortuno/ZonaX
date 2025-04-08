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
        /* Definición de variables de color */
        :root {
            --color-rosa: #FF69B4;
            --color-naranja: #FFA500;
            --color-amarillo: #FFD700;
            --color-blanco: #FFFFFF;
            --color-rosa-claro: #FFB6C1;
            --color-naranja-claro: #FFD580;
            --color-gris-claro: #f5f5f5;
            --color-gris: #e0e0e0;
            --color-texto: #333333;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--color-gris-claro);
            color: var(--color-texto);
        }

        /* Estilos para la visualización del detalle del producto */
        .producto-detalle {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 2.5rem;
            background: var(--color-blanco);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .producto-imagen {
            flex: 1;
            min-width: 300px;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        .producto-imagen img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.4s ease;
            object-fit: cover;
        }

        .producto-imagen:hover img {
            transform: scale(1.03);
        }

        .producto-info {
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-direction: column;
        }

        .producto-titulo {
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            color: var(--color-naranja);
            font-weight: 700;
            line-height: 1.2;
        }

        .producto-descripcion {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            color: var(--color-texto);
            background: var(--color-gris-claro);
            padding: 1.5rem;
            border-radius: 8px;
        }

        .producto-precio {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--color-blanco);
            margin-bottom: 2rem;
            background: var(--color-naranja);
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            display: inline-block;
            align-self: flex-start;
        }

        .cantidad-input {
            width: 80px;
            padding: 12px;
            margin-right: 15px;
            border: 1px solid var(--color-gris);
            border-radius: 6px;
            font-size: 1.1rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .cantidad-input:focus {
            outline: none;
            border-color: var(--color-rosa);
            box-shadow: 0 0 0 2px rgba(255, 105, 180, 0.2);
        }

        .btn-carrito {
            background: var(--color-rosa);
            color: var(--color-blanco);
            border: none;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-carrito:hover {
            background: #e05a9d;
            transform: translateY(-2px);
        }

        .btn-carrito:active {
            transform: translateY(1px);
        }

        .btn-volver {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 25px;
            color: var(--color-rosa);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            padding: 10px 0;
        }

        .btn-volver:hover {
            color: #e05a9d;
            transform: translateX(-3px);
        }

        .error-mensaje {
            color: var(--color-rosa);
            font-size: 1.3rem;
            text-align: center;
            margin: 3rem auto;
            padding: 2rem;
            background: var(--color-blanco);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            max-width: 800px;
        }

        .error-mensaje .btn-volver {
            margin-top: 1.5rem;
            display: inline-flex;
            justify-content: center;
        }

        .form-carrito {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 10px;
        }

        footer {
            text-align: center;
            padding: 1.5rem 0;
            background-color: #ff6b6b;
            color: white;
            font-size: 0.9rem;
            margin-top: 3rem;
        }

        footer p {
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .producto-detalle {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            .producto-titulo {
                font-size: 1.8rem;
            }
            
            .producto-precio {
                font-size: 1.6rem;
            }
            
            .btn-carrito {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .form-carrito {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .cantidad-input {
                margin-bottom: 10px;
                width: 100%;
                max-width: 100px;
            }
            
            .btn-carrito {
                width: 100%;
                justify-content: center;
            }
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

<div class="container">
    <?php if (!empty($error)): ?>
        <div class="error-mensaje">
            <p><?php echo htmlspecialchars($error); ?></p>
            <a href="javascript:history.back()" class="btn-volver">
                <i class="fas fa-arrow-left"></i> Volver a la página anterior
            </a>
        </div>
    <?php elseif (!empty($producto)): ?>
        <div class="producto-detalle">
            <div class="producto-imagen">
                <?php if (!empty($producto['imagen'])): ?>
                    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                <?php else: ?>
                    <img src="img/default.jpg" alt="Imagen no disponible">
                <?php endif; ?>
            </div>
            <div class="producto-info">
                <h1 class="producto-titulo"><?php echo htmlspecialchars($producto['nombre_producto']); ?></h1>
                <div class="producto-descripcion">
                    <?php echo htmlspecialchars($producto['descripción']); ?>
                </div>
                <p class="producto-precio"><?php echo number_format($producto['coste'], 2); ?> €</p>
                
                <!-- Botón para añadir al carrito -->
                <form action="index.php?action=carrito&op=add" method="post" class="form-carrito">
                    <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto['id_producto']); ?>">
                    <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                    <input type="hidden" name="precio" value="<?php echo htmlspecialchars($producto['coste']); ?>">
                    <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
                    <input type="number" name="cantidad" value="1" min="1" max="10" class="cantidad-input">
                    <button type="submit" class="btn-carrito">
                        <i class="fas fa-shopping-cart"></i> Añadir al carrito
                    </button>
                </form>
                
                <div>
                    <a href="javascript:history.back()" class="btn-volver">
                        <i class="fas fa-arrow-left"></i> Volver a la página anterior
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 ZonaX. Todos los derechos reservados.</p>
</footer>

</body>
</html>
