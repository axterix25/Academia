<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo curso</title>
    <link rel="stylesheet" href="../css/style.css?x=<?=time(); ?>">
    <script src="https://kit.fontawesome.com/7a7bcf719b.js" crossorigin="anonymous"></script>
    <?php
    include "../database.php";
    include "../tools/tools.php";
    
   if ($_POST) {
       $id=$_POST['id'];
       $nombre=$_POST['nombre'];
       $fecha_inicio=$_POST['fecha_inicio'];
       $fecha_final=$_POST['fecha_final'];

       $consulta="insert into cursos values(null, '$nombre',
       '$fecha_inicio','$fecha_final')";

       if (mysqli_query($conexion, $consulta)) {
           WriteLog('INSERT', 'cursos', "$nombre $fecha_inicio $fecha_final");
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
                <!-- Sólo el director -->
                <!-- Formulario de creación de curso -->

                <h1>Formulario de creación de curso</h1>

                <input type="hidden" name="id">

                <label for="nombre">Nuevo curso
                    <input type="text" name="nombre">
                </label>
                <br>
                <label for="fecha_inicio">Fecha inicio
                    <input type="date" name="fecha_inicio">
                </label>
                <br>
                <label for="fecha_final">Fecha final
                    <input type="date" name="fecha_final">
                </label>
                <br>
                <input type="submit" value="Guardar">
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