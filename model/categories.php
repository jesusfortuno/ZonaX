<?php

function getCategories($conection) {

    try {
        $consulta_graus = $conection->prepare("SELECT id_categoria, nombre_categoria, descripcion FROM CATEGORIA");
        $consulta_graus->execute();
        $resultat_graus = $consulta_graus->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return $resultat_graus;
}

?>
