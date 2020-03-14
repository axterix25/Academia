<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="../css/style.css?x=<?=time(); ?>">
    <script src="https://kit.fontawesome.com/7a7bcf719b.js" crossorigin="anonymous"></script>
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
    $param="";
    $porParam=false;

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
            if (isset($_GET['search'])) {
                $param=$_GET['search'];
                $porParam=true;
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
            if (isset($_GET['search'])) {
                $param=$_GET['search'];
                $porParam=true;
            }
        }
    }

    if ($porProfesor && $porAlumno) {
        $consulta=qryCursosByProfesorAlumno($profesorId, $alumnoId);
        $mensaje="Cursos que imparte $profesor a $alumno";
    } elseif ($porAlumno) {
        $consulta=qryCursosByAlumno($alumnoId);
        $mensaje="Cursos que recibe $alumno";
    } elseif ($porProfesor) {
        $consulta=qryCursosByProfesor($profesorId);
        if ($porParam) {
            $consulta.=" and c.nombre like '%$param%'";
        }
        $mensaje="Cursos que imparte $profesor";
    } else {
        if ($porParam) {
            $consulta=qryCursosWithParam($param);
        } else {
            $consulta=qryCursos();
        }

        $showCounter=true;
        $mensaje="Cursos de la academia";
    }
   
    $resultado=mysqli_query($conexion, $consulta);

?>
            <h2><?=$mensaje?></h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha inicio</th>
                    <th>Fecha final</th>
                    <th colspan="4"></th>
                </tr>

                <?php
    $filas='';
    if ($resultado!='') {
        while ($filas=mysqli_fetch_row($resultado)) {
            print"<tr><td>$filas[0]</td>";
                        
            //muestra el nº de alumnos por clase y muetras el link a status
            if ($showCounter) {
                print "<td><a href=\"status.php?id=$filas[0]\">$filas[1]</a>(<span class=\"counter\">$filas[4]</span>)</td>";
            } else {
                print "<td>$filas[1]</td>";
            }
            
            print "<td>$filas[2]</td>
            <td>$filas[3]</td>";
            print "<td>";
            if ($_SESSION["usuarioRol"]=="d") {
                print "<a href='delete.php?id=$filas[0]'><i class=\"fas fa-trash-alt\"></i></a><a href='editar.php?id=$filas[0]'><i class=\"fas fa-edit\"></i></a><a class=\"addAlumno\" data-cursoId= \"$filas[0]\" data-curso= \"$filas[1]\" href=\"#\"><i class=\"fas fa-user-plus\"></i></a>";
            }

            if ($filas[4]>0) {
                print "<a href='../alumnos/?id=$filas[0]&curso=$filas[1]'><i class=\"fas fa-users\"></i></a></td>";
            } else {
                print "<a href='#'><i class=\"fas fa-users\"></i></a></td>";
            }
            print "</tr>";
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
        <form action="addAlumnoToCurso.php" method="post" class="modal-form">
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