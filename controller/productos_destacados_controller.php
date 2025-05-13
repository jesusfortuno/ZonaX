<?php
// controller/productos_destacados_controller.php

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
    require_once __DIR__ . '/../model/productos_destacados.php';

    $conection = DB::getInstance();
    
    // Obtener productos destacados
    $productosDestacados = getProductosDestacados($conection, 3);
    
    // Debug
    error_log("Controlador de productos destacados ejecutado");
    error_log("Número de productos destacados encontrados: " . count($productosDestacados));
    
    // No necesitamos incluir una vista aquí, ya que los datos se usarán en main_content.php
    
} catch (Exception $e) {
    error_log("Error en productos_destacados_controller.php: " . $e->getMessage());
    $productosDestacados = []; // En caso de error, inicializamos como array vacío
}
?>
