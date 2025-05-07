<?php
// views/producto.php
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
            --color-gris-claro: #f9f9f9;
            --color-gris: #e0e0e0;
            --color-texto: #333333;
            --color-primario: #ff6b6b;
            --color-secundario: #ffa36b;
            --color-fondo: #ffffff;
            --color-texto-secundario: #666666;
            --color-borde: rgba(0,0,0,0.05);
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--color-gris-claro);
            color: var(--color-texto);
        }

        /* Estilos para la visualización del detalle del producto */
        .producto-detalle-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .producto-detalle {
            background: var(--color-fondo);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
            position: relative;
            border: 1px solid var(--color-borde);
        }

        .producto-galeria {
            flex: 1;
            min-width: 300px;
            position: relative;
            background: linear-gradient(45deg, #f8f9fa, #ffffff);
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .producto-imagen-principal {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.5s ease;
        }

        .producto-imagen-principal:hover {
            transform: scale(1.03);
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
            background: linear-gradient(90deg, var(--color-primario), var(--color-secundario));
        }

        .producto-titulo {
            font-size: 2.5rem;
            color: #333;
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
            background: linear-gradient(90deg, var(--color-primario), var(--color-secundario));
            border-radius: 2px;
        }

        .producto-descripcion-container {
            margin-bottom: 2rem;
            position: relative;
        }

        .producto-descripcion {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--color-texto-secundario);
            background: rgba(255, 255, 255, 0.7);
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            border: 1px solid var(--color-borde);
        }

        .producto-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2rem;
            align-items: center;
        }

        .producto-precio-container {
            background: linear-gradient(45deg, var(--color-primario), var(--color-secundario));
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
            color: var(--color-blanco);
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
            border: 1px solid var(--color-borde);
        }

        .btn-cantidad {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: white;
            color: #333;
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .btn-cantidad:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        .cantidad-input {
            width: 50px;
            text-align: center;
            border: none;
            background: transparent;
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            padding: 0.5rem;
        }

        .cantidad-input:focus {
            outline: none;
        }

        .btn-carrito {
            flex: 1;
            min-width: 200px;
            padding: 1rem 1.5rem;
            background: linear-gradient(45deg, var(--color-primario), var(--color-secundario));
            color: var(--color-blanco);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
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

        .btn-volver {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
            color: var(--color-primario);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            background: rgba(255, 107, 107, 0.1);
        }

        .btn-volver:hover {
            color: var(--color-secundario);
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            border: 1px solid var(--color-borde);
        }

        .caracteristicas-titulo {
            font-size: 1.3rem;
            color: #333;
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
            background: linear-gradient(90deg, var(--color-primario), var(--color-secundario));
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
            color: var(--color-texto-secundario);
        }

        .caracteristica-item i {
            color: var(--color-primario);
            font-size: 0.9rem;
        }

        .error-mensaje {
            color: var(--color-primario);
            font-size: 1.3rem;
            text-align: center;
            margin: 3rem auto;
            padding: 2rem;
            background: var(--color-blanco);
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            max-width: 800px;
        }

        .error-mensaje .btn-volver {
            margin-top: 1.5rem;
            display: inline-flex;
            justify-content: center;
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

<div class="producto-detalle-container">
    <?php if (!empty($error)): ?>
        <div class="error-mensaje">
            <p><?php echo htmlspecialchars($error); ?></p>
            <a href="javascript:history.back()" class="btn-volver">
                <i class="fas fa-arrow-left"></i> Volver a la página anterior
            </a>
        </div>
    <?php elseif (!empty($producto)): ?>
        <div class="producto-detalle">
            <div class="producto-galeria">
                <?php if (!empty($producto['imagen'])): ?>
                    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" class="producto-imagen-principal">
                <?php else: ?>
                    <img src="img/default.jpg" alt="Imagen no disponible" class="producto-imagen-principal">
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
                    </form>
                </div>
                
                <a href="javascript:history.back()" class="btn-volver">
                    <i class="fas fa-arrow-left"></i> Volver a la página anterior
                </a>
            </div>
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
