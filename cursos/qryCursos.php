<?php
function qryCursos()
{
    return "select c.*, count(ac.alumnoId) as numAlumnos from cursos c left join alumncur ac on c.id = ac.cursoId group by c.id";
}

function qryCursosByProfesor($profesorId)
{
    return "select c.id, c.nombre, c.fecha_inicio, c.fecha_final from cursos c inner join profcur pc on c.id = pc.cursoId where pc.profesorId=$profesorId";
}

function qryCursosByProfesorAlumno($profesorId, $alumnoId)
{
    return "select c.id, c.nombre , c.fecha_inicio, c.fecha_final from  alumncur ac 
    inner join profcur pc on ac.cursoId = pc.cursoId
    inner join alumnos a on ac.alumnoId =a.id
    inner join profesores p on pc.profesorId =p.id
    inner join cursos c on c.id =pc.id
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
