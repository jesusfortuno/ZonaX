<?php

function registrar($conection, $nombre, $email, $contraseña) {
    try {
        $consulta = $conection->prepare("INSERT INTO usuarios (nombre, email, contraseña, fecha_registro) VALUES (?, ?, ?, NOW());");
        $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
        $consulta->bindParam(2, $email, PDO::PARAM_STR);
        $consulta->bindParam(3, $contraseña, PDO::PARAM_STR);
        $consulta->execute();
        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return false;
}

function obtenerUsuarioPorNombre($conection, $nombre) {
    try {
        $consulta = $conection->prepare("SELECT id_usuario, nombre, email, fecha_registro FROM usuarios WHERE nombre = ? LIMIT 1;");
        $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return null;
}

?>