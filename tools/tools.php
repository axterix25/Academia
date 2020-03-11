<?php

function WriteLog($action, $tabla, $datos)
{
    $fileName = "..\log\log.html";
    $fecha= (new DateTime())->format('Y-m-d H:i:s');
    $texto    = "<li>[$fecha]-><b>$action</b> $tabla <i>$datos</i>\n";
    $file     = fopen($fileName, "a");
    fwrite($file, $texto);
    fclose($file);
}

function WriteLogRoot($action, $tabla, $datos)
{
    $fileName = ".\log\log.html";
    $fecha= (new DateTime())->format('Y-m-d H:i:s');
    $texto    = "<li>[$fecha]-><b>$action</b> $tabla <i>$datos</i>\n";
    $file     = fopen($fileName, "a");
    fwrite($file, $texto);
    fclose($file);
}

function VerifyUser(string $usuario, string $password): bool
{
    $consulta = "SELECT * FROM profesores WHERE nombre='$usuario' and `password`='$password'";

    $conexion=mysqli_connect('localhost', 'root', '', 'academia');
    $resultado = mysqli_query($conexion, $consulta);
    $datos     = mysqli_fetch_assoc($resultado);
    $registrado= false;
    
    if (mysqli_num_rows($resultado) == 1) {

        // creo las variables de sesión
        $_SESSION["usuarioId"]        = $datos['id'];
        $_SESSION["usuarioNombre"] = $datos['nombre'];
        $_SESSION["usuarioRol"] = $datos['tipo'];

        // guardo la entrada en el log

        WriteLogRoot('ENTER', 'profesores', $_SESSION["usuarioNombre"]);
        
        // cookie 1: ver la fecha del último acceso.

        $valor = date('Y/m/d H:i:s');
        $expira = time() + (3600 * 24 * 365); // 1 año
        setcookie("UltimoAcceso", $valor, $expira);

        // cookie 2: ver el número de accesos (incluido el actual)

        if (isset($_COOKIE["NumAccesos"])) {
            $valor = $_COOKIE["NumAccesos"] + 1;
        } else {
            $valor = 1;
        }

        setcookie("NumAccesos", $valor, $expira);
        $registrado=true;
    }
    mysqli_close($conexion);
   
    return $registrado;
}
