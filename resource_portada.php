<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Sitio Web</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
        }

        /* Estilos de navegación */
        nav {
            background-color: #333;
            padding: 1rem;
            margin-bottom: 2rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-right: 1rem;
        }

        /* Contenedor para las secciones */
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            padding: 0 2rem;
            margin-bottom: 70px; /* Espacio para el footer */
        }

        /* Mantiene el formato de rectángulos */
        section {
            background-color: #f5f5f5;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 480px; /* Ancho fijo */
            min-height: 250px; /* Altura fija */
            text-align: center;
            display: flex; /* Añadido para usar flexbox */
            justify-content: center; /* Centra horizontalmente */
            align-items: center; /* Centra verticalmente */
        }

        section:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        /* Footer fijo en la parte inferior */
        footer {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <nav>
        <a href="#">Productos</a>
        <a href='?action=llistar-categories'>Categories</a>
        <a href="#">Cuenta</a>
        <a href="#">Carrito</a>
    </nav>

    <div class="container">
        <section id="servicios">
            <h2>VIBRADORES MUJER</h2>
        </section>

        <section id="productos">
            <h2>VIBRADORES HOMBRE</h2>
        </section>

        <section id="contacto">
            <h2>JUGUETES PARA PAREJAS</h2>
        </section>

        <section id="contacto">
            <h2>LUBRICANTES</h2>
        </section>

        <section id="contacto">
            <h2>PRESERVATIVOS</h2>
        </section>

        <section id="contacto">
            <h2>LENCERIA</h2>
        </section>

        <section id="contacto">
            <h2>BDSM</h2>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Mi Sitio Web. Todos los derechos reservados.</p>
    </footer>
</body>
</html>