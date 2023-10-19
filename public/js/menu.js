// Variables para elementos del DOM
const submenu = document.getElementById("sub-menu");
const dropdown = document.getElementById("dropdown");
const colchon = document.getElementById("colchon");
const colchonIcon = document.getElementById("colchon-icon");
const logout = document.getElementById("logout");
const nav = document.querySelector('nav');



// Evento para mostrar/ocultar el menú desplegable al hacer clic en "submenu"
submenu.addEventListener('click', (event) => {
    dropdown.classList.toggle("active");
});

// Evento para alternar entre íconos y activar/desactivar el menú al hacer clic en "colchon"
colchon.addEventListener('click', () => {
    colchonIcon.classList.toggle('fa-bars');
    colchonIcon.classList.toggle('fa-xmark');
    nav.classList.toggle('active-menu');
});

// Evento para ocultar el menú desplegable cuando se hace clic fuera de él
document.addEventListener('click', (event) => {
    if (event.target !== submenu) {
        dropdown.classList.remove("active");
    }
});

logout.addEventListener('click', ()=>{
    close();
});

async function close(){
    let formData = new FormData();
    formData.append('controller', 'user')
    formData.append('action', 'logout')

    await $.ajax({
        type: "post",
        url: "../indexRequest.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response)
            if (response.status = 'success') {
                Toastify({
                    text: response.message,
                    duration: 1000,
                    style: {
                        background: "linear-gradient(to right, #22c55e, #15803d)",
                    }
                }).showToast();
                setTimeout(() => {
                    $(location).attr("href", "index.php");
                }, 1000);
            } else {
                
            }
        }
    });
}
