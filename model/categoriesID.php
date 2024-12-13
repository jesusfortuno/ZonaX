<?php

function getProductsByCategory($conection, $categoryId) {
    
    try {
        $consulta = $conection->prepare("SELECT * FROM PRODUCTS WHERE category_id = ?");
        $consulta->bindParam(1, $categoryId, PDO::PARAM_INT);
        $consulta->execute();
        $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return $productos;
}

?>
