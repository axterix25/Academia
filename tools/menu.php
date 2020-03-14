<nav>
    <a href="../portal.php"><i class="fas fa-home"></i></a>
    <?php
    $path= explode("/", $_SERVER["REQUEST_URI"])[2];
    if ($_SESSION["usuarioRol"]=="p") {
        ?>
    <a href="../cursos/"><i class="fas fa-school"></i></a>
    <a href="../profesores/"><i class="fas fa-user-graduate"></i></a>
    <a href="../alumnos/"><i class="fas fa-user"></i></a>
    <?php
    } elseif ($_SESSION["usuarioRol"]=="d") {
        ?>
    <a href="../cursos/"><i class="fas fa-school"></i></a>
    <a href="../profesores/"><i class="fas fa-user-graduate"></i></a>
    <a href="../alumnos/"><i class="fas fa-user"></i></a>   
    <?php
    }
    ?>
    <a href="../LogOut.php"><i class="fas fa-sign-out-alt"></i></a>
    <a href="../help.php"><i class="far fa-question-circle"></i></a>
    <form action="index.php" class="searchForm" method="get">
        <input type="text" name="search" id="search" placeholder="Buscador de <?=$path?>">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
</nav>