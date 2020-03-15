-- Carga de datos

use academia;

insert into profesores values
(null, 'Julio','del Peso P�rez','1234','d'),
(null, 'Marisol','Gonz�lez Gonz�lez','1234','p'),
(null, 'Juan', 'Hern�ndez Castillo', '1234', 'p'),
(null, 'Adrian', 'Ojo de �guila', '1234', 'p'),
(null, 'Julian', 'de la Gu�a Ortega', '1234', 'p'),
(null, 'Agapito', 'Ruiz Jim�nez', '1234', 'p');

insert into cursos values
(null, 'inform�tica basica','2020/01/01','2020/02/01'),
(null, 'inform�tica avanzada','2020/01/01','2020/02/01'),
(null, 'Redes','2020/03/01','2020/04/01'),
(null, 'Reparaci�n de ordenadores','2020/02/01','2020/03/01'),
(null, 'Dise�o web', '2020/03/06', '2020/03/31'),
(null, 'Jardiner�a', '2020/03/02', '2020/03/31'),
(null, 'Reposter�a', '2020/03/02', '2020/03/31'),
(null, 'Pasteler�a', '2020/03/02', '2020/03/31'),
(null, 'Word avanzado', '2020/03/02', '2020/03/31'),
(null, 'Word b�sico', '2020/03/02', '2020/03/31'),
(null, 'Excel avanzado', '2020/03/02', '2020/03/31'),
(null, 'Excel b�sico', '2020/03/02', '2020/03/31'),
(null, 'Access avanzado', '2020/03/02', '2020/03/31'),
(null, 'Access b�sico', '2020/03/02', '2020/03/31');

insert into alumnos values
(null,'Julio', 'Gonz�lez Ruiz'),
(null, 'Jos� Alberto', 'Mart�n Aguilar'),
(null, 'Margarita', 'P�rez Arellano'),
(null, 'Andr�s', 'P�rez S�nchez'),
(null, 'Luisa', 'G�mez Albaricoque'),
(null, 'Ferm�n', 'Mart�n Pescador'),
(null, 'Antonia', 'Herrero Ternera'),
(null, 'Antonio', 'Cuernavaca Toledo'),
(null, 'Mar�a del Carmen', 'del Olmo Seco'),
(null, 'Ana Isabel', 'Ortiz Ortiz'),
(null, 'Juan', 'S�nchez Ledesma'),
(null, 'Jos�', 'Mart�nez Campos'),
(null, 'Antonio', 'Arellana Salvador'),
(null, 'Mari Carmen', 'Gonz�lez Bermejo'),
(null, 'Pilar', 'Casado Rubio'),
(null, 'Asunci�n', 'Guerra Morilla'),
(null, '�ngel', 'Bonilla P�rez'),
(null, 'Fernado', 'Lara Gil'),
(null, 'Benito', 'P�rez Bodoque'),
(null, 'Victoria', 'Molina San Roman'),
(null, 'Juan', 'S�nchez Mart�n'),
(null, 'Antonio', 'Bermejo Salvador'),
(null, 'Mari Carmen', 'Gonz�lez Abril'),
(null, '�ngel', 'Moreno Moreno'),
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
(null,6,5);

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
