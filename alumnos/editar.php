<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="../css/style.css?x=<?=time(); ?>">
    <script src="https://kit.fontawesome.com/7a7bcf719b.js" crossorigin="anonymous"></script>
    <?php
    include "../database.php";
    include "../tools/tools.php";
     if ($_GET) {
         $id=(int)$_GET['id'];
         $consulta="select * from alumnos where id=$id";
         $resultado=mysqli_query($conexion, $consulta);
         $datos=mysqli_fetch_row($resultado);
         $id=$datos[0];
         $nombre=$datos[1];
         $apellidos=$datos[2];
     }
if ($_POST) {
    $id=(int)$_POST['id'];
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];

    $consulta="update alumnos set nombre='$nombre', apellidos='$apellidos' 
    where id=$id";

    if (mysqli_query($conexion, $consulta)) {
        WriteLog('UPDATE', 'alumnos', "$id $nombre $apellidos");
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
                <h1>Formulario de modificación del alumno</h1>
                <input type="hidden" name="id" value="<?=$id?>">
                <label for="nombre">Nombre del alumno
                    <input type="text" name="nombre" value="<?=$nombre?>">
                </label> <br>

                <label for="apellidos">Apellidos del alumno
                    <input type="text" name="apellidos" value="<?=$apellidos?>">
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