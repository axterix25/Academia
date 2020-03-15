<?php
   include "../tools/tools.php";
if ($_GET) {
    if (isset($_GET['cId'])) {
        $cursoId= $_GET['cId'];
   
        if (isset($_GET['acId'])) {
            $acId= $_GET['acId'];
            removeAlumnoFromCurso($acId, $cursoId);
        }

        if (isset($_GET['pcId'])) {
            $pcId= $_GET['pcId'];
            removeProfesorFromCurso($pcId, $cursoId);
        }
    } else {
        exitChangeStatus($cursoId);
    }
}


function removeProfesorFromCurso($pcId, $cursoId)
{
    include "../database.php";
    $consulta = "delete from profcur where id=$pcId";
    
    if (mysqli_query($conexion, $consulta)) {
        WriteLog('DELETE', 'profCur', "$pcId");
    } else {
        WriteLog('DELETE', 'profCur', "$pcId Error: ".mysqli_errno($conexion));
    }

    mysqli_close($conexion);
    header("location:status.php?id=$cursoId");
}

function removeAlumnoFromCurso($acId, $cursoId)
{
    include "../database.php";
    $consulta = "delete from alumncur where id=$acId";
    
    if (mysqli_query($conexion, $consulta)) {
        WriteLog('DELETE', 'alumnCur', "$acId");
    } else {
        WriteLog('DELETE', 'alumnCur', "$acId Error: ".mysqli_errno($conexion));
    }
    
    mysqli_close($conexion);
    header("location:status.php?id=$cursoId");
}

function exitChangeStatus($cursoId)
{
    header("location:status.php?id=$cursoId");
}
