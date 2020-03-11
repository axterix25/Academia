<?php
    if (!isset($_SESSION["usuarioId"]) || empty($_SESSION["usuarioId"])) {
        echo"# No hay usuario registrado";
        header("location:./index.php");
        exit();
    }
    ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal academia</title>
    <link rel="stylesheet" href="css/style.css?x=<?=time(); ?>">
</head>

<body>
<div class="web">
    <header>
        <nav>
        <a href="./">Home</a> 
        <a href="./cursos/">Cursos</a>
        <a href="./profesores/">Profesores</a>
        <a href="./alumnos/">Alumnos</a>
        <a href="./LogOut.php">LogOut</a>
</nav>
    </header>
    <main></main>
    <footer>
    </footer>
</div>
</body>

</html>