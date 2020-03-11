<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Ususario</title>
    <?php
    include "database.php";
    ?>
</head>
<body>
<h1> Login-Usuarios</h1>
    <form action="" method="post">
        <label for="usuario">Usuario
            <input type="text" name="usuario">
        </label>
        <br>
        <label for="password">Password
            <input type="password" name="password" id="">
        </label>
        <br>
        <input type="submit" value="Login">
        <input type="reset" value="Cancelar">
    </form>
<br>
    <!-- Sólo el director -->
    <a href="create.php">Nuevo usuario</a> | <a href="../portal.php">Volver al portal</a>
    <footer>
    <?php
    include "footer.php";
    ?>
</body>
</html>