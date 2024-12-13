<?php

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

// Obtener la categoría desde la URL (GET) o usar la categoría por defecto (1)
$categoria = isset($_GET['categoria']) && ctype_digit($_GET['categoria']) ? intval($_GET['categoria']) : 1;

$conection = DB::getInstance();
$productes = getProductosPorCategoria($conection, $categoria);

include __DIR__ . '/../views/llistar_productes.php';
?>
