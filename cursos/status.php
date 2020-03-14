<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado curso</title>
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

            $cursoId="";
            $doWork= false;
            $mensaje="";

            if ($_SESSION["usuarioRol"]=="d") {
                if ($_GET) {
                    if (isset($_GET["id"])) {
                        $cursoId=$_GET["id"];
                        $mensaje="";
                        $doWork=true;
                    } else {
                        $mensaje="Los parámetros de entrada no son válidos. La consulta no se puede realizar";
                    }
                } else {
                    $mensaje="Faltan parámetros. La consulta no se puede realizar";
                }
            } else {
                $mensaje="Esta página está reservada para el director";
            }
            ?>
            <h2><?=$mensaje?></h2>

            <?php
            $resultado="";
            if ($doWork) {
                $consulta=qryCursosStatus($cursoId);
              
                $resultado=mysqli_query($conexion, $consulta);

                $num_alumnos= mysqli_num_rows($resultado);

                $firstrow = mysqli_fetch_assoc($resultado);

                $curso =$firstrow["curso"];
                $profesor=$firstrow["profesor"] == null? "Sin asignar": $firstrow["profesor"];
                $status= $firstrow["status"];
                $f_inicio=$firstrow["fecha_inicio"];
                $f_fin=$firstrow["fecha_final"];
                $alumno=$firstrow["alumno"];

                if ($alumno == null) {
                    $num_alumnos=0;
                }
                
                // reset the result resource
                mysqli_data_seek($resultado, 0);
            }
            ?>

            <div class="status-panel">
                <div class="curso">
                    <ul>
                        <li>
                            <h2>Nombre del curso: <?=$curso?></h2>
                            <p>Fecha de inicio: <strong><?=$f_inicio?></strong></p>
                            <p>Fecha de finalización: <strong><?=$f_fin?></strong></p>
                            <p>Profesor: <strong><?=$profesor?></strong></p>
                            <p>Status: <?=$status?></p>
                        </li>
                        <li>
                            <h2>Núm alumnos: <?=$num_alumnos?></h2>
                            <?php
                            if ($num_alumnos>0) {
                                while ($filas=mysqli_fetch_assoc($resultado)) {
                                    $alumnoId=$filas["alumnoId"];
                                    $alumno=$filas["alumno"];
                                    print "<p> $alumnoId $alumno</p>";
                                }
                            } else {
                                print "<p>Este curso no tiene alumnos apuntados</p>";
                            }
                        ?>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
        <footer>
            <?php
            include "../footer.php";
            ?>
        </footer>

    </div>
</body>

</html>