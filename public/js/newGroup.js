window.group.addEventListener('submit', e => {
    e.preventDefault();
    register();
});

async function register() {

    let form_data = $("#group")[0];
    let data = new FormData(form_data);
    data.append('controller', 'group');
    data.append('action', 'createGroup');
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
}
