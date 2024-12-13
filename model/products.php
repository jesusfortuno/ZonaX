<?php

function buscarProductosPorNombre($conection, $nombre) {

    try {
        // Consulta parametrizada
        $sql = "SELECT product_id, product_name, stock FROM PRODUCT WHERE product_name LIKE :nombre";
        $stmt = $conection->prepare($sql);
        $nombre = "%$nombre%";
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        $resultat = [];
    }

    return $resultat;
}

?>
