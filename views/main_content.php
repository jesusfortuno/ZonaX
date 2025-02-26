<style>
    .container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        padding: 20px;
        text-align: center;
        max-width: 1000px;
        margin: 0 auto;
    }

    .category {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #f8f8f8;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        text-decoration: none;
        height: 250px;
    }

    .category:hover {
        transform: scale(1.05);
    }

    .category img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .category h2 {
        font-size: 16px;
        margin: 0;
        color: #333;
    }

    /* Imagen final más grande */
    .final-category {
        grid-column: span 2;
        height: 300px;
    }

    .final-category img {
        width: 200px;
        height: 200px;
    }

    footer {
        text-align: center;
        margin-top: 20px;
        padding: 10px 0;
        background-color: #222;
        color: #fff;
    }
</style>

<div class="container">
    <!-- Primera fila -->
    <a href="index.php?action=categoria&categoria=1" class="category">
        <img src="img/vibrador-mujer.png" alt="Vibradores Mujer">
        <h2>VIBRADORES MUJER</h2>
    </a>

    <a href="index.php?action=categoria&categoria=2" class="category">
        <img src="img/vibrador-hombre.png" alt="Vibradores Hombre">
        <h2>VIBRADORES HOMBRE</h2>
    </a>

    <!-- Segunda fila -->
    <a href="index.php?action=categoria&categoria=3" class="category">
        <img src="img/jueguete-pareja.png" alt="Juguetes para Parejas">
        <h2>JUGUETES PARA PAREJAS</h2>
    </a>

    <a href="index.php?action=categoria&categoria=4" class="category">
        <img src="img/lubricantes.png" alt="Lubricantes">
        <h2>LUBRICANTES</h2>
    </a>

    <!-- Tercera fila -->
    <a href="index.php?action=categoria&categoria=6" class="category">
        <img src="img/lenceria.png" alt="Lencería">
        <h2>LENCERIA</h2>
    </a>

    <a href="index.php?action=categoria&categoria=7" class="category">
        <img src="img/bdsm.png" alt="BDSM">
        <h2>BDSM</h2>
    </a>

    <!-- Imagen final más grande -->
    <a href="index.php?action=categoria&categoria=5" class="category final-category">
        <img src="img/preservativos.png" alt="Preservativos">
        <h2>PRESERVATIVOS</h2>
    </a>
</div>

<footer>
    <p>&copy; 2024 ZonaX. Todos los derechos reservados.</p>
</footer>
