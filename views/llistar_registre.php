<?php
    echo "<h1>Registro</h1>";

    if (!empty($errors)) {
        echo "<ul style='color: red;'>";
        foreach ($errors as $error) {
            echo "<li>" . ($error) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nombre: " . ($_POST['nombre']) . "</p>";
        echo "<p>Email: " . ($_POST['email']) . "</p>";
        echo "<p>Rol: " . ($_POST['rol'] === 'admin' ? 'Administrador' : 'Usuario') . "</p>";
        echo "<p>Fecha de registro: " . date('Y-m-d H:i:s') . "</p>";
    }
?>

