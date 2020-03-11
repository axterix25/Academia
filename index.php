<?php
    include "tools/tools.php";

    $mensaje='';

    if ($_POST) {
        if (VerifyUser($_POST['usuario'], $_POST['password'])) {
            header("location:./portal.php");
        } else {
            $mensaje="Nombre de usuario o contraseña incorrectos";
        }
    }
    
    ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/style.css?x=<?=time(); ?>">
</head>

<body>
    <div class="web">
        <header>
            <h1>Visita Formater</h1>
        </header>
        <main>
            <form action="" method="post">
                <label for="usuario">Usuario
                    <input type="text" name="usuario" placeholder="nombre de usuario">
                </label>
                <br>
                <label for="password">Password
                    <input type="password" name="password" id="" placeholder="tu password">
                </label>
                <br>
                <input type="submit" value="Enviar">
                <input type="reset" value="cancelar">
            </form>
            <div class="error"><?=$mensaje?></div>
        </main>
        <footer>
        </footer>
        </web>
</body>

</html>