<?php

function registrar($conection, $usuario, $password) {
    try {
        $consulta_graus = $conection->prepare("INSERT INTO USERS (username, password) VALUES (?, ?);");
        $consulta_graus->bindParam(1, $usuario, PDO::PARAM_STR);
        $consulta_graus->bindParam(2, $password, PDO::PARAM_STR);
        $consulta_graus->execute();
        return true;
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }

    return false;
}
?>
