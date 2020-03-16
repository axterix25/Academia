<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?x=<?=time(); ?>">
    <script src="https://kit.fontawesome.com/7a7bcf719b.js" crossorigin="anonymous"></script>

    <title>Ayuda</title>
</head>

<body>
    <div class="web">
        <header>
            <h1>Ayuda</h1>
        </header>

        <main>
            <h2>Menú principal</h2>
            <div class="leyenda">
                <ul>
                    <li><i class="fas fa-home"></i> Va al portal</li>
                    <li><i class="fas fa-school"></i> Va a la página de cursos</li>
                    <li><i class="fas fa-user-graduate"></i>Va a la página de prodesores</li>
                    <li><i class="fas fa-user"></i> Va a la página de alumnos</li>
                    <li><i class="far fa-question-circle"></i>Va a la página de Ayuda(esta página)</li>
                    <li><i class="fas fa-sign-out-alt"></i>Sale de la aplicación, permite ver el múmnero de accesos, el
                        último acceso y el director puede ver el log</li>
                    <li><i class="fas fa-search"></i> Busca un profesor, alumno o curso dependiendo de dónde se
                        encuentre el usuario, los porfesores sólo podrá, ver sus alumnos, sus cursos y su información
                        personal</li>
                </ul>

                <h2>Cursos</h2>
                <ul>
                    <li><i class="fas fa-trash-alt"></i> Borra un curso</li>
                    <li><i class="fas fa-edit"></i> Modifica lo datos de un curso</li>
                    <li><i class="fas fa-user-plus"></i> Asigna un curso a un alumno</li>
                    <li><i class="fas fa-users"></i> Muestra los alumnos que reciben un curso</li>
                </ul>
                <h2>Profesores</h2>
                <ul>
                    <li><i class="fas fa-trash-alt"></i> Borra un profesor</li>
                    <li><i class="fas fa-edit"></i> Modifica lo datos personales de un profesor</li>
                    <li><i class="fas fa-eye"></i> Muestra los curso que imparte un profesor</li>
                    <li><i class="fas fa-users"></i> Muestra los alumnos a los que imparte clase un profesor</li>
                    <li><i class="fas fa-user-graduate"></i> Asigna un curso a un profesor</li>
                </ul>
                <h2>Alumnos</h2>
                <ul>
                    <li><i class="fas fa-user-times"></i> Borra un alumnos</li>
                    <li><i class="fas fa-user-edit"></i> Modifica lo datos personales de un alumno</li>
                    <li><i class="fas fa-user-plus"></i> Asigna un curso a un alumno</li>
                    <li><i class="fas fa-users"></i> Muestra los cursos que realiza un alumno</li>
                </ul>
            </div>
            <button type="button" onclick="history.back(-1)"><i class="fas fa-arrow-left"></i></button>
        </main>
        <footer>2020. Julio del Peso Pérez.
        </footer>
    </div>
</body>

</html>