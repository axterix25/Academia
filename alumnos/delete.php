<?php
if ($_GET) {
    include "../database.php";
    include "../tools/tools.php";
    $id=(int)$_GET['id'];
    $consulta="delete from alumnos where id=$id";
    if (mysqli_query($conexion, $consulta)) {
        WriteLog('DELETE', 'alumnos', "$id");
    } else {
        echo  mysqli_errno($conexion);
    }
    print mysqli_affected_rows($conexion);
    include "../footer.php";
    header("location:index.php");
}
