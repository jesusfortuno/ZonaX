<?php
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] === 'admin') {
        include __DIR__ . '/header_admin.php';
    } else {
        include __DIR__ . '/header_usuario.php';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - ZonaX</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --border-radius-sm: 8px;
            --border-radius-md: 12px;
            --border-radius-lg: 16px;
            --transition-fast: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--color-fondo);
            color: var(--color-texto);
            line-height: 1.6;
        }

        .productos-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .productos-header {
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .productos-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .productos-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--color-texto);
            margin-bottom: 0.5rem;
        }

        .productos-subtitle {
            font-size: 1.1rem;
            color: var(--color-gris);
        }

        .form-container {
            background: var(--color-blanco);
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-md);
            padding: 2rem;
            margin-bottom: 2.5rem;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--color-texto);
            position: relative;
            padding-bottom: 0.5rem;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 3px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--color-texto);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius-sm);
            font-size: 1rem;
            transition: var(--transition-fast);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-rosa);
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.2);
        }

        .form-select {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius-sm);
            font-size: 1rem;
            transition: var(--transition-fast);
            background-color: var(--color-blanco);
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--color-rosa);
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.2);
        }

        .form-file {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius-sm);
            font-size: 1rem;
            transition: var(--transition-fast);
            background-color: var(--color-blanco);
        }

        .form-file:focus {
            outline: none;
            border-color: var(--color-rosa);
        }

        .form-textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius-sm);
            font-size: 1rem;
            transition: var(--transition-fast);
            min-height: 120px;
            resize: vertical;
        }

        .form-textarea:focus {
            outline: none;
            border-color: var(--color-rosa);
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.2);
        }

        .btn-primary {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: var(--gradient-button);
            color: var(--color-blanco);
            border: none;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-fast);
            box-shadow: var(--shadow-sm);
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--gradient-button-hover);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .table-container {
            background: var(--color-blanco);
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-md);
            padding: 2rem;
            overflow-x: auto;
        }

        .table-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--color-texto);
            position: relative;
            padding-bottom: 0.5rem;
        }

        .table-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 3px;
        }

        .productos-table {
            width: 100%;
            border-collapse: collapse;
        }

        .productos-table th {
            background: var(--gradient-primary);
            color: var(--color-blanco);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        .productos-table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .productos-table tr:last-child td {
            border-bottom: none;
        }

        .productos-table tr:hover {
            background-color: var(--color-gris-claro);
        }

        .btn-action {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: var(--gradient-button);
            color: var(--color-blanco);
            border: none;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-fast);
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            margin-right: 0.5rem;
            font-size: 0.9rem;
        }

        .btn-action:hover {
            background: var(--gradient-button-hover);
            box-shadow: var(--shadow-md);
        }

        .btn-danger {
            background: linear-gradient(45deg, var(--color-rojo), #e74c3c);
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #e74c3c, var(--color-rojo));
        }

        .error-message {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--color-rojo);
            padding: 1rem;
            border-radius: var(--border-radius-sm);
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--color-rojo);
        }

        .success-message {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--color-verde);
            padding: 1rem;
            border-radius: var(--border-radius-sm);
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--color-verde);
        }

        .producto-imagen {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow-sm);
        }

        .producto-descripcion {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .producto-acciones {
            display: flex;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .productos-title {
                font-size: 2rem;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .productos-table {
                font-size: 0.9rem;
            }
            
            .producto-descripcion {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="productos-container">
        <div class="productos-header">
            <h1 class="productos-title">Gestión de Productos</h1>
            <p class="productos-subtitle">Administra los productos de tu tienda</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <p><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <h2 class="form-title">Agregar Producto</h2>
            
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="add">
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                        <input type="text" id="nombre_producto" name="nombre_producto" class="form-control" placeholder="Nombre del producto" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="coste" class="form-label">Precio</label>
                        <input type="number" id="coste" name="coste" class="form-control" placeholder="0.00" step="0.01" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="id_categoria" class="form-label">Categoría</label>
                        <select id="id_categoria" name="id_categoria" class="form-select" required>
                            <option value="">Selecciona una categoría</option>
                            <option value="1">Vibrador mujer</option>
                            <option value="2">Vibrador hombre</option>
                            <option value="3">Juguete para parejas</option>
                            <option value="4">Lubricantes</option>
                            <option value="5">Preservativos</option>
                            <option value="6">Lencería</option>
                            <option value="7">BDSM</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" id="imagen" name="imagen" class="form-file" accept="image/*" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-textarea" placeholder="Descripción del producto" required></textarea>
                </div>
                
                <button type="submit" class="btn-primary">
                    <i class="fas fa-plus-circle"></i> Agregar Producto
                </button>
            </form>
        </div>

        <div class="table-container">
            <h2 class="table-title">Lista de Productos</h2>
            
            <table class="productos-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= isset($producto['id_producto']) ? htmlspecialchars($producto['id_producto']) : htmlspecialchars($producto['id']) ?></td>
                    <td>
                        <?php if (!empty($producto['imagen'])): ?>
                            <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre_producto']) ?>" class="producto-imagen">
                        <?php else: ?>
                            <img src="img/default.jpg" alt="Sin imagen" class="producto-imagen">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($producto['nombre_producto']) ?></td>
                    <td class="producto-descripcion" title="<?= htmlspecialchars($producto['descripción']) ?>">
                        <?= mb_substr(htmlspecialchars($producto['descripción']), 0, 100) . (mb_strlen($producto['descripción']) > 100 ? '...' : '') ?>
                    </td>
                    <td><?= number_format($producto['coste'], 2) ?> €</td>
                    <td>
                        <?php 
                            $categorias = [
                                1 => 'Vibrador mujer',
                                2 => 'Vibrador hombre',
                                3 => 'Juguete para parejas',
                                4 => 'Lubricantes',
                                5 => 'Preservativos',
                                6 => 'Lencería',
                                7 => 'BDSM'
                            ];
                            echo isset($categorias[$producto['id_categoria']]) ? $categorias[$producto['id_categoria']] : 'Desconocida';
                        ?>
                    </td>
                    <td class="producto-acciones">
                        <button type="button" class="btn-action" onclick="editarProducto(<?= isset($producto['id_producto']) ? $producto['id_producto'] : $producto['id'] ?>)">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <form method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                            <input type="hidden" name="accion" value="delete">
                            <input type="hidden" name="id_producto" value="<?= isset($producto['id_producto']) ? $producto['id_producto'] : $producto['id'] ?>">
                            <button type="submit" class="btn-action btn-danger">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align: center; padding: 2rem;">
                    <p style="font-size: 1.2rem; color: #777;">No hay productos disponibles</p>
                    <p style="font-size: 0.9rem; color: #999;">Agrega productos utilizando el formulario de arriba</p>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
        </div>
    </div>

    <!-- Modal para editar producto -->
    <div id="modal-editar" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000;">
        <div style="position: relative; width: 80%; max-width: 800px; margin: 50px auto; background-color: white; padding: 20px; border-radius: var(--border-radius-md); box-shadow: var(--shadow-lg);">
            <button onclick="cerrarModal()" style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
            
            <h2 class="form-title">Editar Producto</h2>
            
            <form id="form-editar" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="edit">
                <input type="hidden" id="edit-id" name="id_producto" value="">
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="edit-nombre" class="form-label">Nombre del Producto</label>
                        <input type="text" id="edit-nombre" name="nombre_producto" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit-coste" class="form-label">Precio</label>
                        <input type="number" id="edit-coste" name="coste" class="form-control" step="0.01" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit-categoria" class="form-label">Categoría</label>
                        <select id="edit-categoria" name="id_categoria" class="form-select" required>
                            <option value="1">Vibrador mujer</option>
                            <option value="2">Vibrador hombre</option>
                            <option value="3">Juguete para parejas</option>
                            <option value="4">Lubricantes</option>
                            <option value="5">Preservativos</option>
                            <option value="6">Lencería</option>
                            <option value="7">BDSM</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit-imagen" class="form-label">Imagen (opcional)</label>
                        <input type="file" id="edit-imagen" name="imagen" class="form-file" accept="image/*">
                        <small>Deja en blanco para mantener la imagen actual</small>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="edit-descripcion" class="form-label">Descripción</label>
                    <textarea id="edit-descripcion" name="descripcion" class="form-textarea" required></textarea>
                </div>
                
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
            </form>
        </div>
    </div>

    <script>
        function editarProducto(id) {
            // Aquí deberías cargar los datos del producto con AJAX o usar datos ya disponibles
            // Por ahora, simulamos con datos de ejemplo
            document.getElementById('edit-id').value = id;
            
            // Buscar el producto en la tabla
            const filas = document.querySelectorAll('.productos-table tbody tr');
            for (let fila of filas) {
                if (fila.cells[0].textContent.trim() == id) {
                    document.getElementById('edit-nombre').value = fila.cells[2].textContent.trim();
                    document.getElementById('edit-descripcion').value = fila.cells[3].getAttribute('title');
                    document.getElementById('edit-coste').value = parseFloat(fila.cells[4].textContent);
                    
                    // Seleccionar la categoría correcta
                    const categoriaTexto = fila.cells[5].textContent.trim();
                    const selectCategoria = document.getElementById('edit-categoria');
                    for (let i = 0; i < selectCategoria.options.length; i++) {
                        if (selectCategoria.options[i].text === categoriaTexto) {
                            selectCategoria.selectedIndex = i;
                            break;
                        }
                    }
                    
                    break;
                }
            }
            
            document.getElementById('modal-editar').style.display = 'block';
        }
        
        function cerrarModal() {
            document.getElementById('modal-editar').style.display = 'none';
        }
        
        // Cerrar modal al hacer clic fuera de él
        window.onclick = function(event) {
            const modal = document.getElementById('modal-editar');
            if (event.target == modal) {
                cerrarModal();
            }
        }
    </script>
<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
