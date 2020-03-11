<?php
if (!isset($_SESSION["usuarioId"]) || empty($_SESSION["usuarioId"])) {
    header("location:../index.php");
    exit();
} elseif ($_SESSION["usuarioRol"]=='p') {
    $conexion=mysqli_connect('localhost', 'root', '', 'academia');
} else {
    $conexion=mysqli_connect('localhost', 'root', '', 'academia');
}
