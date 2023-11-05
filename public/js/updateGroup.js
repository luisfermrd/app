async function loadData() {

    let data = new FormData();
    data.append('controller', 'group');
    data.append('action', 'readGroupById');
    data.append('groupID', $('#groupID').val());
    await $.ajax({
        type: "post",
        url: "../indexRequest.php",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 'success') {
                $('#nameGroup').val(response.data.GroupName);
                $('#descriptionGroup').val(response.data.Description);
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

window.group.addEventListener('submit', e => {
    e.preventDefault();
    update();
});

async function update() {

    let form_data = $("#group")[0];
    let data = new FormData(form_data);
    data.append('controller', 'group');
    data.append('action', 'updateGroup');
    data.append('groupID', $('#groupID').val());
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
                    duration: 2000,
                    style: {
                        background: "linear-gradient(to right, #22c55e, #15803d)",
                    }
                }).showToast();
                setTimeout(() => {
                    window.location.href = './groups.php';
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
