<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si la sesión está activa, muestra el header correspondiente
if (isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] === 'admin') {
        include __DIR__ . '/views/header_admin.php'; // Cargar vista de administrador
    } else {
        include __DIR__ . '/views/header_usuario.php'; // Cargar vista de usuario
    }
} else {
    // Si no hay sesión activa, igual carga el header de usuario pero sin datos del usuario
    include __DIR__ . '/views/header_usuario.php';
}
?>


<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Sitio Web</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Estilos de navegación */
        nav {
            background-color: #333;
            padding: 1rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between; /* Alinea elementos a los extremos */
            align-items: center;
        }
        nav .links {
            display: flex;
            gap: 1rem; /* Espacio entre los enlaces */
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

        /* Estilos para los títulos de las secciones */
        section h2 {
            font-weight: 600;
            letter-spacing: 1px;
            font-size: 1.2rem;
        }

        /* Contenedor para las secciones */
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 1.9rem;
            justify-content: center;
            padding: 0 1.9rem;
            margin-bottom: 1rem;
            flex: 1;
        }

        /* Mantiene el formato de rectángulos */
        section {
            background-color: #f5f5f5;
            padding: 1.35rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 445px;
            min-height: 235px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1.25rem;
        }

        section:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        /* Estilo para las imágenes dentro de las secciones */
        section img {
            max-width: 185px;
            height: auto;
            border-radius: 8px;
        }

        /* Footer ajustado */
        footer {
            background-color: #333;
            color: white;
            padding: 0.8rem;
            text-align: center;
            width: 100%;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <div class="container">
        <section id="vibradores-mujer">
            <img src="img/vibrador-mujer.png" alt="Vibradores Mujer">
            <h2>VIBRADORES MUJER</h2>
        </section>

        <section id="vibradores-hombre">
            <img src="img/vibrador-hombre.png" alt="Vibradores Hombre">
            <h2>VIBRADORES HOMBRE</h2>
        </section>

        <section id="juguetes-parejas">
            <img src="img/jueguete-pareja.png" alt="Juguetes para Parejas">
            <h2>JUGUETES PARA PAREJAS</h2>
        </section>

        <section id="lubricantes">
            <img src="img/lubricantes.png" alt="Lubricantes">
            <h2>LUBRICANTES</h2>
        </section>

        <section id="preservativos">
            <img src="img/preservativos.png" alt="Preservativos">
            <h2>PRESERVATIVOS</h2>
        </section>

        <section id="lenceria">
            <img src="img/lenceria.png" alt="Lencería">
            <h2>LENCERIA</h2>
        </section>

        <section id="bdsm">
            <img src="img/bdsm.png" alt="BDSM">
            <h2>BDSM</h2>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Mi Sitio Web. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
