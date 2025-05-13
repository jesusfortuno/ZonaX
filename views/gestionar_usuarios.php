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
    <title>Gestión de Usuarios - ZonaX</title>
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

        .usuarios-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .usuarios-header {
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .usuarios-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .usuarios-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--color-texto);
            margin-bottom: 0.5rem;
        }

        .usuarios-subtitle {
            font-size: 1.1rem;
            color: var(--color-gris);
        }

        .message-container {
            margin-bottom: 2rem;
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

        .usuarios-table {
            width: 100%;
            border-collapse: collapse;
        }

        .usuarios-table th {
            background: var(--gradient-primary);
            color: var(--color-blanco);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        .usuarios-table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .usuarios-table tr:last-child td {
            border-bottom: none;
        }

        .usuarios-table tr:hover {
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

        .usuario-acciones {
            display: flex;
            gap: 0.5rem;
        }

        .role-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .role-admin {
            background-color: var(--color-rosa-claro);
            color: var(--color-rosa-oscuro);
        }

        .role-usuario {
            background-color: var(--color-naranja-claro);
            color: var(--color-naranja-oscuro);
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

        @media (max-width: 768px) {
            .usuarios-title {
                font-size: 2rem;
            }
            
            .usuarios-table {
                font-size: 0.9rem;
            }
            
            .btn-action {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="usuarios-container">
        <div class="usuarios-header">
            <h1 class="usuarios-title">Gestión de Usuarios</h1>
            <p class="usuarios-subtitle">Administra los usuarios registrados en la plataforma</p>
        </div>

        <div class="message-container">
            <?php if (!empty($error)): ?>
                <div class="error-message">
                    <p><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($mensaje)): ?>
                <div class="success-message">
                    <p><?= htmlspecialchars($mensaje) ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="table-container">
            <h2 class="table-title">Lista de Usuarios</h2>
            
            <table class="usuarios-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['id']) ?></td>
                            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td>
                                <span class="role-badge <?= $usuario['rol'] === 'admin' ? 'role-admin' : 'role-usuario' ?>">
                                    <?= htmlspecialchars($usuario['rol']) ?>
                                </span>
                            </td>
                            <td class="usuario-acciones">
                                <button type="button" class="btn-action" onclick="editarUsuario(<?= $usuario['id'] ?>, '<?= htmlspecialchars($usuario['nombre']) ?>', '<?= htmlspecialchars($usuario['email']) ?>', '<?= htmlspecialchars($usuario['rol']) ?>')">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                    <input type="hidden" name="accion" value="delete">
                                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                                    <button type="submit" class="btn-action btn-danger">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para editar usuario -->
    <div id="modal-editar" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000;">
        <div style="position: relative; width: 80%; max-width: 600px; margin: 50px auto; background-color: white; padding: 20px; border-radius: var(--border-radius-md); box-shadow: var(--shadow-lg);">
            <button onclick="cerrarModal()" style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
            
            <h2 class="table-title">Editar Usuario</h2>
            
            <form id="form-editar" method="POST">
                <input type="hidden" name="accion" value="edit">
                <input type="hidden" id="edit-id" name="id" value="">
                
                <div class="form-group">
                    <label for="edit-nombre" class="form-label">Nombre</label>
                    <input type="text" id="edit-nombre" name="nombre" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="edit-email" class="form-label">Email</label>
                    <input type="email" id="edit-email" name="email" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="edit-rol" class="form-label">Rol</label>
                    <select id="edit-rol" name="rol" class="form-select" required>
                        <option value="usuario">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-action">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
            </form>
        </div>
    </div>

    <script>
        function editarUsuario(id, nombre, email, rol) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-nombre').value = nombre;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-rol').value = rol;
            
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
