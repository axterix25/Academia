<?php
    if (!isset($_SESSION["usuarioId"]) || empty($_SESSION["usuarioId"])) {
        echo"# No hay usuario registrado";
        header("location:./index.php");
        exit();
    }
    ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal academia</title>
    <link rel="stylesheet" href="css/style.css?x=<?=time(); ?>">

    <style>
        html,
        body {
            height: 100%;
            background-color: white;
        }

        .container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5vh 5vw;
        }

        .container-grid {
            display: grid;
            grid-template-columns: auto auto auto;
            /* background-color: rgb(255, 255, 255); */
            padding: 3rem;;
            margin: auto;
        }

        .container-grid div {
            border: 1px solid black;
            background-color: azure;
            height: 300px;
            width: 300px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 1%;
        }

        .container-grid div:nth-child(1),
        .container-grid div:last-child {
            background-color: rgb(29, 112, 20);;
            color: white;
        }

        .container-grid div{
            background-color:burlywood;
        }

        .container-grid div a{
            text-decoration: none;
            color:rgb(29, 112, 20);;
        }
        
        
    </style>

</head>

<body>
    <div class="container">
        <div class="container-grid">
            <div>Academia</div>
            <div><a href="./cursos/">Cursos</a></div>
            <div><a href="./profesores/">Profesores</a></div>
            <div><a href="./alumnos/">Alumnos</a></div>
            <div><a href="./LogOut.php">Salir</a></div>
            <div>Toka-mela</div>
        </div>
    </div>
</body>

</html>