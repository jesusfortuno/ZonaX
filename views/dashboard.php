<?php include 'header_admin.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - ZonaX</title>
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

        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .dashboard-header {
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .dashboard-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--color-texto);
            margin-bottom: 0.5rem;
        }

        .dashboard-subtitle {
            font-size: 1.1rem;
            color: var(--color-gris);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: var(--color-blanco);
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-md);
            padding: 1.5rem;
            transition: var(--transition-fast);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient-primary);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--color-texto);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--color-naranja);
        }

        .actions-section {
            background: var(--color-blanco);
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-md);
            padding: 2rem;
            margin-bottom: 2.5rem;
        }

        .actions-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--color-texto);
            position: relative;
            padding-bottom: 0.5rem;
        }

        .actions-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 3px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .action-card {
            background: var(--color-gris-claro);
            border-radius: var(--border-radius-sm);
            padding: 1.5rem;
            transition: var(--transition-fast);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            text-decoration: none;
            color: var(--color-texto);
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            background: var(--color-blanco);
        }

        .action-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .action-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .action-description {
            font-size: 0.9rem;
            color: var(--color-gris);
        }

        .recent-activity {
            background: var(--color-blanco);
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-md);
            padding: 2rem;
        }

        .activity-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--color-texto);
            position: relative;
            padding-bottom: 0.5rem;
        }

        .activity-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 3px;
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            padding: 1rem 0;
            border-bottom: 1px solid var(--color-gris-claro);
            display: flex;
            align-items: center;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--color-blanco);
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 0.95rem;
            margin-bottom: 0.3rem;
        }

        .activity-time {
            font-size: 0.8rem;
            color: var(--color-gris);
        }

        .btn-action {
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

        .btn-action:hover {
            background: var(--gradient-button-hover);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 2rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Panel de Administración</h1>
            <p class="dashboard-subtitle">Bienvenido al panel de control de ZonaX</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-users stat-icon"></i>
                <h3 class="stat-title">Total Usuarios</h3>
                <p class="stat-value"><?= $stats['total_usuarios'] ?></p>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-box-open stat-icon"></i>
                <h3 class="stat-title">Total Productos</h3>
                <p class="stat-value"><?= $stats['total_productos'] ?></p>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-tags stat-icon"></i>
                <h3 class="stat-title">Total Categorías</h3>
                <p class="stat-value"><?= $stats['total_categorias'] ?></p>
            </div>
        </div>

        <div class="actions-section">
            <h2 class="actions-title">Acciones Rápidas</h2>
            
            <div class="actions-grid">
                <a href="?action=gestionar-productos" class="action-card">
                    <i class="fas fa-box action-icon"></i>
                    <h3 class="action-title">Gestionar Productos</h3>
                    <p class="action-description">Añadir, editar o eliminar productos de la tienda</p>
                </a>
                
                <a href="?action=gestionar-usuarios" class="action-card">
                    <i class="fas fa-users action-icon"></i>
                    <h3 class="action-title">Gestionar Usuarios</h3>
                    <p class="action-description">Administrar cuentas de usuarios y permisos</p>
                </a>
                
            </div>
        </div>
    </div>
<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
