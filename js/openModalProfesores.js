function iniciar() {

    // Get the modal
    var modal = document.getElementById("myModal");

    var elements = document.querySelectorAll('.asignCurso');

    var asignar = document.getElementById("asignar");
    asignar.addEventListener("click", addCursoToProfesor);
    asignar.disabled = true;


    let select_cursos = document.getElementById("cursos");

    select_cursos.addEventListener('change', function () {

        asignar.disabled = (this.value == 0) ? true : false;

    });

    let idprofesor = document.getElementById("profesorId");

    let result = document.getElementById("result");

    elements.forEach(e => {
        e.addEventListener('click', (function (event) {
            let profesorId = (e.getAttribute("data-profesorId"));
            let profesor = (e.getAttribute("data-profesor"));
            event.preventDefault();
            let nombreProfesor = document.getElementById("profesor");            
            idprofesor.value = profesorId;
            
            nombreProfesor.innerHTML = "<b>" + profesor + "</b>";
            getCursosSinProfesor();
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

    function getCursosSinProfesor() {
        let url = "../tools/ajaxTools.php";

        let datos = new FormData();
        datos.append("action", "getCursosSinProfesor");
        let solicitud = new XMLHttpRequest();
        solicitud.addEventListener("load", showCursosSinProfesor);
        solicitud.responseType = 'text';
        solicitud.open("POST", url, true);
        solicitud.send(datos);
    }

    function showCursosSinProfesor(evento) {
        let datos = evento.target;
        if (datos.status == 200) {

            if (datos.responseText != '') {
                let cursos = JSON.parse(datos.responseText);

                select_cursos.options.length = 0;
                let opt = document.createElement('option');
                opt.value = 0;
                opt.innerHTML = "Selecciona un curso";
                opt.selected = true;
                opt.disabled = true;
                select_cursos.appendChild(opt);
        

                cursos.forEach(element => {
                    let opt = document.createElement('option');
                    opt.value = element.id;
                    opt.innerHTML = element.nombre;
                    select_cursos.appendChild(opt);
                });
            }
            else {
                result.innerHTML = "No se han encontrado cursos disponibles para este profesor";
            }
        }
    }

    function addCursoToProfesor() {

        let url = "../tools/ajaxTools.php";

        let datos = new FormData();
        datos.append("action", "addCursoToProfesor");
        datos.append("profesorId", idprofesor.value);
        datos.append("cursoId", select_cursos.value);
        let solicitud = new XMLHttpRequest();
        solicitud.addEventListener("load", procesoTerminado);
        solicitud.responseType = 'text';
        solicitud.open("POST", url, true);
        solicitud.send(datos);
    }

    function procesoTerminado(evento) {
       
        result.innerHTML = evento.target.responseText;
    }
}

window.addEventListener("load", iniciar);