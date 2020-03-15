<?php
include "tools.php";

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
   
    if (isset($_POST['cursoId'])) {
        $cursoId= $_POST['cursoId'];
    }

    if (isset($_POST['profesorId'])) {
        $profesorId= $_POST['profesorId'];
    }

    if (isset($_POST['alumnoId'])) {
        $alumnoId= $_POST['alumnoId'];
    }

    switch ($action) {
        case 'getCursosSinProfesor': getCursosSinProfesor();break;
        case 'addCursoToProfesor': addCursoToProfesor($cursoId, $profesorId);break;
        case 'getCursosSinCursar':getCursosSinCursar($alumnoId);break;
        case 'addCursoToAlumno':addCursoToAlumno($cursoId, $alumnoId);break;
        case 'getAlumnosSinCursarCurso':getAlumnosSinCursarCurso($cursoId);break;
    }
}

function getCursosSinProfesor()
{
    $return_arr = array();

    $consulta = "select c.id, c.nombre from cursos c left join profcur pc on c.id = pc.cursoId where pc.cursoId is null";
    $conexion=mysqli_connect('localhost', 'root', '', 'academia');
    $resultado = mysqli_query($conexion, $consulta);

    while ($row = mysqli_fetch_array($resultado)) {
        $id = $row['id'];
        $nombre = $row['nombre'];
        $return_arr[] = array("id" => $id, "nombre" => $nombre);
    }

    echo json_encode($return_arr);
}

function addCursoToProfesor($cursoId, $profesorId)
{
    $consulta = "insert into profcur values(null, $profesorId, $cursoId)";
    $conexion=mysqli_connect('localhost', 'root', '', 'academia');

    if (mysqli_query($conexion, $consulta)) {
        WriteLog('INSERT', 'profCur', "$profesorId-$cursoId");
        echo "Se ha dado de alta al profesor en el curso solicitado";
    } else {
        WriteLog('INSERT', 'profCur', "$profesorId-$cursoId Error: ". mysqli_errno($conexion));
        echo "Se ha producido un error: ". mysqli_errno($conexion);
    }
}

function getCursosSinCursar($alumnoId)
{
    $return_arr = array();

    $consulta = "select c.id, c.nombre from cursos c where c.id not in(select d.cursoId from alumncur d where d.alumnoId =$alumnoId)";
    $conexion=mysqli_connect('localhost', 'root', '', 'academia');
    $resultado = mysqli_query($conexion, $consulta);

    while ($row = mysqli_fetch_array($resultado)) {
        $id = $row['id'];
        $nombre = $row['nombre'];
        $return_arr[] = array("id" => $id, "nombre" => $nombre);
    }

    echo json_encode($return_arr);
}

function addCursoToAlumno($cursoId, $alumnoId)
{
    $consulta = "insert into alumncur values(null, $alumnoId, $cursoId)";
    $conexion=mysqli_connect('localhost', 'root', '', 'academia');

    if (mysqli_query($conexion, $consulta)) {
        WriteLog('INSERT', 'alumncur', "$alumnoId-$cursoId");
        echo "OK";
    } else {
        if (mysqli_errno($conexion)==1062) {
            WriteLog('INSERT', 'alumncur', "$alumnoId-$cursoId Error: Este alumno ya había sido inscrito en el curso anteriormente");
            echo "Este alumno ya había sido inscrito en el curso anteriormente";
        } else {
            WriteLog('INSERT', 'alumncur', "$alumnoId-$cursoId Error: ". mysqli_errno($conexion));
            echo "Se ha producido un error: ". mysqli_errno($conexion);
        }
    }
}

function getAlumnosSinCursarCurso($cursoId)
{
    $return_arr = array();

    $consulta = "select id, concat(nombre, \" \", apellidos) as nombre from alumnos where id not in(
        select ac.alumnoId from cursos c inner join alumncur ac on c.id = ac.cursoId where c.id =$cursoId)";
    $conexion=mysqli_connect('localhost', 'root', '', 'academia');
    $resultado = mysqli_query($conexion, $consulta);

    while ($row = mysqli_fetch_array($resultado)) {
        $id = $row['id'];
        $nombre = $row['nombre'];
        $return_arr[] = array("id" => $id, "nombre" => $nombre);
    }

    echo json_encode($return_arr);
}
