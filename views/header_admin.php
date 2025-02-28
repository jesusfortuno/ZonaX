<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - ZonaX</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        nav {
            background-color: #333;
            padding: 1rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .links {
            display: flex;
            gap: 1rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-right: 1rem;
            font-weight: 400;
        }
        nav .usuario {
            color: white;
            font-weight: 600;
        }
        nav span {
            color: #ffcc00;
            margin-left: 1rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav>
        <div class="links">
            <a href="?action=portada">Portada</a>
            <?php if (isset($_SESSION['usuario'])): ?>
                <span class="usuario">Administrador: <?= htmlspecialchars($_SESSION['usuario']); ?></span>
            <?php endif; ?>
            <a href="?action=dashboard">Dashboard</a>
            <a href="?action=gestionar-productos">Gestionar Productos</a>
            <a href="?action=portada">Categorías</a>
        </div>
        <div>
            <a href="?action=salir">Cerrar Sesión</a>
        </div>
    </nav>