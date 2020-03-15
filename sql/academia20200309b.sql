drop database if exists academia;

create database academia;

use academia;

-- tablas principales
create table Cursos(
id int auto_increment primary key,
nombre varchar(50),
fecha_inicio date,
fecha_final date
);

create table Profesores(
id int auto_increment primary key,
nombre varchar (50),
apellidos varchar(50),
password varchar(5),
tipo varchar(1) /*  1 profesor 2 director  */
);

create table Alumnos(
id int auto_increment primary key,
nombre varchar(50),
apellidos varchar(50)
);

-- Tablas de movimientos 
create table AlumnCur(
id int auto_increment primary key,
alumnoId int,
cursoId int
);

create table ProfCur(
id int auto_increment primary key,
profesorId int,
cursoId int
);


/*
 * Modificar un fk
 * 
 * alter table nombre_tabla drop foreign key Fk_nombre_foreign_key
 * 
 * */

-- FK
alter table AlumnCur add constraint fk_AlumnCur_Alumno foreign key(AlumnoId) references Alumnos(id) ON DELETE CASCADE; 
alter table AlumnCur add constraint fk_AlumnCur_Curso foreign key(CursoId) references Cursos(id) ON DELETE CASCADE; 

alter table ProfCur add constraint fk_ProfCur_Profesor foreign key(ProfesorId) references Profesores(id) ON DELETE CASCADE; 
alter table ProfCur add constraint fk_ProfCur_Curso foreign key(CursoId) references Cursos(id) ON DELETE CASCADE; 


/*
 * Eliminar un índice
 *
 * DROP INDEX nombre_Indice ON nombre_Tabla
 * ALTER TABLE nombre_de_la_tabla ADD UNIQUE [nombre_indice] (nombre_columna, [bombre_columna2]...);
 *  
 */

-- índices (para evitar que un alumno repita un curso)

ALTER TABLE AlumnCur ADD UNIQUE idx_AlumnCur (alumnoId, cursoId);
ALTER TABLE ProfCur ADD UNIQUE idx_ProfCur (profesorId, cursoId);


-- Usuarios

create user IF NOT EXISTS 'director'@'localhost' identified by '1234';
create user IF NOT EXISTS 'profesor'@'localhost' identified by '1234';


-- Privilegios

grant select, insert, update, delete on academia.* to director@localhost; 
grant select on academia.* to profesor@localhost; 

flush privileges;

