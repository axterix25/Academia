<?php
if (!isset($_SESSION["usuarioId"]) || empty($_SESSION["usuarioId"])) {
    echo"# No hay usuario registrado";
    exit();
} elseif ($_SESSION["usuarioRol"]=='p') {
    echo"#".$_SESSION["usuarioNombre"]." se conecta como profesor";
} else {
    echo"#".$_SESSION["usuarioNombre"]." se conecta como director";
}
mysqli_close($conexion);
