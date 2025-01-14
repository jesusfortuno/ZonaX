<?php

function registrar($conection, $nombre, $contraseña, $email, $rol) {
    try {
        $consulta = $conection->prepare("INSERT INTO usuarios (nombre, contraseña, email, rol, fecha_registro) VALUES (?, ?, ?, ?, NOW());");
        $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
        $consulta->bindParam(2, $contraseña, PDO::PARAM_STR);
        $consulta->bindParam(3, $email, PDO::PARAM_STR);
        $consulta->bindParam(4, $rol, PDO::PARAM_STR);
        $consulta->execute();
        return true;
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    return false;
}

function emailExiste($connection, $email, $rol = null) {
    try {
        $query = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
        if ($rol) {
            $query .= " AND rol = ?";
        }
        $consulta = $connection->prepare($query);
        $consulta->bindParam(1, $email, PDO::PARAM_STR);
        if ($rol) {
            $consulta->bindParam(2, $rol, PDO::PARAM_STR);
        }
        $consulta->execute();
        return $consulta->fetchColumn() > 0;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return false;
}


?>
