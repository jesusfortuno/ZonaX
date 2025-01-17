<?php

// Model: Funciones para usuarios
function registrar($connection, $nombre, $contraseña, $email, $rol) {
    try {
        if ($rol === 'admin') {
            // Verificar si ya existe un administrador
            $consulta = $connection->prepare("SELECT COUNT(*) FROM usuarios WHERE rol = 'admin';");
            $consulta->execute();
            if ($consulta->fetchColumn() > 0) {
                return 'admin_existente'; // Ya hay un admin registrado
            }
        } else {
            // Verificar si el nombre o email ya existen para usuarios normales
            if (nombreExiste($connection, $nombre) || emailExiste($connection, $email)) {
                return 'usuario_existente'; // Nombre o email ya en uso
            }
        }

        // Registrar nuevo usuario
        $consulta = $connection->prepare("INSERT INTO usuarios (nombre, contraseña, email, rol, fecha_registro) VALUES (?, ?, ?, ?, NOW());");
        $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
        $consulta->bindParam(2, $contraseña, PDO::PARAM_STR);
        $consulta->bindParam(3, $email, PDO::PARAM_STR);
        $consulta->bindParam(4, $rol, PDO::PARAM_STR);
        $consulta->execute();
        return true;
    } catch (PDOException $e) {
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

function obtenerUsuarioPorNombreOEmail($connection, $nombre, $email) {
    try {
        $consulta = $connection->prepare("SELECT nombre, email, rol FROM usuarios WHERE nombre = ? OR email = ?");
        $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
        $consulta->bindParam(2, $email, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC); // Retorna el usuario encontrado o false si no existe
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
    }
    return false;
}


function verificarCredenciales($connection, $email, $contraseña) {
    try {
        $consulta = $connection->prepare("SELECT nombre, contraseña, rol FROM usuarios WHERE email = ?");
        $consulta->bindParam(1, $email, PDO::PARAM_STR);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
            return [
                'nombre' => $usuario['nombre'],
                'email' => $email,
                'rol' => $usuario['rol'] // Incluye el rol en la respuesta
            ];
        }
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
    }
    return false;
}


?>
