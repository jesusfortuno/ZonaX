<?php
    echo "<h1>Registro</h1>";

    // Mostrar errores si existen
    if (!empty($errors)) {
        echo "<ul style='color: red;'>";
        foreach ($errors as $error) {
            echo "<li>" . ($error) . "</li>";
        }
        echo "</ul>";
    } else {
        // Mostrar datos del registro solo si no hay errores
        echo "<p>Username: " . ($_SESSION['username']) . "</p>";
        echo "<p>Password: " . ($_SESSION['password']) . "</p>";
        echo "<p>First Name: " . ($_SESSION['first_name']) . "</p>";
        echo "<p>Email: " . ($_SESSION['email']) . "</p>";
        echo "<p>Postal: " . ($_SESSION['postal']) . "</p>";
    }
?>
