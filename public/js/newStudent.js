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

window.createStudent.addEventListener('submit', e => {
    e.preventDefault();
    create();
})


async function create() {

    if (window.password.value == window.password2.value) {
        let form_data = $("#createStudent")[0];
        let data = new FormData(form_data);
        data.append('controller', 'student');
        data.append('action', 'createStudent');
        await $.ajax({
            type: "post",
            url: "../indexRequest.php",
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    Toastify({
                        text: response.message,
                        duration: 4000,
                        style: {
                            background: "linear-gradient(to right, #22c55e, #15803d)",
                        }
                    }).showToast();
                    form_data.reset();
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
    } else {
        Toastify({
            text: 'Las contraseñas no coinciden, por favor verifica',
            duration: 4000,
            style: {
                background: "linear-gradient(to right, #ef4444, #b91c1c)",
            }
        }).showToast();
    }


}