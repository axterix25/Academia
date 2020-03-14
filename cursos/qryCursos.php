<?php
function qryCursos()
{
    return "select c.*, count(ac.alumnoId) as numAlumnos from cursos c left join alumncur ac on c.id = ac.cursoId group by c.id";
}

function qryCursosWithParam($param)
{
    return "select c.*, count(ac.alumnoId) as numAlumnos from cursos c left join alumncur ac on c.id = ac.cursoId where c.nombre like '%$param%' group by c.id ";
}


function qryCursosByProfesor($profesorId)
{
    return "select c.id, c.nombre, c.fecha_inicio, c.fecha_final from cursos c inner join profcur pc on c.id = pc.cursoId where pc.profesorId=$profesorId";
}

function qryCursosByProfesorAlumno($profesorId, $alumnoId)
{
    return "select c.id, c.nombre , c.fecha_inicio, c.fecha_final from  cursos c 
    inner join profcur pc on c.id = pc.cursoId 
    inner join alumncur ac on c.id = ac.cursoId
    inner join alumnos a on a.id = ac.alumnoId 
    inner join profesores p on p.id = pc.profesorId
    where a.id=$alumnoId and pc.profesorId=$profesorId";
}

function qryCursosByAlumno($alumnoId)
{
    return "select c.id, c.nombre , c.fecha_inicio, c.fecha_final from  alumncur ac 
    inner join profcur pc on ac.cursoId = pc.cursoId
    inner join alumnos a on ac.alumnoId =a.id
    inner join profesores p on pc.profesorId =p.id
    inner join cursos c on c.id =pc.id
    where a.id=$alumnoId";
}

function qryCursosStatus($cursoId)
{
    return "select c.id as cursoId, c.nombre as curso, c.fecha_inicio, c.fecha_final, 
    if(curdate() between c.fecha_inicio and c.fecha_final, 'En curso',if (c.fecha_final < curdate(),'Terminado','Sin empezar')) as status,
    a.id as alumnoId, concat(a.nombre , ' ', a.apellidos ) as alumno, p.id as profesorId, concat(p.nombre , ' ', p.apellidos ) as profesor
    from cursos c 
    left join profcur pc on c.id = pc.cursoId 
    left join alumncur ac on c.id = ac.cursoId
    left join alumnos a on a.id = ac.alumnoId 
    left join profesores p on p.id = pc.profesorId
    where c.id=$cursoId;
    ";
}
