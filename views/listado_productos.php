<?php
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] === 'admin') {
        include __DIR__ . '/header_admin.php';
    } else {
        include __DIR__ . '/header_usuario.php';
    }
}
?>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        margin: 20px 0;
        color: #333;
    }

    .form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    button {
        padding: 5px 10px;
        background-color: #333;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #444;
    }

    .error-message {
        color: red;
        text-align: center;
    }
    footer {
        text-align: center;
        margin-top: 20px;
        padding: 10px 0;
        background-color: #222;
        color: #fff;
    }
</style>

<div class="form-container">
    <h2>Gestión de Productos</h2>

    <?php if (!empty($error)): ?>
        <div class="error-message">
            <p><?= htmlspecialchars($error) ?></p>
        </div>
    <?php endif; ?>

    <h3>Agregar Producto</h3>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="add">
        <input type="text" name="nombre_producto" placeholder="Nombre" required>
        <textarea name="descripcion" placeholder="Descripción" required></textarea>
        <input type="number" name="coste" placeholder="Coste" step="0.01" required>
        <select name="id_categoria" required>
            <option value="">Selecciona una categoría</option>
            <!-- Aquí deberías cargar las categorías desde la base de datos -->
            <option value="1">vibrador mujer</option>
            <option value="2">vibrador hombre</option>
            <option value="3">juguete para parejas</option>
            <option value="4">lubricantes</option>
            <option value="5">preservativos</option>
            <option value="6">lenceria</option>
            <option value="7">BDSM</option>
        </select>
        <input type="file" name="imagen" accept="image/*" required>
        <button type="submit">Agregar</button>
    </form>

    <h3>Lista de Productos</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Coste</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= htmlspecialchars($producto['id_producto']) ?></td>
                <td><?= htmlspecialchars($producto['nombre_producto']) ?></td>
                <td><?= htmlspecialchars($producto['descripción']) ?></td>
                <td><?= htmlspecialchars($producto['coste']) ?></td>
                <td><?= htmlspecialchars($producto['id_categoria']) ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="accion" value="delete">
                        <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                        <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</button>
                    </form>

                    <form method="POST" style="display:inline;" enctype="multipart/form-data">
                        <input type="hidden" name="accion" value="edit">
                        <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                        <input type="text" name="nombre_producto" value="<?= htmlspecialchars($producto['nombre_producto']) ?>" required>
                        <textarea name="descripcion" required><?= htmlspecialchars($producto['descripción']) ?></textarea>
                        <input type="number" name="coste" value="<?= htmlspecialchars($producto['coste']) ?>" step="0.01" required>
                        <select name="id_categoria" required>
                            <option value="1" <?= $producto['id_categoria'] == 1 ? 'selected' : '' ?>>vibrador mujer</option>
                            <option value="2" <?= $producto['id_categoria'] == 2 ? 'selected' : '' ?>>vibrador hombre</option>
                            <option value="3" <?= $producto['id_categoria'] == 3 ? 'selected' : '' ?>>juguete para parejas</option>
                            <option value="4" <?= $producto['id_categoria'] == 4 ? 'selected' : '' ?>>lubricantes</option>
                            <option value="5" <?= $producto['id_categoria'] == 5 ? 'selected' : '' ?>>preservativos</option>
                            <option value="6" <?= $producto['id_categoria'] == 6 ? 'selected' : '' ?>>lenceria</option>
                            <option value="7" <?= $producto['id_categoria'] == 7 ? 'selected' : '' ?>>BDSM</option>
                        </select>
                        <input type="file" name="imagen" accept="image/*">
                        <button type="submit">Actualizar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<footer>
    <p>&copy; 2024 ZonaX. Todos los derechos reservados.</p>
</footer>
