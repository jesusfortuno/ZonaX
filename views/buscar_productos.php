<?php
if (!empty($productos)) {
        foreach ($productos as $producto) {
            echo "<p>Producto: {$producto['product_name']} - Stock: {$producto['stock']} (ID: {$producto['product_id']})</p>";
        }
    } else {
        echo "<p>No se encontraron productos con ese nombre.</p>";
    }
    exit;
?>