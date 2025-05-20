<?php
// views/categorias.php
if (session_status() === PHP_SESSION_NONE) {
   session_start(); // Inicia la sesión solo si no está activa
}

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores en pantalla
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../error.log');
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Categorías - ZonaX</title>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <style>
       :root {
           --color-primary: #ff6b6b;
           --color-primary-light: #fca5a5;
           --color-primary-dark: #ef4444;
           --color-secondary: #fb923c;
           --color-secondary-light: #fdba74;
           --color-accent: #fbbf24;
           --color-white: #ffffff;
           --color-gray-50: #f9fafb;
           --color-gray-100: #f3f4f6;
           --color-gray-200: #e5e7eb;
           --color-gray-300: #d1d5db;
           --color-gray-400: #9ca3af;
           --color-gray-500: #6b7280;
           --color-gray-600: #4b5563;
           --color-gray-700: #374151;
           --color-gray-800: #1f2937;
           --color-gray-900: #111827;
           --gradient-main: linear-gradient(90deg, #ff6b6b, #ffa36b);
           --gradient-alt: linear-gradient(135deg, #fb923c, #fbbf24);
           --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
           --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05);
           --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
           --transition-fast: all 0.3s ease;
       }
       
       * {
           margin: 0;
           padding: 0;
           box-sizing: border-box;
           font-family: 'Poppins', sans-serif;
       }
       
       body {
           background-color: var(--color-gray-50);
           color: var(--color-gray-800);
       }

       .container {
           max-width: 1200px;
           margin: 0 auto;
           padding: 2rem 1rem;
       }

       .breadcrumb {
           display: flex;
           align-items: center;
           gap: 0.5rem;
           margin-bottom: 2rem;
           font-size: 0.9rem;
           color: var(--color-gray-500);
       }

       .breadcrumb a {
           color: var(--color-gray-600);
           text-decoration: none;
           transition: var(--transition-fast);
       }

       .breadcrumb a:hover {
           color: var(--color-primary);
       }

       .breadcrumb i {
           font-size: 0.7rem;
           color: var(--color-gray-400);
       }

       /* Nuevo estilo para el encabezado, igual que en productos */
       .header-container {
           background-color: #111827;
           border-radius: 0.75rem;
           padding: 3rem 1rem;
           margin-bottom: 2rem;
           text-align: center;
       }

       .header-title {
           color: white;
           font-size: 2.25rem;
           font-weight: 700;
           margin-bottom: 0.5rem;
       }

       .header-decoration {
           width: 80px;
           height: 3px;
           background-color: var(--color-primary);
           margin: 1rem auto 1.5rem;
           border-radius: 2px;
       }

       .header-description {
           color: var(--color-gray-200);
           max-width: 700px;
           margin: 0 auto;
           font-size: 1rem;
           line-height: 1.6;
       }

       .categories-grid {
           display: grid;
           grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
           gap: 2rem;
           max-width: 1200px;
           margin: 0 auto;
       }

       .categoria-card {
           background: var(--color-white);
           border-radius: 10px;
           overflow: hidden;
           box-shadow: var(--shadow-md);
           transition: var(--transition-fast);
           text-decoration: none;
           color: var(--color-gray-800);
           display: flex;
           flex-direction: column;
           height: 100%;
           border: 1px solid var(--color-gray-200);
       }

       .categoria-card:hover {
           transform: translateY(-10px);
           box-shadow: var(--shadow-lg);
       }

       .categoria-image-container {
           position: relative;
           padding-top: 75%; /* 4:3 Aspect Ratio */
           overflow: hidden;
           background: linear-gradient(135deg, #f8f9fa, #ffffff);
       }

       .categoria-img {
           position: absolute;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           object-fit: contain;
           padding: 1.5rem;
           transition: transform 0.5s ease;
       }

       .categoria-card:hover .categoria-img {
           transform: scale(1.1);
       }

       .categoria-tag {
           position: absolute;
           top: 1rem;
           right: 1rem;
           padding: 0.35rem 1rem;
           border-radius: 50px;
           font-size: 0.75rem;
           font-weight: 600;
           text-transform: uppercase;
           letter-spacing: 0.5px;
           z-index: 2;
       }

       .categoria-tag.popular {
           background-color: #ff6b6b;
           color: white;
       }

       .categoria-tag.destacado {
           background-color: #ffa36b;
           color: white;
       }

       .categoria-tag.parejas {
           background-color: #ffd56b;
           color: var(--color-gray-800);
       }

       .categoria-tag.esencial {
           background-color: #ff9eb6;
           color: white;
       }

       .categoria-tag.sensual {
           background-color: #ffa36b;
           color: white;
       }

       .categoria-tag.bdsm {
           background-color: #333;
           color: white;
       }

       .categoria-info {
           padding: 1.5rem;
           display: flex;
           flex-direction: column;
           justify-content: space-between;
           flex-grow: 1;
           position: relative;
           background: linear-gradient(135deg, #ffffff 0%, #fff5f8 100%);
       }

       .categoria-title {
           font-size: 1.1rem;
           font-weight: 600;
           margin-bottom: 1rem;
           color: var(--color-gray-800);
       }

       .categoria-link {
           display: inline-flex;
           align-items: center;
           gap: 0.5rem;
           color: var(--color-primary);
           font-weight: 500;
           font-size: 0.9rem;
           margin-top: auto;
           transition: var(--transition-fast);
       }

       .categoria-card:hover .categoria-link {
           color: var(--color-primary-dark);
           gap: 0.75rem;
       }

       .empty-message {
           text-align: center;
           padding: 3rem;
           background: white;
           border-radius: 15px;
           box-shadow: var(--shadow-md);
           margin: 2rem auto;
           max-width: 600px;
       }

       .empty-message i {
           font-size: 3rem;
           color: var(--color-gray-400);
           margin-bottom: 1rem;
       }

       .empty-message h3 {
           font-size: 1.5rem;
           color: var(--color-gray-700);
           margin-bottom: 1rem;
       }

       .empty-message p {
           color: var(--color-gray-600);
           margin-bottom: 1.5rem;
       }

       .empty-message a {
           display: inline-flex;
           align-items: center;
           gap: 0.5rem;
           background: var(--gradient-main);
           color: white;
           text-decoration: none;
           padding: 0.8rem 1.5rem;
           border-radius: 50px;
           font-weight: 600;
           transition: var(--transition-fast);
       }

       .empty-message a:hover {
           transform: translateY(-3px);
           box-shadow: var(--shadow-md);
       }

       @media (max-width: 768px) {
           .header-title {
               font-size: 2rem;
           }
           
           .categories-grid {
               grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
               gap: 1.5rem;
           }
       }

       @media (max-width: 480px) {
           .header-title {
               font-size: 1.75rem;
           }
           
           .categories-grid {
               grid-template-columns: 1fr;
           }
       }

       /* Animaciones */
       @keyframes fadeIn {
           from { opacity: 0; transform: translateY(20px); }
           to { opacity: 1; transform: translateY(0); }
       }

       .categoria-card {
           animation: fadeIn 0.5s ease-out;
           animation-fill-mode: both;
       }

       .categories-grid .categoria-card:nth-child(1) { animation-delay: 0.1s; }
       .categories-grid .categoria-card:nth-child(2) { animation-delay: 0.2s; }
       .categories-grid .categoria-card:nth-child(3) { animation-delay: 0.3s; }
       .categories-grid .categoria-card:nth-child(4) { animation-delay: 0.4s; }
       .categories-grid .categoria-card:nth-child(5) { animation-delay: 0.5s; }
       .categories-grid .categoria-card:nth-child(6) { animation-delay: 0.6s; }
   </style>
</head>
<body>
   <?php
   if (isset($_SESSION['usuario'])) {
       if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
           include_once __DIR__ . '/header_admin.php';
       } else {
           include_once __DIR__ . '/header_usuario.php';
       }
   } else {
       include_once __DIR__ . '/header_usuario.php';
   }
   ?>

   <div class="container">
       <div class="breadcrumb">
           <a href="?action=portada">Inicio</a>
           <i class="fas fa-chevron-right"></i>
           <span>Categorías</span>
       </div>

       <!-- Nuevo encabezado con el mismo estilo que en productos -->
       <div class="header-container">
           <h1 class="header-title">Nuestras Categorías</h1>
           <div class="header-decoration"></div>
           <p class="header-description">Explora nuestra amplia selección de categorías y encuentra los productos que estás buscando. Tenemos todo lo que necesitas para disfrutar al máximo.</p>
       </div>

       <?php if (!empty($categorias)): ?>
       <div class="categories-grid">
           <?php foreach ($categorias as $categoria): ?>
               <div class="categoria-card">
                   <?php 
                       // Determine tag class and text based on category
                       $tagClass = 'popular';
                       $tagText = 'Popular';
                       
                       // Asignar imagen y etiqueta según el ID de categoría
                       $imagePath = 'img/categoria-default.jpg';
                       
                       switch($categoria['id']) {
                           case 1: // Vibrador Mujer
                               $imagePath = 'img/vibrador-mujer.png';
                               $tagClass = 'popular'; 
                               $tagText = 'Popular'; 
                               break;
                           case 2: // Vibrador Hombre
                               $imagePath = 'img/vibrador-hombre.png';
                               $tagClass = 'destacado'; 
                               $tagText = 'Destacado'; 
                               break;
                           case 3: // Juguetes para Parejas
                               $imagePath = 'img/jueguete-pareja.png';
                               $tagClass = 'parejas'; 
                               $tagText = 'Parejas'; 
                               break;
                           case 4: // Lubricantes
                               $imagePath = 'img/lubricantes.png';
                               $tagClass = 'esencial'; 
                               $tagText = 'Esencial'; 
                               break;
                           case 5: // Preservativos
                               $imagePath = 'img/preservativos.png';
                               $tagClass = 'popular'; 
                               $tagText = 'Popular'; 
                               break;
                           case 6: // Lencería
                               $imagePath = 'img/lenceria.png';
                               $tagClass = 'sensual'; 
                               $tagText = 'Sensual'; 
                               break;
                           case 7: // BDSM
                               $imagePath = 'img/bdsm.png';
                               $tagClass = 'bdsm'; 
                               $tagText = 'BDSM'; 
                               break;
                       }
                   ?>
                   
                   <div class="categoria-image-container">
                       <img src="<?= $imagePath; ?>" alt="<?= htmlspecialchars($categoria['nombre_categoria']); ?>" class="categoria-img">
                       <span class="categoria-tag <?= $tagClass ?>"><?= $tagText ?></span>
                   </div>
                   
                   <div class="categoria-info">
                       <h3 class="categoria-title"><?= strtoupper(htmlspecialchars($categoria['nombre_categoria'])); ?></h3>
                       <a href="?action=categoria&categoria=<?= $categoria['id']; ?>" class="categoria-link">
                           Ver productos <i class="fas fa-chevron-right"></i>
                       </a>
                   </div>
               </div>
           <?php endforeach; ?>
       </div>
   <?php else: ?>
       <div class="empty-message">
           <i class="fas fa-folder-open"></i>
           <h3>No hay categorías disponibles</h3>
           <p>Actualmente no hay categorías disponibles. Por favor, vuelve más tarde.</p>
           <a href="?action=portada">
               <i class="fas fa-home"></i> Volver al inicio
           </a>
       </div>
   <?php endif; ?>
   </div>

   <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
