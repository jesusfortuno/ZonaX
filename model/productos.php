<?php

function getProductosPorCategoria($conection, $categoria) {
    try {
        // Consulta parametrizada para evitar inyecciones SQL
        $sql = "SELECT product_id, product_name FROM PRODUCTS WHERE category_id = :categoria";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        $resultat = [];
    }

    return $resultat;
}
?>
