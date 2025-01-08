<?php

function verificarUsuario($conection, $nombre, $contraseña) {
    try {
        // Consulta parametrizada para obtener el usuario
        $sql = "SELECT contraseña FROM USUARIOS WHERE nombre = :nombre";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y la contraseña es válida
        if ($resultado && password_verify($contraseña, $resultado['contraseña'])) {
            return true; // Usuario válido
        } else {
            return false; // Usuario o contraseña incorrectos
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>
