<?php
// views/producto.php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia la sesión solo si no está activa
}

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1); // Mostrar errores en pantalla para depuración
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../error.log');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= !empty($producto) ? htmlspecialchars($producto['nombre_producto']) : 'Detalle del Producto' ?> - ZonaX</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Definición de variables de color */
        :root {
            --color-primary: #ff6b6b;
            --color-primary-light: #fca5a5;
            --color-primary-dark: #ef4444;
            --color-secondary: #fb923c;
            --color-secondary-light: #fdba74;
            --color-accent: #fbbf24;
            --color-white: #ffffff;
            --color-gray-50: #f9fafb;
            --color-gray-100: #f3f4f6;
            --color-gray-200: #e5e7eb;
            --color-gray-300: #d1d5db;
            --color-gray-400: #9ca3af;
            --color-gray-500: #6b7280;
            --color-gray-600: #4b5563;
            --color-gray-700: #374151;
            --color-gray-800: #1f2937;
            --color-gray-900: #111827;
            --gradient-main: linear-gradient(90deg, #ff6b6b, #ffa36b);
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --transition-fast: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--color-gray-50);
            color: var(--color-gray-800);
        }

        /* Estilos para la visualización del detalle del producto */
        .producto-detalle-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: var(--color-gray-500);
        }

        .breadcrumb a {
            color: var(--color-gray-600);
            text-decoration: none;
            transition: var(--transition-fast);
        }

        .breadcrumb a:hover {
            color: var(--color-primary);
        }

        .breadcrumb i {
            font-size: 0.7rem;
            color: var(--color-gray-400);
        }

        .producto-detalle {
            background: var(--color-white);
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
            position: relative;
        }

        .producto-galeria {
            flex: 1;
            min-width: 300px;
            position: relative;
            background: linear-gradient(45deg, #f8f9fa, #ffffff);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
}

        .producto-imagen-principal {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: var(--shadow-md);
            transition: transform 0.5s ease;
}

        .producto-imagen-principal:hover {
            transform: scale(1.05);
}

        .producto-info-container {
            flex: 1;
            min-width: 300px;
            padding: 2.5rem;
            position: relative;
            background: linear-gradient(135deg, #ffffff 0%, #fff5f8 100%);
        }

        .producto-info-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--gradient-main);
        }

        .producto-titulo {
            font-size: 2.5rem;
            color: var(--color-gray-800);
            margin-bottom: 1.5rem;
            font-weight: 700;
            line-height: 1.2;
            position: relative;
            display: inline-block;
        }

        .producto-titulo::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--gradient-main);
            border-radius: 2px;
        }

        .producto-descripcion-container {
            margin-bottom: 2rem;
            position: relative;
        }

        .producto-descripcion {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--color-gray-600);
            background: rgba(255, 255, 255, 0.7);
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--color-gray-200);
        }

        .producto-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2rem;
            align-items: center;
        }

        .producto-precio-container {
            background: var(--gradient-main);
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 5px 15px rgba(255, 105, 180, 0.2);
            position: relative;
            overflow: hidden;
        }

        .producto-precio-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
            z-index: 1;
        }

        .producto-precio {
            font-size: 2rem;
            font-weight: bold;
            color: var(--color-white);
            margin: 0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
        }

        .producto-disponibilidad {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(46, 204, 113, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            color: #2ecc71;
            font-weight: 600;
        }

        .producto-disponibilidad i {
            font-size: 0.9rem;
        }

        .producto-acciones {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 2rem;
        }

        .form-carrito {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            width: 100%;
        }

        .cantidad-container {
            display: flex;
            align-items: center;
            background: #f5f5f5;
            border-radius: 50px;
            padding: 0.3rem;
            border: 1px solid var(--color-gray-200);
        }

        .btn-cantidad {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: white;
            color: var(--color-gray-700);
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-fast);
        }

        .btn-cantidad:hover {
            background: var(--color-gray-100);
            transform: translateY(-2px);
        }

        .cantidad-input {
            width: 50px;
            text-align: center;
            border: none;
            background: transparent;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--color-gray-700);
            padding: 0.5rem;
        }

        .cantidad-input:focus {
            outline: none;
        }

        .btn-carrito {
            flex: 1;
            min-width: 200px;
            padding: 1rem 1.5rem;
            background: var(--gradient-main);
            color: var(--color-white);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            transition: var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(255, 105, 180, 0.15);
        }

        .btn-carrito::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,0.2), rgba(255,255,255,0));
            transition: left 0.7s ease;
        }

        .btn-carrito:hover::before {
            left: 100%;
        }

        .btn-carrito:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 105, 180, 0.25);
        }

        .btn-carrito i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .btn-carrito:hover i {
            transform: scale(1.2);
        }

        .btn-wishlist {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            background: white;
            color: var(--color-gray-500);
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-fast);
        }

        .btn-wishlist:hover {
            color: var(--color-primary);
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .btn-volver {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition-fast);
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            background: rgba(255, 107, 107, 0.1);
        }

        .btn-volver:hover {
            color: var(--color-secondary);
            transform: translateX(-5px);
            background: rgba(255, 107, 107, 0.15);
        }

        .btn-volver i {
            transition: transform 0.3s ease;
        }

        .btn-volver:hover i {
            transform: translateX(-3px);
        }

        .producto-caracteristicas {
            margin-top: 2.5rem;
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--color-gray-200);
        }

        .caracteristicas-titulo {
            font-size: 1.3rem;
            color: var(--color-gray-800);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .caracteristicas-titulo::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--gradient-main);
            border-radius: 2px;
        }

        .caracteristicas-lista {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .caracteristica-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0;
            color: var(--color-gray-600);
        }

        .caracteristica-item i {
            color: var(--color-primary);
            font-size: 0.9rem;
        }

        .error-mensaje {
            color: var(--color-primary);
            font-size: 1.3rem;
            text-align: center;
            margin: 3rem auto;
            padding: 2rem;
            background: var(--color-white);
            border-radius: 15px;
            box-shadow: var(--shadow-md);
            max-width: 800px;
        }

        .error-mensaje .btn-volver {
            margin-top: 1.5rem;
            display: inline-flex;
            justify-content: center;
        }

        /* Productos relacionados */
        .productos-relacionados {
            margin-top: 3rem;
        }

        .relacionados-titulo {
            font-size: 1.8rem;
            color: var(--color-gray-800);
            margin-bottom: 1.5rem;
            text-align: center;
            position: relative;
        }

        .relacionados-titulo::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--gradient-main);
            border-radius: 2px;
        }

        .relacionados-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .producto-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-fast);
            border: 1px solid var(--color-gray-200);
        }

        .producto-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .producto-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .producto-card-content {
            padding: 1.5rem;
        }

        .producto-card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--color-gray-800);
        }

        .producto-card-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 1rem;
        }

        .producto-card-btn {
            width: 100%;
            padding: 0.8rem;
            background: var(--gradient-main);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .producto-card-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* Reseñas */
        .producto-reviews {
            margin-top: 3rem;
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow-md);
        }

        .reviews-titulo {
            font-size: 1.5rem;
            color: var(--color-gray-800);
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .reviews-titulo::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--gradient-main);
            border-radius: 2px;
        }

        .review-item {
            border-bottom: 1px solid var(--color-gray-200);
            padding: 1.5rem 0;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .review-author {
            font-weight: 600;
            color: var(--color-gray-800);
        }

        .review-date {
            font-size: 0.9rem;
            color: var(--color-gray-500);
        }

        .review-rating {
            margin-bottom: 0.5rem;
            color: var(--color-accent);
        }

        .review-content {
            color: var(--color-gray-600);
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .producto-titulo {
                font-size: 2rem;
            }
            
            .producto-precio {
                font-size: 1.8rem;
            }
            
            .producto-galeria, .producto-info-container {
                padding: 1.5rem;
            }

            .relacionados-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .producto-acciones {
                flex-direction: column;
            }
            
            .btn-carrito {
                width: 100%;
            }
            
            .cantidad-container {
                width: 100%;
                justify-content: center;
            }

            .producto-meta {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .producto-detalle {
            animation: fadeIn 0.5s ease-out;
        }

        .producto-card {
            animation: fadeIn 0.5s ease-out;
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
} else {
    include_once __DIR__ . '/header_usuario.php';
}
?>

<div class="producto-detalle-container">
    <?php if (!empty($error)): ?>
        <div class="error-mensaje">
            <p><?php echo htmlspecialchars($error); ?></p>
            <a href="javascript:history.back()" class="btn-volver">
                <i class="fas fa-arrow-left"></i> Volver a la página anterior
            </a>
        </div>
    <?php elseif (!empty($producto)): ?>
        <div class="breadcrumb">
            <a href="?action=portada">Inicio</a>
            <i class="fas fa-chevron-right"></i>
            <a href="?action=categorias">Categorías</a>
            <i class="fas fa-chevron-right"></i>
            <a href="?action=categoria&categoria=<?= $producto['id_categoria'] ?? 1 ?>"><?= !empty($categoria) ? htmlspecialchars($categoria['nombre_categoria']) : 'Categoría' ?></a>
            <i class="fas fa-chevron-right"></i>
            <span><?= htmlspecialchars($producto['nombre_producto']); ?></span>
        </div>

        <div class="producto-detalle">
            <div class="producto-galeria">
                <?php if (!empty($producto['imagen'])): ?>
                    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" class="producto-imagen-principal" id="imagen-principal">
                <?php else: ?>
                    <img src="img/default.jpg" alt="Imagen no disponible" class="producto-imagen-principal" id="imagen-principal">
                <?php endif; ?>
            </div>
            <div class="producto-info-container">
                <h1 class="producto-titulo"><?php echo htmlspecialchars($producto['nombre_producto']); ?></h1>
                
                <div class="producto-meta">
                    <div class="producto-precio-container">
                        <p class="producto-precio"><?php echo number_format($producto['coste'], 2); ?> €</p>
                    </div>
                    <div class="producto-disponibilidad">
                        <i class="fas fa-check-circle"></i> En stock
                    </div>
                </div>
                
                <div class="producto-descripcion-container">
                    <div class="producto-descripcion">
                        <?php echo htmlspecialchars($producto['descripción']); ?>
                    </div>
                </div>
                
                <!-- Características del producto -->
                <div class="producto-caracteristicas">
                    <h3 class="caracteristicas-titulo">Características</h3>
                    <ul class="caracteristicas-lista">
                        <li class="caracteristica-item">
                            <i class="fas fa-check"></i> Envío en 24/48h
                        </li>
                        <li class="caracteristica-item">
                            <i class="fas fa-check"></i> Garantía de 2 años
                        </li>
                        <li class="caracteristica-item">
                            <i class="fas fa-check"></i> Devolución gratuita
                        </li>
                        <li class="caracteristica-item">
                            <i class="fas fa-check"></i> Atención al cliente 24/7
                        </li>
                        <li class="caracteristica-item">
                            <i class="fas fa-check"></i> Pago seguro
                        </li>
                        <li class="caracteristica-item">
                            <i class="fas fa-check"></i> Envío discreto
                        </li>
                    </ul>
                </div>
                
                <div class="producto-acciones">
                    <!-- Botón para añadir al carrito -->
                    <form action="index.php?action=carrito&op=add" method="post" class="form-carrito">
                        <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">
                        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                        <input type="hidden" name="precio" value="<?php echo $producto['coste']; ?>">
                        <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
                        
                        <div class="cantidad-container">
                            <button type="button" class="btn-cantidad btn-menos" onclick="decrementarCantidad()">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" name="cantidad" value="1" min="1" max="10" class="cantidad-input" id="cantidad-input">
                            <button type="button" class="btn-cantidad btn-mas" onclick="incrementarCantidad()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        
                        <button type="submit" class="btn-carrito">
                            <i class="fas fa-shopping-cart"></i> Añadir al carrito
                        </button>

                        <button type="button" class="btn-wishlist" title="Añadir a favoritos">
                            <i class="fas fa-heart"></i>
                        </button>
                    </form>
                </div>
                
                <a href="javascript:history.back()" class="btn-volver">
                    <i class="fas fa-arrow-left"></i> Volver a la página anterior
                </a>
            </div>
        </div>

        <!-- Productos relacionados -->
        <div class="productos-relacionados">
            <h2 class="relacionados-titulo">Productos relacionados</h2>
            <div class="relacionados-grid">
                <?php 
                // Usar los productos relacionados obtenidos en el controlador
                if (!empty($productos_relacionados)): 
                    foreach ($productos_relacionados as $relacionado): 
                ?>
                    <div class="producto-card">
                        <img src="<?= htmlspecialchars($relacionado['imagen'] ?? 'img/default.jpg'); ?>" alt="<?= htmlspecialchars($relacionado['nombre_producto']); ?>" class="producto-card-img">
                        <div class="producto-card-content">
                            <h3 class="producto-card-title"><?= htmlspecialchars($relacionado['nombre_producto']); ?></h3>
                            <p class="producto-card-price"><?= number_format($relacionado['coste'], 2); ?> €</p>
                            <a href="?action=producto&id=<?= $relacionado['id']; ?>" class="producto-card-btn">
                                <i class="fas fa-eye"></i> Ver producto
                            </a>
                        </div>
                    </div>
                <?php 
                    endforeach; 
                else:
                    // Si no hay productos relacionados, mostrar algunos productos aleatorios
                    $productos_ejemplo = obtenerProductos();
                    shuffle($productos_ejemplo);
                    $productos_ejemplo = array_slice($productos_ejemplo, 0, 3);
                    
                    foreach ($productos_ejemplo as $ejemplo):
                        if ($ejemplo['id'] != $producto['id']):
                ?>
                    <div class="producto-card">
                        <img src="<?= htmlspecialchars($ejemplo['imagen'] ?? 'img/default.jpg'); ?>" alt="<?= htmlspecialchars($ejemplo['nombre_producto']); ?>" class="producto-card-img">
                        <div class="producto-card-content">
                            <h3 class="producto-card-title"><?= htmlspecialchars($ejemplo['nombre_producto']); ?></h3>
                            <p class="producto-card-price"><?= number_format($ejemplo['coste'], 2); ?> €</p>
                            <a href="?action=producto&id=<?= $ejemplo['id']; ?>" class="producto-card-btn">
                                <i class="fas fa-eye"></i> Ver producto
                            </a>
                        </div>
                    </div>
                <?php 
                        endif;
                    endforeach;
                endif; 
                ?>
            </div>
        </div>

        <!-- Reseñas de productos -->
        <div class="producto-reviews">
            <h2 class="reviews-titulo">Opiniones de clientes</h2>
            
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review-item">
                        <div class="review-header">
                            <span class="review-author"><?= htmlspecialchars($review['nombre_usuario']); ?></span>
                            <span class="review-date"><?= htmlspecialchars($review['fecha']); ?></span>
                        </div>
                        <div class="review-rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star<?= $i <= $review['puntuacion'] ? '' : '-o'; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="review-content"><?= htmlspecialchars($review['comentario']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Reseñas de ejemplo -->
                <div class="review-item">
                    <div class="review-header">
                        <span class="review-author">María García</span>
                        <span class="review-date">15/04/2023</span>
                    </div>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="review-content">Excelente producto, cumple perfectamente con lo que promete. La entrega fue rápida y el embalaje muy discreto. ¡Lo recomiendo!</p>
                </div>
                <div class="review-item">
                    <div class="review-header">
                        <span class="review-author">Carlos Rodríguez</span>
                        <span class="review-date">03/03/2023</span>
                    </div>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <p class="review-content">Muy buen producto, aunque el envío tardó un poco más de lo esperado. La calidad es excelente y el precio está bien.</p>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="error-mensaje">
            <p>No se ha encontrado el producto solicitado.</p>
            <a href="?action=portada" class="btn-volver">
                <i class="fas fa-arrow-left"></i> Volver a la página principal
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>

<script>
function decrementarCantidad() {
    const input = document.getElementById('cantidad-input');
    const valor = parseInt(input.value);
    if (valor > 1) {
        input.value = valor - 1;
    }
}

function incrementarCantidad() {
    const input = document.getElementById('cantidad-input');
    const valor = parseInt(input.value);
    if (valor < 10) {
        input.value = valor + 1;
    }
}
</script>

</body>
</html>
