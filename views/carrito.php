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
            --color-primary: #f87171;
            --color-primary-light: #fca5a5;
            --color-primary-dark: #ef4444;
            --color-secondary: #fb923c;
            --color-secondary-light: #fdba74;
            --color-accent: #fbbf24;
            --color-white: #ffffff;
            --color-light: #f9fafb;
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
            --color-success: #10b981;
            --color-danger: #ef4444;
            --gradient-main: linear-gradient(90deg, #ff6b6b, #ffa36b);
            --gradient-subtle: linear-gradient(135deg, rgba(248, 113, 113, 0.8) 0%, rgba(251, 146, 60, 0.8) 100%);
            --gradient-light: linear-gradient(135deg, rgba(248, 113, 113, 0.2) 0%, rgba(251, 146, 60, 0.2) 100%);
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05), 0 2px 4px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.05), 0 4px 6px rgba(0, 0, 0, 0.05);
            --border-radius-sm: 0.375rem;
            --border-radius-md: 0.5rem;
            --border-radius-lg: 0.75rem;
            --border-radius-xl: 1rem;
            --transition-fast: all 0.2s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--color-gray-50);
            color: var(--color-gray-800);
            line-height: 1.5;
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
            background-color: var(--color-white);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            position: relative;
            z-index: 1;
            border: 1px solid var(--color-gray-200);
        }

        .carrito-header {
            background: linear-gradient(90deg, #ff6b6b, #ffa36b);
            padding: 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .carrito-titulo {
            font-size: 1.75rem;
            color: var(--color-white);
            font-weight: 600;
            margin: 0;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .carrito-body {
            padding: 1.5rem;
        }

        .mensaje {
            background: var(--color-gray-50);
            color: var(--color-success);
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius-md);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border-left: 3px solid var(--color-success);
        }

        .mensaje i {
            font-size: 1rem;
        }

        .error {
            color: var(--color-danger);
            border-left: 3px solid var(--color-danger);
        }

        .carrito-vacio {
            text-align: center;
            padding: 3rem 2rem;
            background: var(--color-gray-50);
            border-radius: var(--border-radius-md);
            border: 1px dashed var(--color-gray-300);
        }

        .carrito-vacio-icon {
            font-size: 3rem;
            color: var(--color-gray-400);
            margin-bottom: 1rem;
        }

        .carrito-vacio-text {
            font-size: 1.25rem;
            font-weight: 500;
            color: var(--color-gray-700);
            margin-bottom: 1.5rem;
        }

        .btn-seguir-comprando {
            background: var(--color-primary);
            color: var(--color-white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius-md);
            text-decoration: none;
            transition: var(--transition-fast);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: var(--shadow-sm);
        }

        .btn-seguir-comprando:hover {
            background: var(--color-primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-seguir-comprando i {
            font-size: 1rem;
        }

        .carrito-tabla-container {
            overflow: hidden;
            border-radius: var(--border-radius-md);
            border: 1px solid var(--color-gray-200);
            margin-bottom: 1.5rem;
        }

        .carrito-tabla {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: var(--color-white);
        }

        .carrito-tabla th {
            background: var(--color-primary);
            color: var(--color-white);
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .carrito-tabla tr {
            transition: var(--transition-fast);
        }

        .carrito-tabla tr:nth-child(even) {
            background-color: var(--color-gray-50);
        }

        .carrito-tabla tr:hover {
            background-color: var(--color-gray-100);
        }

        .carrito-tabla td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--color-gray-200);
            vertical-align: middle;
        }

        .carrito-tabla tr:last-child td {
            border-bottom: none;
        }

        .producto-imagen-container {
            position: relative;
            width: 60px;
            height: 60px;
            border-radius: var(--border-radius-sm);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--color-gray-200);
        }

        .producto-imagen {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition-fast);
        }

        .producto-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .producto-nombre {
            font-weight: 500;
            color: var(--color-gray-800);
            text-decoration: none;
            transition: var(--transition-fast);
            font-size: 0.95rem;
            display: block;
        }

        .producto-nombre:hover {
            color: var(--color-primary);
        }

        .producto-codigo {
            color: var(--color-gray-500);
            font-size: 0.75rem;
        }

        .cantidad-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cantidad-input {
            width: 50px;
            padding: 0.375rem;
            text-align: center;
            border: 1px solid var(--color-gray-300);
            border-radius: var(--border-radius-sm);
            font-size: 0.875rem;
            transition: var(--transition-fast);
            background-color: var(--color-white);
        }

        .cantidad-input:focus {
            border-color: var(--color-primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(248, 113, 113, 0.2);
        }

        .btn-actualizar {
            background: none;
            border: none;
            cursor: pointer;
            transition: var(--transition-fast);
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: var(--color-gray-100);
            color: var(--color-gray-600);
        }

        .btn-actualizar:hover {
            color: var(--color-white);
            background-color: var(--color-success);
        }

        .btn-eliminar {
            background: none;
            border: none;
            cursor: pointer;
            transition: var(--transition-fast);
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: var(--color-gray-100);
            color: var(--color-gray-600);
        }

        .btn-eliminar:hover {
            color: var(--color-white);
            background-color: var(--color-danger);
        }

        .precio, .subtotal {
            font-weight: 500;
            color: var(--color-gray-800);
        }

        .subtotal {
            color: var(--color-primary);
        }

        .carrito-footer {
            padding: 0 1.5rem 1.5rem;
        }

        .carrito-resumen {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .carrito-total-container {
            background: var(--gradient-light);
            padding: 1.25rem;
            border-radius: var(--border-radius-md);
            color: var(--color-gray-800);
            border: 1px solid var(--color-gray-200);
        }

        .carrito-total-label {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .carrito-total-precio {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--color-primary);
        }

        .carrito-acciones {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .btn-vaciar-carrito {
            background: var(--color-gray-200);
            color: var(--color-gray-700);
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: var(--border-radius-md);
            text-decoration: none;
            transition: var(--transition-fast);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: var(--shadow-sm);
        }

        .btn-vaciar-carrito:hover {
            background: var(--color-gray-300);
            color: var(--color-gray-800);
        }

        .btn-finalizar-compra {
            background: linear-gradient(90deg, #ff6b6b, #ffa36b);
            color: var(--color-white);
            border: none;
            padding: 0.875rem 1.5rem;
            font-size: 1rem;
            border-radius: var(--border-radius-md);
            text-decoration: none;
            transition: var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            font-weight: 500;
            box-shadow: var(--shadow-sm);
        }

        .btn-finalizar-compra:hover {
            background: var(--color-primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-finalizar-compra i {
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .carrito-container {
                padding: 0 1rem;
            }
            
            .carrito-header {
                padding: 1.25rem 1rem;
            }
            
            .carrito-titulo {
                font-size: 1.5rem;
            }
            
            .carrito-body, .carrito-footer {
                padding: 1.25rem 1rem;
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
                font-size: 1.5rem;
            }
        }

        /* Estilos para productos en el carrito */
        .producto-row {
            opacity: 0;
            animation: fadeInUp 0.3s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Aplicar animación con retraso a cada fila */
        .producto-row:nth-child(1) { animation-delay: 0.05s; }
        .producto-row:nth-child(2) { animation-delay: 0.1s; }
        .producto-row:nth-child(3) { animation-delay: 0.15s; }
        .producto-row:nth-child(4) { animation-delay: 0.2s; }
        .producto-row:nth-child(5) { animation-delay: 0.25s; }
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
                                    <?php foreach ($carrito as $item): ?>
                                        <tr class="producto-row">
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 0.75rem;">
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
                        
                        <a href="#" class="btn-finalizar-compra">
                            <i class="fas fa-check"></i> Finalizar compra
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/footer.php'; ?>
</div>

</body>
</html>
