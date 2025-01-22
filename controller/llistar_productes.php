<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

// Activar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conection = DB::getInstance();
$productes = getProductos($conection);

// Debug
error_log("Listando todos los productos");
error_log("Número de productos encontrados: " . count($productes));

include __DIR__ . '/../views/llistar_productes.php';
?>