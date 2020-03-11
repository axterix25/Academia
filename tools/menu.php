<nav>
 <a href="../portal.php">Home</a> 
<?php
$path= explode("/", $_SERVER["REQUEST_URI"])[2];
if ($_SESSION["usuarioRol"]=="p") {    ?>
   
    <a href="../cursos/">Mis Cursos</a>
    <a href="../profesores/">Profesores</a>
    <a href="../alumnos/">Mis Alumnos</a> 
    <?php
} elseif ($_SESSION["usuarioRol"]=="d") {        ?>

    <a href="../cursos/">Cursos</a>
    <a href="../profesores/">Profesores</a>
    <a href="../alumnos/">Alumnos</a>
    <?php    
    }
    ?>
 <a href="../LogOut.php">LogOut</a>
</nav>
<div>

    <form action="" class="searchForm">
        <input type="text" name="search" id="search" placeholder="Buscador de <?=$path?>">
        <button type="submit">Buscar</button></form>
<!-- ../ -->
</div>
