<style>
    body {
        background-color: #fff;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    .page-title {
        text-align: center;
        margin: 2rem 0;
        color: #333;
        font-weight: 600;
        font-size: 1.8rem;
    }

    .container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        padding: 20px;
        max-width: 1100px;
        margin: 0 auto 3rem auto;
    }

    .category {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        border-radius: 15px;
        padding: 30px 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        text-decoration: none;
        height: 280px;
        border: 1px solid #f0f0f0;
        position: relative;
        overflow: hidden;
    }

    .category::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #ff6b6b, #ffa36b);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .category:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(255, 107, 107, 0.1);
    }

    .category:hover::before {
        opacity: 1;
    }

    .category img {
        width: 160px;
        height: 160px;
        object-fit: contain;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .category:hover img {
        transform: scale(1.08);
    }

    .category h2 {
        font-size: 1rem;
        font-weight: 600;
        margin: 0;
        color: #333;
        text-align: center;
        letter-spacing: 0.5px;
    }

    /* Imagen final más grande */
    .final-category {
        grid-column: span 2;
        height: 320px;
    }

    .final-category img {
        width: 200px;
        height: 200px;
    }

    /* Etiquetas de categoría */
    .category-tag {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: #ffd56b;
        color: #333;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Estilos específicos para cada categoría */
    .category[href*="categoria=1"] .category-tag {
        background-color: #ff6b6b;
        color: white;
    }

    .category[href*="categoria=2"] .category-tag {
        background-color: #ffa36b;
        color: white;
    }

    .category[href*="categoria=3"] .category-tag {
        background-color: #ffd56b;
    }

    .category[href*="categoria=4"] .category-tag {
        background-color: #ff9eb6;
        color: white;
    }

    .category[href*="categoria=5"] .category-tag {
        background-color: #ff6b6b;
        color: white;
    }

    .category[href*="categoria=6"] .category-tag {
        background-color: #ffa36b;
        color: white;
    }

    .category[href*="categoria=7"] .category-tag {
        background-color: #333;
        color: white;
    }

    footer {
        text-align: center;
        padding: 1.5rem 0;
        background-color: #ff6b6b;
        color: white;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .container {
            grid-template-columns: 1fr;
            padding: 15px;
        }

        .final-category {
            grid-column: span 1;
        }

        .category {
            height: 250px;
            padding: 20px 15px;
        }

        .category img {
            width: 140px;
            height: 140px;
        }
    }
</style>

<h1 class="page-title">Nuestras Categorías</h1>

<div class="container">
    <!-- Primera fila -->
    <a href="index.php?action=categoria&categoria=1" class="category">
        <div class="category-tag">Popular</div>
        <img src="img/vibrador-mujer.png" alt="Vibradores Mujer">
        <h2>VIBRADORES MUJER</h2>
    </a>

    <a href="index.php?action=categoria&categoria=2" class="category">
        <div class="category-tag">Destacado</div>
        <img src="img/vibrador-hombre.png" alt="Vibradores Hombre">
        <h2>VIBRADORES HOMBRE</h2>
    </a>

    <!-- Segunda fila -->
    <a href="index.php?action=categoria&categoria=3" class="category">
        <div class="category-tag">Parejas</div>
        <img src="img/jueguete-pareja.png" alt="Juguetes para Parejas">
        <h2>JUGUETES PARA PAREJAS</h2>
    </a>

    <a href="index.php?action=categoria&categoria=4" class="category">
        <div class="category-tag">Esencial</div>
        <img src="img/lubricantes.png" alt="Lubricantes">
        <h2>LUBRICANTES</h2>
    </a>

    <!-- Tercera fila -->
    <a href="index.php?action=categoria&categoria=6" class="category">
        <div class="category-tag">Sensual</div>
        <img src="img/lenceria.png" alt="Lencería">
        <h2>LENCERIA</h2>
    </a>

    <a href="index.php?action=categoria&categoria=7" class="category">
        <div class="category-tag">BDSM</div>
        <img src="img/bdsm.png" alt="BDSM">
        <h2>BDSM</h2>
    </a>

    <!-- Imagen final más grande -->
    <a href="index.php?action=categoria&categoria=5" class="category final-category">
        <div class="category-tag">Protección</div>
        <img src="img/preservativos.png" alt="Preservativos">
        <h2>PRESERVATIVOS</h2>
    </a>
</div>

<?php include __DIR__ . '/footer.php'; ?>
