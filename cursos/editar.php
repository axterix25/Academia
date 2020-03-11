<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="../css/style.css?x=<?=time(); ?>">
    <?php
    include "../database.php";
    include "../tools/tools.php";
     if ($_GET) {
         $id=(int)$_GET['id'];
         $consulta="select * from cursos where id=$id";
         $resultado=mysqli_query($conexion, $consulta);
         $datos=mysqli_fetch_row($resultado);
         $id=$datos[0];
         $nombre=$datos[1];
         $fecha_inicio=$datos[2];
         $fecha_final=$datos[3];
     }
if ($_POST) {
    $id=(int)$_POST['id'];
    $nombre=$_POST['nombre'];
    $fecha_inicio=$_POST['fecha_inicio'];
    $fecha_final=$_POST['fecha_final'];

    $consulta="update cursos set nombre='$nombre',fecha_inicio='$fecha_inicio', 
    fecha_final='$fecha_final' where id=$id";

    if (mysqli_query($conexion, $consulta)) {
        WriteLog('UPDATE', 'cursos', "$id $nombre $fecha_inicio $fecha_final");
        header("location:index.php");
    } else {
        echo  mysqli_errno($conexion);
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
                <h1>Formulario de modificación del curso</h1>
                <input type="hidden" name="id" value="<?=$id?>">

                <label for="nombre">Nombre del curso
                    <input type="text" name="nombre" value="<?=$nombre?>">
                </label> <br>

                <label for="fecha_inicio">Fecha de inicio
                    <input type="date" name="fecha_inicio" value="<?=$fecha_inicio?>">
                </label> <br>

                <label for="fecha_final">Fecha final
                    <input type="date" name="fecha_final" value="<?=$fecha_final?>">
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