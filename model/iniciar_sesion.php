<?php

function verificarUsuario($conection, $username, $password) {
    try {
        // Consulta parametrizada para obtener el usuario
        $sql = "SELECT password FROM USERS WHERE username = :username";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y la contraseña es válida
        if ($resultado && password_verify($password, $resultado['password'])) {
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
