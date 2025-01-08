<div class="container">
    <h1>Iniciar Sesión</h1>

    <?php if (!empty($mensaje)) : ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <form action="?action=Iniciar-Sesion" method="post">
        <label for="username">Nombre:</label><br>
        <input type="text" name="username" placeholder="Username" required pattern="[a-zA-Z0-9]{4,20}"><br>
        
        <label for="password">Contraseña:</label><br>
        <input type="password" name="password" placeholder="Password" required pattern="[a-zA-Z0-9]{4,20}"><br>

        <input type="submit" value="Enviar">
    </form>

