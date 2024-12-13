<?php

function getMensaje($conection, $id_info) {

    try {
        $consulta_graus = $conection->prepare("SELECT mensaje FROM MENSAJES WHERE id_info = ? ");
        $consulta_graus->bindParam(1, $id_info, PDO::PARAM_INT);
        $consulta_graus->execute();
        $resultat_graus = $consulta_graus->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    return $resultat_graus[0];
}

?>