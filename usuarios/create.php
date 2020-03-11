<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo usuario</title>
    <?php
    include "database.php";
    ?>
</head>
<body>
    <!-- Sólo el director -->
<form action="" method="post">
        <label for="usuario">Nuevo profesor
            <input type="text" name="usuario">
        </label>
        <br>
        <label for="password">Password
            <input type="password" name="password" id="">
        </label>
        <br>
        <label for="E-mail">email
            <input type="text" name="email" id="">
        </label>
        <br>
        
        <input type="submit" value="Guardar">
        <input type="reset" value="Cancelar">
    </form>
    <footer>
    <?php
    include "footer.php";
    ?>
    </footer>
</body>
</html>