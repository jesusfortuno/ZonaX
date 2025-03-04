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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .carrito-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .carrito-titulo {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #333;
            text-align: center;
        }
        
        .mensaje {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            text-align: center;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .carrito-vacio {
            text-align: center;
            padding: 3rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 2rem;
        }
        
        .carrito-tabla {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }
        
        .carrito-tabla th {
            background-color: #f8f9fa;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }
        
        .carrito-tabla td {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }
        
        .producto-imagen {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .cantidad-input {
            width: 60px;
            padding: 0.5rem;
            text-align: center;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        
        .btn-actualizar, .btn-eliminar {
            background: none;
            border: none;
            cursor: pointer;
            color: #6c757d;
            transition: color 0.3s;
        }
        
        .btn-actualizar:hover {
            color: #28a745;
        }
        
        .btn-eliminar:hover {
            color: #dc3545;
        }
        
        .carrito-total {
            text-align: right;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        
        .total-precio {
            font-weight: bold;
            color: #e63946;
            font-size: 1.5rem;
            margin-left: 1rem;
        }
        
        .carrito-acciones {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
        
        .btn-seguir-comprando {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .btn-seguir-comprando:hover {
            background-color: #5a6268;
        }
        
        .btn-vaciar-carrito {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .btn-vaciar-carrito:hover {
            background-color: #c82333;
        }
        
        .btn-finalizar-compra {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            border-radius: 30px;
            text-decoration: none;
            transition: background-color 0.3s;
            display: block;
            text-align: center;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }
        
        .btn-finalizar-compra:hover {
            background-color: #218838;
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

<div class="carrito-container">
    <h1 class="carrito-titulo">Carrito de Compras</h1>
    
    <?php if (!empty($mensaje)): ?>
        <div class="mensaje">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($error)): ?>
        <div class="mensaje error">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    
    <?php if (empty($carrito)): ?>
        <div class="carrito-vacio">
            <p>Tu carrito está vacío</p>
            <a href="?action=portada" class="btn-seguir-comprando">
                <i class="fas fa-arrow-left"></i> Seguir comprando
            </a>
        </div>
    <?php else: ?>
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
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <?php if (!empty($item['imagen'])): ?>
                                    <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="producto-imagen">
                                <?php else: ?>
                                    <img src="img/default.jpg" alt="Imagen no disponible" class="producto-imagen">
                                <?php endif; ?>
                                <div>
                                    <a href="?action=producto&id=<?php echo htmlspecialchars($item['id']); ?>">
                                        <?php echo htmlspecialchars($item['nombre']); ?>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($item['precio']); ?> €</td>
                        <td>
                            <form action="?action=carrito&op=update" method="post" style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($item['id']); ?>">
                                <input type="number" name="cantidad" value="<?php echo htmlspecialchars($item['cantidad']); ?>" min="1" max="10" class="cantidad-input">
                                <button type="submit" class="btn-actualizar" title="Actualizar cantidad">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </form>
                        </td>
                        <td><?php echo number_format($item['precio'] * $item['cantidad'], 2); ?> €</td>
                        <td>
                            <a href="?action=carrito&op=remove&id=<?php echo htmlspecialchars($item['id']); ?>" class="btn-eliminar" title="Eliminar producto">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="carrito-total">
            <span>Total:</span>
            <span class="total-precio"><?php echo number_format($total, 2); ?> €</span>
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
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 ZonaX. Todos los derechos reservados.</p>
</footer>

</body>
</html>