<?php
function qryAlumnos()
{
    return "select * from alumnos";
}

function qryAlumnosByProfesor($profesorId)
{
    return "select a.id as id, a.nombre as nombre, a.apellidos as apellidos from profcur pc 
    inner join alumncur ac on pc.cursoId = ac.cursoId
    inner join alumnos a on a.id =ac.alumnoId 
    inner join cursos c on c.id = pc.cursoId 
    where pc.profesorId=$profesorId";
}

function qryAlumnosByProfesorCurso($profesorId, $cursoId)
{
    return "select a.id as id, a.nombre as nombre, a.apellidos as apellidos from profcur pc 
    inner join alumncur ac on pc.cursoId = ac.cursoId
    inner join alumnos a on a.id =ac.alumnoId 
    inner join cursos c on c.id = pc.cursoId 
    where pc.profesorId=$profesorId and c.id=$cursoId";
}

function qryAlumnosByCurso($cursoId)
{
    return "select a.id as id, a.nombre as nombre, a.apellidos as apellidos from profcur pc 
    inner join alumncur ac on pc.cursoId = ac.cursoId
    inner join alumnos a on a.id =ac.alumnoId 
    inner join cursos c on c.id = pc.cursoId 
    where c.id=$cursoId";
}
