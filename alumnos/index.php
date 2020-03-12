<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <link rel="stylesheet" href="../css/style.css?x=<?=time(); ?>">
    <?php
    include "../database.php";
    include "qryAlumnos.php";
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
          

            <?php

$mensaje="";
$porCurso=false;
$porProfesor=false;

if ($_SESSION["usuarioRol"]=="d") {
    print '  <a href="create.php">Nuevo alumno</a>';
    if ($_GET) {
        if (isset($_GET["id"])) {
            $cursoId= $_GET["id"];
            $curso= $_GET["curso"];
            $porCurso=true;
        }
        if (isset($_GET["idp"])) {
            $profesorId= $_GET["idp"];
            $profesor= $_GET["profesor"];
            $porProfesor=true;
        }
    }
}

if ($_SESSION["usuarioRol"]=="p") {
    $profesorId=$_SESSION["usuarioId"];
    $profesor=$_SESSION["usuarioNombre"];
    $porProfesor=true;
    if ($_GET) {
        if (isset($_GET["id"])) {
            $cursoId= $_GET["id"];
            $curso= $_GET["curso"];
            $porCurso=true;
        }
    }
}

if ($porCurso && $porProfesor) {
    $consulta=qryAlumnosByProfesorCurso($profesorId, $cursoId);
    $mensaje="Alumnos de $curso impartido por $profesor";
} elseif ($porCurso) {
    $consulta=qryAlumnosByCurso($cursoId);
    $mensaje="Alumnos del curso de $curso";
} elseif ($porProfesor) {
    $consulta=qryAlumnosByProfesor($profesorId);
    $mensaje="Alumnos de $profesor";
} else {
    $consulta=qryAlumnos();
    $mensaje="Alumnos de la academia";
}

    $resultado=mysqli_query($conexion, $consulta);
    ?>
            <h2><?=$mensaje?></h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th></th>
                </tr>

                <?php
    $filas='';
    if ($resultado!='') {
        while ($filas=mysqli_fetch_row($resultado)) {
            print"<tr> <td>$filas[0]</td> 
            <td>$filas[1]</td> 
            <td>$filas[2]</td>";
            print "<td>";
            if ($_SESSION["usuarioRol"]=="d") {
                print "<a href='delete.php?id=$filas[0]'>Borrar</a>
                <a href='editar.php?id=$filas[0]'>Editar</a>
                <a class='asignCurso' data-alumnoId='$filas[0]' data-alumno='$filas[1] $filas[2]' href='#'>Asignar curso</a>";
            }
            print "<a href='../cursos/?id=$filas[0]&alumno=$filas[1] $filas[2]'>Ver cursos</a></td></tr>";
        }
    }
    ?>
            </table>
        </main>
        <footer>
            <?php
            include "../footer.php";
            ?>
        </footer>
    </div>
    <div id="myModal" class="modal">

<div class="modal-content">
    <div class="modal-header">
        <span class="close">&times;</span>
        <h2>Asignación de Cursos a alumnos</h2>
    </div>
    <div class="modal-body">
        <p>Asignando un curso a <span id="alumno"></span></p>
        <p>Mostrando cursos que aún no ha realizado el alumno, marca uno del desplegable y pulsa el botón de asignar</p>
        <form action="addCursoToAlumno.php" method="post">
            <input type="hidden" name="alumnoId" id="alumnoId" value="">
            <select name="cursos" id="cursos">
                <option value="0" disabled selected>Selecciona un curso</option>
            </select>
            <button id="asignar" type="button">Asignar</button>
        </form>
    </div>
    <div class="modal-footer">
        <h3 id="result"></h3>
    </div>
</div>
</div>
<script src="../js/openModalAlumnos.js?x=<?=time(); ?>"></script>
</body>

</html>