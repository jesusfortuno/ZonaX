<?php

function getProductos($conection) {
    try {
        // Consulta parametrizada para evitar inyecciones SQL
        $sql = "SELECT nombre_producto, descripción, coste FROM PRODUCTOS";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        $resultat = [];
    }

    return $resultat;
}
?>