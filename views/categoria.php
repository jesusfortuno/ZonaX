<?php
// categoria.php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia la sesión solo si no está activa
}

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores en pantalla
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../error.log');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos de la Categoría</title>
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
            --color-primario: #ff6b6b;
            --color-secundario: #ffa36b;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        /* Estilos para la visualización de productos */
        .productos-container {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .categoria-titulo {
            text-align: center;
            background: linear-gradient(90deg, var(--color-primario), var(--color-secundario));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-size: 3rem;
            margin: 2rem 0;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: bold;
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .categoria-titulo::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--color-primario), var(--color-secundario));
            border-radius: 2px;
        }

        .productos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2.5rem;
            padding: 1rem;
        }

        .producto-card {
            background: var(--color-blanco);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: all 0.4s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            animation: fadeIn 0.6s ease-out forwards;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .producto-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(255, 105, 180, 0.15);
            border-color: rgba(255, 105, 180, 0.2);
        }

        .imagen-container {
            position: relative;
            height: 280px;
            overflow: hidden;
            background: linear-gradient(45deg, #f8f9fa, #ffffff);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .producto-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .producto-card:hover img {
            transform: scale(1.08);
        }

        .producto-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(45deg, var(--color-primario), var(--color-secundario));
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: bold;
            box-shadow: 0 3px 10px rgba(255, 105, 180, 0.2);
            z-index: 10;
        }

        .producto-info {
            padding: 1.8rem;
            background: linear-gradient(135deg, #ffffff 0%, #fff5f8 100%);
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            position: relative;
            z-index: 1;
        }

        .producto-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--color-primario), var(--color-secundario));
            z-index: 2;
        }

        .producto-titulo {
            color: #333;
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.3;
            transition: color 0.3s ease;
        }

        .producto-card:hover .producto-titulo {
            color: var(--color-primario);
        }

        .descripcion {
            color: #666;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-height: 3.5em;
        }

        .precio-container {
            background: linear-gradient(45deg, var(--color-primario), var(--color-secundario));
            padding: 0.7rem 1.4rem;
            border-radius: 50px;
            display: inline-block;
            margin-top: auto;
            margin-bottom: 1.2rem;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.2);
            align-self: flex-start;
            position: relative;
            overflow: hidden;
        }

        .precio-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
            z-index: 1;
        }

        .precio {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--color-blanco);
            margin: 0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
        }

        .ver-detalles {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(45deg, var(--color-primario), var(--color-secundario));
            color: var(--color-blanco);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            margin-top: 0.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.15);
        }

        .ver-detalles::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,0.2), rgba(255,255,255,0));
            transition: left 0.7s ease;
        }

        .ver-detalles:hover::before {
            left: 100%;
        }

        .ver-detalles:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(255, 105, 180, 0.25);
        }

        .ver-detalles i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .ver-detalles:hover i {
            transform: scale(1.2);
        }

        .no-productos {
            text-align: center;
            padding: 3rem;
            background: linear-gradient(45deg, var(--color-rosa-claro), var(--color-naranja-claro));
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .no-productos p {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 1rem;
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

        /* Animaciones */
        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .productos-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                padding: 0.5rem;
            }
            
            .categoria-titulo {
                font-size: 2.5rem;
                margin: 1.5rem 0;
            }

            .producto-titulo {
                font-size: 1.3rem;
            }

            .precio {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 480px) {
            .productos-grid {
                grid-template-columns: 1fr;
            }
            
            .categoria-titulo {
                font-size: 2rem;
            }
        }

        /* Estilos para enlaces */
        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>

<?php
if (isset($_SESSION['usuario'])) {
    if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
        include_once __DIR__ . '/header_admin.php';
    } else {
        include_once __DIR__ . '/header_usuario.php';
    }
}
?>

<div class="productos-container">
    <h1 class="categoria-titulo">Productos de la Categoría</h1>
    <?php if (!empty($productos)): ?>
        <div class="productos-grid">
            <?php foreach ($productos as $producto): ?>
                <div class="producto-card">
                    <?php if (rand(0, 1) == 1): ?>
                        <div class="producto-badge">Destacado</div>
                    <?php endif; ?>
                    <div class="imagen-container">
                        <?php if (!empty($producto['imagen'])): ?>
                            <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                        <?php else: ?>
                            <img src="img/default.jpg" alt="Imagen no disponible">
                        <?php endif; ?>
                    </div>
                    <div class="producto-info">
                        <h2 class="producto-titulo"><?php echo htmlspecialchars($producto['nombre_producto']); ?></h2>
                        <p class="descripcion"><?php echo htmlspecialchars($producto['descripción']); ?></p>
                        <div class="precio-container">
                            <p class="precio"><?php echo number_format($producto['coste'], 2); ?>€</p>
                        </div>
                        <a href="index.php?action=producto&id=<?php echo $producto['id']; ?>" class="ver-detalles">
                            <i class="fas fa-eye"></i> Ver detalles
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="no-productos">
            <p>¡Ups! No hay productos disponibles en esta categoría.</p>
            <p class="secondary-text">Vuelve a intentarlo más tarde o explora otras categorías</p>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
