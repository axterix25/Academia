select id, concat(nombre, " ", apellidos) as nombre from alumnos where id not in(
select ac.alumnoId from cursos c inner join alumncur ac on c.id = ac.cursoId where c.id =1);  


select * from cursos c  where c.id =1

select ac.alumnoId from cursos c inner join alumncur ac on c.id = ac.cursoId where c.id =8

select * from  alumnos a2 order by nombre 


select c.id as cursoId, c.nombre as curso, c.fecha_inicio, c.fecha_final, 
if(curdate() between c.fecha_inicio and c.fecha_final, 'En curso',if (c.fecha_final < curdate(),'Terminado','Sin empezar')) as status,
a.id as alumnoId, concat(a.nombre , ' ', a.apellidos ) as alumno, p.id as profesorId, concat(p.nombre , ' ', p.apellidos ) as profesor
from cursos c 
left join profcur pc on c.id = pc.cursoId 
left join alumncur ac on c.id = ac.cursoId
left join alumnos a on a.id = ac.alumnoId 
left join profesores p on p.id = pc.profesorId
where c.id=1;

select CURDATE() as hoy;

SELECT CURRENT_DATE() + 30;

select * from cursos c2

update cursos set fecha_final = date_add(CURRENT_DATE(), interval 1 month) where id =8; 

select *, if(curdate() between c.fecha_inicio and c.fecha_final, 'En curso',if (c.fecha_final < curdate(),'Terminado','Sin empezar')) from cursos c


select c.id, c.nombre , c.fecha_inicio, c.fecha_final, if(curdate() between c.fecha_inicio and c.fecha_final, 'En curso',if (c.fecha_final < curdate(),'Terminado','Sin empezar')) as status from  cursos c 
left join profcur pc on c.id = pc.cursoId 
left join alumncur ac on c.id = ac.cursoId
left join alumnos a on a.id = ac.alumnoId 
left join profesores p on p.id = pc.profesorId;

    select c.*, count(ac.alumnoId) as numAlumnos from cursos c left join alumncur ac on c.id = ac.cursoId where c.nombre like '%in%' group by c.id 
    
    

    select a.id as id, a.nombre as nombre, a.apellidos as apellidos from cursos c 
    inner join alumncur ac on c.id = ac.cursoId
    inner join alumnos a on a.id =ac.alumnoId  
    where c.id=12;
    