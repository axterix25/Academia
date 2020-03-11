<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="../css/style.css?x=<?=time(); ?>">
    <?php
    include "../database.php";
    include "qryCursos.php";
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
    $porAlumno=false;
    $porProfesor=false;
    $showCounter=false;


    if ($_SESSION["usuarioRol"]=="d") {
        print '<a href="create.php">Nuevo curso</a>';

        if ($_GET) {
            if (isset($_GET["id"])) {
                $alumnoId= $_GET["id"];
                $alumno= $_GET["alumno"];
                $porAlumno=true;
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
                $alumnoId= $_GET["id"];
                $alumno= $_GET["alumno"];
                $porAlumno=true;
            }
        }
    }

    if ($porProfesor && $porAlumno) {
        $consulta=qryCursosByProfesorAlumno($profesorId, $alumnoId);
        $mensaje="Todos los cursos que imparte $profesor a $alumno";
    } elseif ($porAlumno) {
        $consulta=qryCursosByAlumno($alumnoId);
        $mensaje="Todos los cursos que recibe $alumno";
    } elseif ($porProfesor) {
        $consulta=qryCursosByProfesor($profesorId);
        $mensaje="Cursos que imparte $profesor";
    } else {
        $consulta=qryCursos();
        $showCounter=true;
        $mensaje="Todos los cursos de la academia";
    }
   
    $resultado=mysqli_query($conexion, $consulta);

?>
            <h2><?=$mensaje?></h2>
            <p>Si visualizas un curso y no puedes ver los alumnos es porque dicho curso no tiene un profesor asignado. <a href="../profesores/">Ir a profesores</a></p>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha inicio</th>
                    <th>Fecha final</th>
                </tr>

                <?php
    $filas='';
    if ($resultado!='') {
        while ($filas=mysqli_fetch_row($resultado)) {
            print"<tr> <td>$filas[0]</td> 
            <td>$filas[1]";
            
            //muestra el nº de alumnos por clase
            if ($showCounter) {
                print "(<span class=\"counter\">$filas[4]</span>)";
            }
            
            print"</td> 
            <td>$filas[2]</td>
            <td>$filas[3]</td>";
            if ($_SESSION["usuarioRol"]=="d") {
                print "<td><a href='delete.php?id=$filas[0]'>Borrar</a></td> 
            <td><a href='editar.php?id=$filas[0]'>Editar</a></td>
            <td><a class=\"addAlumno\" data-cursoId= \"$filas[0]\" data-curso= \"$filas[1]\" href=\"#\">Añadir alumno</a></td>";
            }
            print "<td><a href='../alumnos/?id=$filas[0]&curso=$filas[1]'>Ver alumnos</a></td></tr>";
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
        <h2>Asignación de Cursos a alunos</h2>
    </div>
    <div class="modal-body">
        <p>Asignación alumnos al curso de <span id="curso"></span></p>
        <p>Mostrando alumnos que no han realizado el curso, marca uno del desplegable y pulsa el botón
            de asignar</p>
        <form action="addAlumnoToCurso.php" method="post">
            <input type="hidden" name="cursoId" id="cursoId" value="">
            <select name="alumnos" id="alumnos">
                <option value="0" disabled selected>Selecciona un alumno</option>
            </select>
            <button id="asignar" type="button">Asignar</button>
        </form>
    </div>
    <div class="modal-footer">
        <h3 id="result"></h3>
    </div>
</div>
</div>
<script src="../js/openModalCursos.js?x=<?=time(); ?>"></script>
</body>

</html>