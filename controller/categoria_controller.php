<?php
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
    require_once __DIR__ . '/../model/productos.php';

    $conection = DB::getInstance(); // Obtener la conexión a la base de datos

    // Manejo de errores
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Obtener la categoría de la URL
        $id_categoria = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;
        error_log("ID de categoría: " . $id_categoria);

        // Obtener productos según la categoría
        $productos = getProductosByCategoria($conection, $id_categoria);
        
        // Verificar si se encontraron productos
        if (empty($productos)) {
            error_log("No se encontraron productos para la categoría: " . $id_categoria);
        } else {
            error_log("Número de productos obtenidos: " . count($productos));
        }
    } else {
        $error = "Método no permitido.";
        error_log("Método no permitido en categoria_controller.php");
    }

    // Incluir la vista
    require_once __DIR__ . '/../views/categoria.php';
} catch (Exception $e) {
    error_log("Error en categoria_controller.php: " . $e->getMessage());
    echo "<p>Ha ocurrido un error al cargar la categoría. Por favor, inténtelo de nuevo más tarde.</p>";
}
?>
