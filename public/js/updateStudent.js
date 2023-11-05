async function getGroups() {
    let data = new FormData();
    data.append('controller', 'group');
    data.append('action', 'readGroups');
    await $.ajax({
        type: "post",
        url: "../indexRequest.php",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.data.length != 0) {
                let html = `<option value="">Seleccionar:</option>`;
                response.data.forEach(element => {
                    html += `<option value="${element.GroupID}">${element.GroupName}</option>`
                });
                window.groupID.innerHTML = html;
            }
        }
    });
}

getGroups();

async function loadData() {

    let data = new FormData();
    data.append('controller', 'student');
    data.append('action', 'readStudentById');
    data.append('studentID', $('#studentID').val());
    await $.ajax({
        type: "post",
        url: "../indexRequest.php",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response)
            if (response.status == 'success') {
                $('#userName').val(response.data.UserName);
                if(response.data.GroupID != null){ $('#groupID').val(response.data.GroupID); }
                
                $('#birthDate').val(response.data.BirthDate);
                $("input[name='gender'][value='" + response.data.Gender + "']").prop("checked", true);
            } else {
                Toastify({
                    text: response.message,
                    duration: 4000,
                    style: {
                        background: "linear-gradient(to right, #ef4444, #b91c1c)",
                    }
                }).showToast();
                
            }
        }
    });
}

loadData();

window.student.addEventListener('submit', e => {
    e.preventDefault();
    update();
});

async function update() {

    if (window.password.value != '') {
        if (window.password.value != window.password2.value) {
            Toastify({
                text: 'Las contraseñas no coinciden, por favor verifica',
                duration: 3000,
                style: {
                    background: "linear-gradient(to right, #ef4444, #b91c1c)",
                }
            }).showToast();
            return;
        }
    } 

    let form_data = $("#student")[0];
        let data = new FormData(form_data);
        data.append('controller', 'student');
        data.append('action', 'updateStudent');
        data.append('studentID', $('#studentID').val());
        await $.ajax({
            type: "post",
            url: "../indexRequest.php",
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response)
                if (response.status == 'success') {
                    Toastify({
                        text: response.message,
                        duration: 2000,
                        style: {
                            background: "linear-gradient(to right, #22c55e, #15803d)",
                        }
                    }).showToast();
                    setTimeout(() => {
                        window.location.href = './home.php';
                    }, 2000);
                } else {
                    Toastify({
                        text: response.message,
                        duration: 2000,
                        style: {
                            background: "linear-gradient(to right, #ef4444, #b91c1c)",
                        }
                    }).showToast();
                }
            }
        });
}


const campoUsuario = document.getElementById("userName");

campoUsuario.addEventListener("input", function () {
    let valor = campoUsuario.value;
    valor = valor.replace(/\s/g, "");
    campoUsuario.value = valor;
});