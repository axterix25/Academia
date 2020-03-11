<?php
      include "tools/tools.php";
      
      $rol ="desconocido";
      $visitas=0;
      $ultimaConexion= (new DateTime())->format('Y-m-d H:i:s');
      $usuario = 'Anónimo';

    if (isset($_SESSION["usuarioId"]) && !empty($_SESSION["usuarioId"])) {
        switch ($_SESSION["usuarioRol"]) {
            case 'p':
                $rol="Profesor";
                break;
                case 'd':
                    $rol="Director";
                    break;
        }
        $visitas=$_COOKIE["NumAccesos"];
        $ultimaConexion= $_COOKIE["UltimoAcceso"];
        $usuario = $_SESSION["usuarioNombre"];

        // guardo la salida en el log
        WriteLogRoot('EXIT', 'profesores', $_SESSION["usuarioNombre"]);
        session_destroy();
    } else {
        header("location:index.php");
    }
    ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar sesión</title>
    <link rel="stylesheet" href="css/style.css?x=<?=time(); ?>">
</head>

<body>
    <div class="web">
        <header>
            <h1>Datos de acceso de <?=$usuario?></h1>
        </header>
        <main>
            <p><a href="./log/log.html">Ver el log</a></p>
            <p>Rol: <b><?=$rol ?></b></p>
            <p>Número de accesos: <b><?=$visitas?></b></p>
            <p>Fecha de la última conexión: <b><?=$ultimaConexion?></b></p>
            <a href="./index.php">Volver al inicio</a>
        </main>
        <footer>
        </footer>
    </div>
</body>

</html>