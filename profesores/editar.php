<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="../css/style.css?x=<?=time(); ?>">
    <?php

$nombre_old='';
$apellidos_old='';
$password_old='';

    include "../database.php";
    include "../tools/tools.php";
     if ($_GET) {
         $id=(int)$_GET['id'];
         $consulta="select * from profesores where id=$id";
         $resultado=mysqli_query($conexion, $consulta);
         $datos=mysqli_fetch_row($resultado);
         $id=$datos[0];
         $nombre_old=$datos[1];
         $apellidos_old=$datos[2];
         $password_old=$datos[3];
     }
if ($_POST) {
    $id=(int)$_POST['id'];
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $password=$_POST['password'];

    // actualizo la tabla de profesores
    $consulta="update profesores set nombre='$nombre', apellidos='$apellidos', password='$password' where id=$id";

    if (mysqli_query($conexion, $consulta)) {
        // guardo la update en el log
        WriteLog('UPDATE', 'profesores', "$id $nombre $apellidos");
        header("location:index.php");
    } else {
        echo  "Se ha producido un error: ".mysqli_errno($conexion);
    }
}
    ?>

</head>

<body>
<div class="web">
<header>
<?php
    include "../tools/menu.php";
    ?>
</header>
<main>
   
    <form action="" method="post">
    <h1>Formulario modificación de profesores</h1>
        <input type="hidden" name="id" value="<?=$id?>">
        <label for="nombre">Nombre del alumno
            <input type="text" name="nombre" value="<?=$nombre_old?>">
        </label> <br>

        <label for="apellidos">Apellidos del alumno
            <input type="text" name="apellidos" value="<?=$apellidos_old?>">
        </label> <br>
        <label for="password">Password
            <input type="password" name="password" value="<?=$password_old?>">
        </label> <br>
        <input type="submit" value="Modificar">
        <input type="reset" value="Borrar">
    </form>
    </main>
        <footer>
            <?php
            include "../footer.php";
            ?>
        </footer>
    </div>
</body>
</html>