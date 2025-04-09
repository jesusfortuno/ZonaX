<?php
// views/carrito.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - ZonaX</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-rosa: #FF69B4;
            --color-rosa-claro: #FFB6C1;
            --color-rosa-oscuro: #FF1493;
            --color-naranja: #FFA500;
            --color-naranja-claro: #FFD580;
            --color-naranja-oscuro: #FF8C00;
            --color-amarillo: #FFD700;
            --color-blanco: #FFFFFF;
            --color-gris-claro: #f8f9fa;
            --color-gris: #6c757d;
            --color-verde: #28a745;
            --color-rojo: #dc3545;
            --color-texto: #333333;
            --color-fondo: #f9f9f9;
            --gradient-primary: linear-gradient(135deg, #FF69B4, #FFA500);
            --gradient-secondary: linear-gradient(135deg, #FFB6C1, #FFD580);
            --gradient-button: linear-gradient(45deg, var(--color-rosa), var(--color-naranja));
            --gradient-button-hover: linear-gradient(45deg, var(--color-naranja), var(--color-rosa));
            --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 6px 15px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.15);
            --border-radius-sm: 10px;
            --border-radius-md: 15px;
            --border-radius-lg: 20px;
            --border-radius-xl: 30px;
            --transition-fast: all 0.3s ease;
            --transition-medium: all 0.5s ease;
            --transition-slow: all 0.8s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--color-fondo);
            color: var(--color-texto);
            line-height: 1.6;
        }

        .page-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
            padding: 2rem 0;
        }

        .carrito-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .carrito-card {
            background-color: var(--color-blanco);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .carrito-header {
            background: var(--gradient-primary);
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .carrito-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 60%);
            animation: pulse 15s infinite linear;
            z-index: -1;
        }

        .carrito-titulo {
            font-size: 2.5rem;
            color: var(--color-blanco);
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 700;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 2;
        }

        .carrito-body {
            padding: 2rem;
        }

        .mensaje {
            background: var(--color-blanco);
            color: var(--color-verde);
            padding: 1.2rem;
            margin-bottom: 2rem;
            border-radius: var(--border-radius-md);
            text-align: center;
            font-weight: 500;
            box-shadow: var(--shadow-sm);
            border-left: 5px solid var(--color-verde);
            position: relative;
            overflow: hidden;
            animation: slideInRight 0.5s ease-out forwards;
        }

        .mensaje::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(40, 167, 69, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            z-index: -1;
        }

        .mensaje i {
            font-size: 1.2rem;
            margin-right: 0.5rem;
            animation: bounce 2s infinite;
        }

        .error {
            color: var(--color-rojo);
            border-left: 5px solid var(--color-rojo);
        }

        .error::before {
            background: linear-gradient(45deg, rgba(220, 53, 69, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
        }

        .carrito-vacio {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--gradient-secondary);
            border-radius: var(--border-radius-lg);
            position: relative;
            overflow: hidden;
        }

        .carrito-vacio::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            z-index: 0;
        }

        .carrito-vacio-icon {
            font-size: 5rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1.5rem;
            display: inline-block;
            animation: float 3s ease-in-out infinite;
            position: relative;
            z-index: 1;
        }

        .carrito-vacio-text {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--color-texto);
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        .btn-seguir-comprando {
            background: var(--gradient-button);
            color: var(--color-blanco);
            border: none;
            padding: 1rem 2rem;
            border-radius: var(--border-radius-xl);
            text-decoration: none;
            transition: var(--transition-fast);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-seguir-comprando::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: var(--transition-fast);
            z-index: -1;
        }

        .btn-seguir-comprando:hover::before {
            left: 100%;
        }

        .btn-seguir-comprando:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .btn-seguir-comprando i {
            font-size: 1.2rem;
            transition: var(--transition-fast);
        }

        .btn-seguir-comprando:hover i {
            transform: translateX(-5px);
        }

        .carrito-tabla-container {
            overflow: hidden;
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-md);
            margin-bottom: 2.5rem;
        }

        .carrito-tabla {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: var(--color-blanco);
        }

        .carrito-tabla th {
            background: var(--gradient-primary);
            color: var(--color-blanco);
            padding: 1.2rem 1rem;
            text-align: left;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 0.9rem;
            position: relative;
        }

        .carrito-tabla th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
        }

        .carrito-tabla tr {
            transition: var(--transition-fast);
        }

        .carrito-tabla tr:nth-child(even) {
            background-color: rgba(255, 182, 193, 0.05);
        }

        .carrito-tabla tr:hover {
            background-color: rgba(255, 182, 193, 0.1);
            transform: translateX(5px);
        }

        .carrito-tabla td {
            padding: 1.2rem 1rem;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .carrito-tabla tr:last-child td {
            border-bottom: none;
        }

        .producto-imagen-container {
            position: relative;
            width: 90px;
            height: 90px;
            border-radius: var(--border-radius-sm);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .producto-imagen {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition-medium);
        }

        .producto-imagen-container:hover .producto-imagen {
            transform: scale(1.1);
        }

        .producto-imagen-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 105, 180, 0.2), rgba(255, 165, 0, 0.2));
            opacity: 0;
            transition: var(--transition-fast);
        }

        .producto-imagen-container:hover::after {
            opacity: 1;
        }

        .producto-info {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .producto-nombre {
            font-weight: 600;
            color: var(--color-naranja);
            text-decoration: none;
            transition: var(--transition-fast);
            font-size: 1.1rem;
            display: block;
        }

        .producto-nombre:hover {
            color: var(--color-rosa);
            transform: translateX(5px);
        }

        .producto-codigo {
            color: #777;
            font-size: 0.85rem;
        }

        .cantidad-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cantidad-input {
            width: 70px;
            padding: 0.7rem;
            text-align: center;
            border: 2px solid #e0e0e0;
            border-radius: var(--border-radius-sm);
            font-size: 1rem;
            transition: var(--transition-fast);
            background-color: var(--color-blanco);
            font-weight: 500;
        }

        .cantidad-input:focus {
            border-color: var(--color-rosa);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.2);
        }

        .btn-actualizar {
            background: none;
            border: none;
            cursor: pointer;
            transition: var(--transition-fast);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #f0f0f0;
            color: var(--color-gris);
        }

        .btn-actualizar:hover {
            color: var(--color-blanco);
            background-color: var(--color-verde);
            transform: rotate(180deg);
        }

        .btn-eliminar {
            background: none;
            border: none;
            cursor: pointer;
            transition: var(--transition-fast);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #f0f0f0;
            color: var(--color-gris);
        }

        .btn-eliminar:hover {
            color: var(--color-blanco);
            background-color: var(--color-rojo);
            transform: scale(1.1);
        }

        .precio, .subtotal {
            font-weight: 600;
            color: var(--color-texto);
        }

        .subtotal {
            color: var(--color-naranja);
            font-size: 1.1rem;
        }

        .carrito-footer {
            padding: 0 2rem 2rem;
        }

        .carrito-resumen {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .carrito-total-container {
            background: var(--gradient-primary);
            padding: 2rem;
            border-radius: var(--border-radius-lg);
            color: var(--color-blanco);
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
            animation: pulse 2s infinite alternate;
        }

        .carrito-total-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'%3E%3Ccircle cx='3' cy='3' r='3'/%3E%3Ccircle cx='13' cy='13' r='3'/%3E%3C/g%3E%3C/svg%3E");
            z-index: 0;
        }

        .carrito-total-label {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .carrito-total-precio {
            font-size: 2.5rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .carrito-acciones {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn-vaciar-carrito {
            background: linear-gradient(45deg, var(--color-rojo), #e74c3c);
            color: var(--color-blanco);
            border: none;
            padding: 1rem 1.8rem;
            border-radius: var(--border-radius-xl);
            text-decoration: none;
            transition: var(--transition-fast);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .btn-vaciar-carrito::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: var(--transition-fast);
            z-index: -1;
        }

        .btn-vaciar-carrito:hover::before {
            left: 100%;
        }

        .btn-vaciar-carrito:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
        }

        .btn-finalizar-compra {
            background: var(--gradient-button);
            color: var(--color-blanco);
            border: none;
            padding: 1.2rem 2.5rem;
            font-size: 1.2rem;
            border-radius: var(--border-radius-xl);
            text-decoration: none;
            transition: var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            width: 100%;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-finalizar-compra::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: var(--transition-fast);
            z-index: -1;
        }

        .btn-finalizar-compra:hover::before {
            left: 100%;
        }

        .btn-finalizar-compra:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255, 105, 180, 0.3);
        }

        .btn-finalizar-compra i {
            font-size: 1.2rem;
            animation: pulse 2s infinite;
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
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-5px);
            }
            60% {
                transform: translateY(-2px);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .carrito-container {
                padding: 0 1rem;
            }
            
            .carrito-header {
                padding: 1.5rem 1rem;
            }
            
            .carrito-titulo {
                font-size: 2rem;
            }
            
            .carrito-body, .carrito-footer {
                padding: 1.5rem 1rem;
            }
            
            .carrito-tabla-container {
                overflow-x: auto;
            }
            
            .carrito-acciones {
                flex-direction: column;
            }
            
            .btn-seguir-comprando, .btn-vaciar-carrito {
                width: 100%;
                justify-content: center;
            }
            
            .carrito-total-precio {
                font-size: 2rem;
            }
        }

        /* Estilos para productos en el carrito */
        .producto-row {
            animation: fadeInUp 0.5s ease-out forwards;
            animation-delay: calc(var(--animation-order) * 0.1s);
            opacity: 0;
        }

        /* Efecto de neón para botones importantes */
        .neon-effect {
            box-shadow: 0 0 10px rgba(255, 105, 180, 0.5), 
                        0 0 20px rgba(255, 105, 180, 0.3), 
                        0 0 30px rgba(255, 105, 180, 0.1);
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

<div class="page-container">
    <div class="content-wrapper">
        <div class="carrito-container">
            <div class="carrito-card">
                <div class="carrito-header">
                    <h1 class="carrito-titulo">Tu Carrito de Compras</h1>
                </div>
                
                <div class="carrito-body">
                    <?php if (!empty($mensaje)): ?>
                        <div class="mensaje">
                            <i class="fas fa-check-circle"></i>
                            <?php echo htmlspecialchars($mensaje); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($error)): ?>
                        <div class="mensaje error">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (empty($carrito)): ?>
                        <div class="carrito-vacio">
                            <i class="fas fa-shopping-cart carrito-vacio-icon"></i>
                            <p class="carrito-vacio-text">Tu carrito está vacío</p>
                            <a href="?action=portada" class="btn-seguir-comprando">
                                <i class="fas fa-arrow-left"></i> Seguir comprando
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="carrito-tabla-container">
                            <table class="carrito-tabla">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; foreach ($carrito as $item): $i++; ?>
                                        <tr class="producto-row" style="--animation-order: <?php echo $i; ?>">
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 1rem;">
                                                    <div class="producto-imagen-container">
                                                        <?php if (!empty($item['imagen'])): ?>
                                                            <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="producto-imagen">
                                                        <?php else: ?>
                                                            <img src="img/default.jpg" alt="Imagen no disponible" class="producto-imagen">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="producto-info">
                                                        <a href="?action=producto&id=<?php echo htmlspecialchars($item['id']); ?>" class="producto-nombre">
                                                            <?php echo htmlspecialchars($item['nombre']); ?>
                                                        </a>
                                                        <span class="producto-codigo">Código: #<?php echo htmlspecialchars($item['id']); ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="precio"><?php echo htmlspecialchars($item['precio']); ?> €</td>
                                            <td>
                                                <form action="?action=carrito&op=update" method="post" class="cantidad-control">
                                                    <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($item['id']); ?>">
                                                    <input type="number" name="cantidad" value="<?php echo htmlspecialchars($item['cantidad']); ?>" min="1" max="10" class="cantidad-input">
                                                    <button type="submit" class="btn-actualizar" title="Actualizar cantidad">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="subtotal"><?php echo number_format($item['precio'] * $item['cantidad'], 2); ?> €</td>
                                            <td>
                                                <a href="?action=carrito&op=remove&id=<?php echo htmlspecialchars($item['id']); ?>" class="btn-eliminar" title="Eliminar producto">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                </div>
                
                <div class="carrito-footer">
                    <div class="carrito-resumen">
                        <div class="carrito-total-container">
                            <div class="carrito-total-label">Total del carrito:</div>
                            <div class="carrito-total-precio"><?php echo number_format($total, 2); ?> €</div>
                        </div>
                        
                        <div class="carrito-acciones">
                            <a href="?action=portada" class="btn-seguir-comprando">
                                <i class="fas fa-arrow-left"></i> Seguir comprando
                            </a>
                            <a href="?action=carrito&op=clear" class="btn-vaciar-carrito">
                                <i class="fas fa-trash"></i> Vaciar carrito
                            </a>
                        </div>
                        
                        <a href="#" class="btn-finalizar-compra neon-effect">
                            <i class="fas fa-check"></i> Finalizar compra
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> ZonaX. Todos los derechos reservados.</p>
    </footer>
</div>

</body>
</html>
