// Alternar entre las dos secciones de listas
const btnListar1 = document.getElementById("listar-1");
const btnListar2 = document.getElementById("listar-2");
const sectionListar1 = document.getElementById("listar1");
const sectionListar2 = document.getElementById("listar2");
const contenedorListas = document.getElementById('contenedor-listas');
const campoBusqueda = document.getElementById("buscar");

btnListar1.addEventListener('click', () => {
    btnListar1.classList.add('list-active');
    btnListar2.classList.remove('list-active');
    sectionListar1.classList.remove('ocultar');
    sectionListar2.classList.remove('ocultar');
    contenedorListas.classList.remove('height');
    campoBusqueda.style.opacity = 1;
});

btnListar2.addEventListener('click', () => {
    btnListar2.classList.add('list-active');
    btnListar1.classList.remove('list-active');
    sectionListar1.classList.add('ocultar');
    sectionListar2.classList.add('ocultar');
    contenedorListas.classList.add('height');
    campoBusqueda.style.opacity = 0;
});





// Inicializar DataTables
const dataTable = new DataTable('#tableStudents', {
    responsive: true,
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-CO.json',
    },
    "aProcessing": true,
    "aServerSide": true,
    ajax: {
        url: '../indexRequest.php',
        method: 'POST',
        dataType: 'json',
        data: {
            controller: 'student',
            action: 'readStudents',
        },
        dataSrc: 'data'
    },
    columns: [
        { title: 'Usuario', data: 'UserName' },
        { title: 'Edad', data: 'Age' },
        { title: 'Prueba', data: 'Gender' },
        { title: 'Grupo', data: 'GroupName' },
        {
            title: 'Opciones',
            data: 'StudentID',
            render: function (data, type, row, meta) {
                return `<a class="button" href="./test.php?id=${data}">
                            <span>Realizar prueba de cribado</span>
                            <i class="fa-solid fa-list"></i>
                        </a>
                        <a class="button" href="./testResult.php?id=${data}">
                            <span>Resultados prueba de cribado</span>
                            <i class="fa-solid fa-gauge-high"></i>
                        </a>
                        <a class="button" href='./updateStudent.php?id=${data}'">
                            <span>Editar</span>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="button" onclick="deleteStudent(${data})">
                            <span>Eliminar</span>
                            <i class="fa-solid fa-trash-can"></i>
                        </a>`;
            }
        },
    ],
    columnDefs: [
        {
            targets: 4, // Índice de la columna "Opciones"
            className: 'acciones-table' // Agrega la clase CSS a las celdas de la columna "Opciones"
        }
    ],
    "bDestroy": true,
    "iDisplayLength": 5
});

function deleteStudent(id) {
    Swal.fire({
        title: '¿eliminar estudainte?',
        text: "¿Seguro? si lo eliminar no podras recuperar sus datos",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let data = new FormData();
            data.append('controller', 'student');
            data.append('action', 'deleteStudent');
            data.append('studentID', id);
            $.ajax({
                type: "post",
                url: "../indexRequest.php",
                data: data,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == 'success') {
                        Swal.fire(
                            'Eliminado!',
                            response.message,
                            'success'
                        )
                        // Recarga los datos del DataTable
                        dataTable.ajax.reload();
                        loadCards();
                    } else {
                        Swal.fire(
                            'Opps!',
                            response.message,
                            'error'
                        )
                    }
                }
            });

        }
    })
}


function loadCards() {
    let data = new FormData();
    data.append('controller', 'student');
    data.append('action', 'readStudents');
    $.ajax({
        type: "post",
        url: "../indexRequest.php",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 'success') {
                const groupNames = new Set();
                response.data.forEach((student) => {
                    groupNames.add(student.GroupName);
                });
                const container = document.getElementById("listar1");
                container.innerHTML = '';

                groupNames.forEach((groupName) => {

                    const groupStudents = response.data.filter((student) => student.GroupName === groupName);

                    const containerCard = document.createElement("div");
                    containerCard.classList.add("group");

                    if (groupStudents.length > 0) {
                        const groupHeader = document.createElement("h2");
                        groupHeader.innerText = (groupName == null) ? 'Sin grupo' : groupName;
                        container.appendChild(groupHeader);

                        groupStudents.forEach((student) => {
                            const card = document.createElement("div");
                            card.classList.add("card");

                            // Llena la tarjeta con los datos del estudiante
                            card.innerHTML = `
                                <div class="avatar">
                                    <img src="../public/img/${student.Gender === 'Femenino' ? 'girl' : 'boy'}_circled_0001.png" alt="avatar-img">
                                </div>
                                <a href='./updateStudent.php?id=${student.StudentID}'>
                                <i class="fa-solid fa-pen-to-square editar"></i>
                                </a>
                                <h2>${student.UserName}</h2>
                                <p>${student.Age} años</p>
                                <div class="card-option">
                                    <a class="button" href="./test.php?id=${student.StudentID}">
                                        <span>Realizar prueba de cribado</span>
                                        <i class="fa-solid fa-list"></i>
                                    </a>
                                    <a class="button" href="./testResult.php?id=${student.StudentID}">
                                        <i class="fa-solid fa-gauge-high"></i>
                                        <span>Resultados prueba de cribado</span>
                                    </a>
                                </div>
                            `;

                            containerCard.appendChild(card);
                        });
                        container.appendChild(containerCard);
                    }
                });

            } else {
                Swal.fire(
                    'Opps!',
                    response.message,
                    'error'
                )
            }
        }
    });
}

loadCards();





campoBusqueda.addEventListener("input", function() {
    const textoBusqueda = campoBusqueda.value.toLowerCase(); // Convierte el texto a minúsculas para hacer coincidencias sin distinción entre mayúsculas y minúsculas

    // Obtén todas las tarjetas de usuarios
    const tarjetasUsuarios = document.querySelectorAll(".card h2");

    tarjetasUsuarios.forEach((tarjetaUsuario) => {
        const nombreUsuario = tarjetaUsuario.textContent.toLowerCase();

        // Comprueba si el nombre del usuario contiene el texto de búsqueda
        if (nombreUsuario.includes(textoBusqueda)) {
            // Muestra la tarjeta si coincide
            tarjetaUsuario.closest(".card").style.display = "flex";
        } else {
            // Oculta la tarjeta si no coincide
            tarjetaUsuario.closest(".card").style.display = "none";
        }
    });
});