function iniciar() {

    // Get the modal
    var modal = document.getElementById("myModal");

    var elements = document.querySelectorAll('.addAlumno');

    var asignar = document.getElementById("asignar");
    asignar.addEventListener("click", addCursoToAlumno);
    asignar.disabled = true;

    let contador;

    let select_alumnos = document.getElementById("alumnos");

    select_alumnos.addEventListener('change', function () {

        asignar.disabled = (this.value == 0) ? true : false;

    });

    let idcurso = document.getElementById("cursoId");

    let result = document.getElementById("result");

    elements.forEach(e => {
        e.addEventListener('click', (function (event) {
            let cursoId = (e.getAttribute("data-cursoId"));
            let curso = (e.getAttribute("data-curso"));

            contador = e.parentElement.parentElement.getElementsByTagName('td')[1].getElementsByTagName('span')[0];
            
            event.preventDefault();
            let nombreCurso = document.getElementById("curso");            
            idcurso.value = cursoId;
            
            nombreCurso.innerHTML = "<b>" + curso + "</b>";
            getAlumnosSinCursarCurso(cursoId);
            modal.style.display = "block";
        })
        )
    });

    var span = document.getElementsByClassName("close")[0];

    span.addEventListener('click', function (event) {
        asignar.disabled = true;
        modal.style.display = "none";
    });

    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            asignar.disabled = true;
            modal.style.display = "none";
        }
    });

    function getAlumnosSinCursarCurso(cursoId) {
        let url = "../tools/ajaxTools.php";

        let datos = new FormData();
        datos.append("action", "getAlumnosSinCursarCurso");
        datos.append("cursoId", cursoId);
        let solicitud = new XMLHttpRequest();
        solicitud.addEventListener("load", showAlumnosSinCursarCurso);
        solicitud.responseType = 'text';
        solicitud.open("POST", url, true);
        solicitud.send(datos);
    }

    function showAlumnosSinCursarCurso(evento) {
        let datos = evento.target;
        if (datos.status == 200) {

            if (datos.responseText != '') {
                let alumnos = JSON.parse(datos.responseText);

                select_alumnos.options.length = 0;
                let opt = document.createElement('option');
                opt.value = 0;
                opt.innerHTML = "Selecciona un alumno";
                opt.selected = true;
                opt.disabled = true;
                select_alumnos.appendChild(opt);
        
                alumnos.forEach(element => {
                    let opt = document.createElement('option');
                    opt.value = element.id;
                    opt.innerHTML = element.nombre;
                    select_alumnos.appendChild(opt);
                });
            }
            else {
                result.innerHTML = "No se han encontrado alumnos que no hayan realizado este curso";
            }
        }
    }

    function addCursoToAlumno() {

        let url = "../tools/ajaxTools.php";

        let datos = new FormData();
        datos.append("action", "addCursoToAlumno");
        datos.append("alumnoId", select_alumnos.value);
        datos.append("cursoId", idcurso.value);
        let solicitud = new XMLHttpRequest();
        solicitud.addEventListener("load", procesoTerminado);
        solicitud.responseType = 'text';
        solicitud.open("POST", url, true);
        solicitud.send(datos);
    }

    function procesoTerminado(evento) {
       

        if (evento.target.responseText == 'OK') {

            result.innerHTML = "Se ha dado de alta al alumno en el curso solicitado";

            contador.innerHTML = parseInt(contador.innerHTML) + 1;

        }
        else {
            result.innerHTML = evento.target.responseText;
        }
    }
}

window.addEventListener("load", iniciar);