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

-- Carga de datos

insert into profesores values
(null, 'Julio','del Peso Pérez','1234','d'),
(null, 'Marisol','González González','1234','p'),
(null, 'Juan', 'Hernández Castillo', '1234', 'p'),
(null, 'Adrian', 'Ojo de Águila', '1234', 'p'),
(null, 'Julian', 'de la Guía Ortega', '1234', 'p'),
(null, 'Agapito', 'Ruiz Jiménez', '1234', 'p'),
(null, 'Marisol', 'González Gónzález', '1234', 'p');

insert into cursos values
(null, 'informática basica','2020/01/01','2020/02/01'),
(null, 'informática avanzada','2020/01/01','2020/02/01'),
(null, 'Redes','2020/03/01','2020/04/01'),
(null, 'Reparación de ordenadores','2020/02/01','2020/03/01'),
(null, 'Diseño web', '2020/03/06', '2020/03/31'),
(null, 'Jardinería', '2020/03/02', '2020/03/31'),
(null, 'Repostería', '2020/03/02', '2020/03/31'),
(null, 'Pastelería', '2020/03/02', '2020/03/31'),
(null, 'Word avanzado', '2020/03/02', '2020/03/31'),
(null, 'Word básico', '2020/03/02', '2020/03/31'),
(null, 'Excel avanzado', '2020/03/02', '2020/03/31'),
(null, 'Excel básico', '2020/03/02', '2020/03/31'),
(null, 'Access avanzado', '2020/03/02', '2020/03/31'),
(null, 'Access básico', '2020/03/02', '2020/03/31');

insert into alumnos values
(null,'Julio', 'González Ruiz'),
(null, 'José Alberto', 'Martín Aguilar'),
(null, 'Margarita', 'Pérez Arellano'),
(null, 'Andrés', 'Pérez Sánchez'),
(null, 'Luisa', 'Gómez Albaricoque'),
(null, 'Fermín', 'Martín Pescador'),
(null, 'Antonia', 'Herrero Ternera'),
(null, 'Antonio', 'Cuernavaca Toledo'),
(null, 'María del Carmen', 'del Olmo Seco'),
(null, 'Ana Isabel', 'Ortiz Ortiz'),
(null, 'Juan', 'Sánchez Ledesma'),
(null, 'José', 'Martínez Campos'),
(null, 'Antonio', 'Arellana Salvador'),
(null, 'Mari Carmen', 'González Bermejo'),
(null, 'Pilar', 'Casado Rubio'),
(null, 'Asunción', 'Guerra Morilla'),
(null, 'Ángel', 'Bonilla Pérez'),
(null, 'Fernado', 'Lara Gil'),
(null, 'Benito', 'Pérez Bodoque'),
(null, 'Victoria', 'Molina San Roman'),
(null, 'Juan', 'Sánchez Martín'),
(null, 'Antonio', 'Bermejo Salvador'),
(null, 'Mari Carmen', 'González Abril'),
(null, 'Ángel', 'Moreno Moreno'),
(null, 'Fernado', 'Ortega Gil'),
(null, 'Andrea', 'Molina San Roman');

-- id, ProfesorId, CursoId
insert into profcur values
(null,3,1),
(null,2,3),
(null,3,4),
(null,4,2),
(null,5,6),
(null,3,7),
(null,7,5);

-- id, AlunmoId, CursoId
insert into AlumnCur values
(null,1,1),
(null,1,2),
(null,2,3),
(null,3,2),
(null,4,3),
(null,4,2),
(null,5,4),
(null,5,12),
(null,5,13),
(null,6,12),
(null,7,13),
(null,8,11),
(null,9,5),
(null,10,5),
(null,10,3);
