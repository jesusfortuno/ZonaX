<?php

function getProductosPorCategoria($conection, $categoria) {
    try {
        // Consulta parametrizada para evitar inyecciones SQL
        $sql = "SELECT id_producto, nombre_producto FROM PRODUCTOS WHERE id_categoria = :categoria";
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
