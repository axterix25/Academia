<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <link rel="stylesheet" href="../css/style.css?x=<?=time(); ?>">
    <?php
    include "../database.php";
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
             if ($_SESSION["usuarioRol"]=="d") {
                 print '<a href="create.php">Nuevo profesor</a>';
             }
            $consulta="select * from profesores where tipo='p'";
            if ($_SESSION["usuarioRol"]=="p") {
                $consulta.=" and id=".$_SESSION["usuarioId"];
            }
            
            $resultado=mysqli_query($conexion, $consulta);
            ?>
            <h2>Lista de profesores</h2>
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
            <td>$filas[2]</td>
            <td><a href='delete.php?id=$filas[0]'>Borrar</a> 
            <a href='editar.php?id=$filas[0]'>Editar</a> 
            <a href='../cursos/?idp=$filas[0]&profesor=$filas[1]'>Ver cursos</a> 
            <a href='../alumnos/?idp=$filas[0]&profesor=$filas[1]'>Ver alumnos</a> ";
            if ($_SESSION["usuarioRol"]=="d") {
                print"<a class='asignCurso' data-profesorId='$filas[0]' data-profesor='$filas[1]'href='#'>Asignar curso</a>";
            }
            print"</td></tr>";
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
                <h2>Asignación de Cursos a profesores</h2>
            </div>
            <div class="modal-body">
                <p>Asignando un curso a <span id="profesor"></span></p>
                <p>Mostrando cursos que no tienen aún profesores asginados, marca uno del desplegable y pulsa el botón
                    de asignar</p>
                <form action="addCursoToProfesor.php" method="post">
                    <input type="hidden" name="profesorId" id="profesorId" value="">
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
    <script src="../js/openModalProfesores.js?x=<?=time(); ?>"></script>
</body>

</html>