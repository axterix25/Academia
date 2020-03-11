select id, concat(nombre, " ", apellidos) as nombre from alumnos where id not in(
select ac.alumnoId from cursos c inner join alumncur ac on c.id = ac.cursoId where c.id =1);  


select * from cursos c  where c.id =1

select ac.alumnoId from cursos c inner join alumncur ac on c.id = ac.cursoId where c.id =8

select * from  alumnos a2 order by nombre 


select c.nombre, concat(a.nombre , " ", a.apellidos ) as alumno, p.nombre as profesor from cursos c 
inner join profcur pc on c.id = pc.cursoId 
inner join alumncur ac on c.id = ac.cursoId
inner join alumnos a on a.id = ac.alumnoId 
inner join profesores p on p.id = pc.profesorId 
where c.id =1

select *
from profesores p 
