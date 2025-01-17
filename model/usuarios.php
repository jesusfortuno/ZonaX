<?php

// Model: Funciones para usuarios
function registrar($connection, $nombre, $contraseña, $email) {
    try {
        $consulta = $connection->prepare("INSERT INTO usuarios (nombre, contraseña, email, fecha_registro) VALUES (?, ?, ?, NOW());");
        $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
        $consulta->bindParam(2, $contraseña, PDO::PARAM_STR);
        $consulta->bindParam(3, $email, PDO::PARAM_STR);
        $consulta->execute();
        return true;
    } catch(PDOException $e) {
        error_log("Error: " . $e->getMessage());
    }
    return false;
}

function nombreExiste($connection, $nombre) {
    try {
        $consulta = $connection->prepare("SELECT COUNT(*) FROM usuarios WHERE nombre = ?;");
        $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchColumn() > 0;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return false;
}

function emailExiste($connection, $email) {
    try {
        $consulta = $connection->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
        $consulta->bindParam(1, $email, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
    }
    return false;
}

function verificarCredenciales($connection, $email, $contraseña) {
    try {
        $consulta = $connection->prepare("SELECT nombre, contraseña FROM usuarios WHERE email = ?");
        $consulta->bindParam(1, $email, PDO::PARAM_STR);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
            return ['nombre' => $usuario['nombre'], 'email' => $email];
        }
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
    }
    return false;
}

?>
