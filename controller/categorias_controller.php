<?php
// controller/categorias_controller.php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores en pantalla
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../error.log');

try {
    require_once __DIR__ . '/../model/connectaDb.php';
    require_once __DIR__ . '/../model/categories.php';

    $conection = DB::getInstance(); // Obtener la conexión a la base de datos

    // Obtener todas las categorías
    $categorias = getAllCategories($conection);
    
    // Verificar si se encontraron categorías
    if (empty($categorias)) {
        error_log("No se encontraron categorías en la base de datos");
    } else {
        error_log("Número de categorías obtenidas: " . count($categorias));
    }

    // Incluir la vista
    require_once __DIR__ . '/../views/categorias.php';
} catch (Exception $e) {
    error_log("Error en categorias_controller.php: " . $e->getMessage());
    echo "<p>Ha ocurrido un error al cargar las categorías. Por favor, inténtelo de nuevo más tarde.</p>";
}
?>
<?php
// controller/categorias_controller.php

// Incluir el modelo de categorías
include_once __DIR__ . '/../model/categories.php';

/**
 * Obtiene todas las categorías con el conteo de productos
 * @return array Arreglo con todas las categorías y su conteo de productos
 */
function obtenerTodasCategorias() {
    // Obtener las categorías desde el modelo
    $categorias = obtenerCategorias();
    
    // Añadir conteo de productos a cada categoría (simulado)
    foreach ($categorias as &$categoria) {
        // Aquí se podría hacer una consulta real para contar productos por categoría
        $categoria['total_productos'] = rand(5, 30); // Simulado para demostración
        
        // Añadir descripción si no existe
        if (!isset($categoria['descripcion'])) {
            $categoria['descripcion'] = 'Explora nuestra selección de productos en esta categoría y encuentra lo que estás buscando.';
        }
        
        // Añadir imagen por defecto si no existe
        if (!isset($categoria['imagen'])) {
            $categoria['imagen'] = 'img/categoria-default.jpg';
        }
    }
    
    return $categorias;
}

/**
 * Obtiene una categoría por su ID
 * @param int $id_categoria ID de la categoría
 * @return array|null Datos de la categoría o null si no existe
 */
function obtenerCategoriaPorId($id_categoria) {
    // Obtener todas las categorías
    $categorias = obtenerTodasCategorias();
    
    // Buscar la categoría por ID
    foreach ($categorias as $categoria) {
        if ($categoria['id'] == $id_categoria) {
            return $categoria;
        }
    }
    
    return null;
}
?>
