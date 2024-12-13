<html lang="ca">

<head>
    <title>Registre - TDIW</title>
</head>

<body>

    <?php require __DIR__ . '/controller/llistar_mensaje_registre.php'; ?>



    <div class="container">
        <form action="?action=registre-session" method="post">
            <label for="username">Username</label><br>
            <input type="text" name="username" placeholder="username" required pattern="[a-zA-Z0-9]{4,20}"><br>
            <label for="password">Password</label><br>
            <input type="text" name="password" placeholder="password" required pattern="[a-zA-Z0-9]{4,20}"><br>
            <label for="first_name">First Name</label><br>
            <input type="text" name="first_name" placeholder="first_name" required pattern="[a-zA-Z0-9]{4,20}"><br>
            <label for="email">Email</label><br>
            <input type="text" name="email" placeholder="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"><br>
            <label for="postal">Postal</label><br>
            <input type="text" name="postal" placeholder="postal" required pattern="[0-9]{5}"><br>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>

</body>

</html>