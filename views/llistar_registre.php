<?php
    echo "<h1>Registro</h1>";

    // Mostrar errores si existen
    if (!empty($errors)) {
        echo "<ul style='color: red;'>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    } elseif (!empty($mensaje)) {
        // Mostrar mensaje de éxito o error
        echo "<p style='color: green;'>" . htmlspecialchars($mensaje) . "</p>";

        if (!empty($usuario)) {
            echo "<p>ID Usuario: " . htmlspecialchars($usuario['id_usuario']) . "</p>";
            echo "<p>Nombre: " . htmlspecialchars($usuario['nombre']) . "</p>";
            echo "<p>Email: " . htmlspecialchars($usuario['email']) . "</p>";
            echo "<p>Fecha de registro: " . htmlspecialchars($usuario['fecha_registro']) . "</p>";
        }
    }
?>