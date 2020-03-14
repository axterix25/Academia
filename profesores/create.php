<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo alumno</title>
    <link rel="stylesheet" href="../css/style.css?x=<?=time(); ?>">
    <script src="https://kit.fontawesome.com/7a7bcf719b.js" crossorigin="anonymous"></script>
    <?php
   include "../database.php";
   include "../tools/tools.php";

   if ($_POST) {
       $nombre=$_POST['nombre'];
       $apellidos=$_POST['apellidos'];
       $password=$_POST['password'];

       $consulta="insert into profesores values(null,'$nombre','$apellidos','$password','p')";

       if (mysqli_query($conexion, $consulta)) {
           WriteLog('INSERT', 'profesores', "$nombre $apellidos");
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
 <h1>Formulario de creación de Profesores</h1>
        <label for="nombre">Nombre del profesor
            <input type="text" name="nombre">
        </label> <br>

        <label for="apellidos">Apellidos del profesor
            <input type="text" name="apellidos">
        </label> <br>
        <label for="password">Password
            <input type="password" name="password">
        </label> <br>
        <input type="submit" value="Añadir">
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