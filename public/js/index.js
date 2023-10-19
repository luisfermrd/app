// Función para mostrar un mensaje de error
function showError(input, error) {
    const formControl = input.parentElement;
    formControl.className = 'form-control error';
    const small = formControl.querySelector('small');
    small.textContent = error;
}

// Función para mostrar un mensaje de éxito
function showSuccess(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
    const small = formControl.querySelector('small');
    small.textContent = '';
}

// Función para verificar la validez del correo electrónico
function checkEmailValidity(email) {
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailRegex.test(email);
}

// Función para verificar la longitud de un campo de entrada
function checkInputLength(input, min, max, errorMessage) {
    const value = input.value.trim();
    if (value.length < min || value.length > max) {
        showError(input, errorMessage);
    } else {
        showSuccess(input);
    }
}

// Función para cambiar la visibilidad de la contraseña
function togglePasswordVisibility(passwordInput, toggleButton) {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleButton.classList.remove('fa-eye');
        toggleButton.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = "password";
        toggleButton.classList.remove('fa-eye-slash');
        toggleButton.classList.add('fa-eye');
    }
}

// Obtener elementos del DOM
const registerButton = document.getElementById("register");
const loginButton = document.getElementById("login");
const container = document.getElementById("container");
const form = document.querySelector('form');
const email = document.getElementById('email');
const password = document.getElementById('password');
const username = document.getElementById('username');
const institucion = document.getElementById('institucion');
const passwordInput1 = document.getElementById("password");
const toggleButton1 = document.getElementById("seePasswordRegister1");
const passwordInput2 = document.getElementById("password2");
const toggleButton2 = document.getElementById("seePasswordRegister2");
const email2 = document.querySelector('.email-2');
const lgPassword = document.querySelector('.password-2');
const passwordInput = document.querySelector(".password-2");
const toggleButton = document.getElementById("seePassword");
const lgForm = document.querySelector('.form-lg');

const checkbox = document.getElementById("checkbox");

// Verificar si se debe recordar el estado del "Recuérdame"
if (localStorage.getItem("rememberMe") === "true") {
    checkbox.checked = true;
    // Restaurar los valores guardados en el almacenamiento local
    email2.value = localStorage.getItem("email");
    passwordInput.value = localStorage.getItem("password");
}


// Agregar eventos
registerButton.addEventListener("click", () => {
    container.classList.add("right-panel-active");
});

loginButton.addEventListener("click", () => {
    container.classList.remove("right-panel-active");
});

checkbox.addEventListener("change", () => {
    if (checkbox.checked) {
        localStorage.setItem("rememberMe", "true");
        localStorage.setItem("email", email2.value);
        localStorage.setItem("password", passwordInput.value);
    } else {
        localStorage.removeItem("rememberMe");
        localStorage.removeItem("email");
        localStorage.removeItem("password");
    }
});

email.addEventListener('blur', () => {
    if (!checkEmailValidity(email.value)) {
        showError(email, "*El correo no es valido");
    } else {
        showSuccess(email);
    }
});

username.addEventListener("input", () => {
    checkInputLength(username, 4, 40, "*Debe tener entre 4 y 40 caracteres.");
});

password.addEventListener("input", () => {
    checkInputLength(password, 8, 20, "*Debe tener entre 8 y 20 caracteres.");
});

passwordInput1.addEventListener("input", () => {
    checkInputLength(passwordInput1, 8, 20, "*Debe tener entre 8 y 20 caracteres.");
});

toggleButton1.addEventListener("click", () => {
    togglePasswordVisibility(passwordInput1, toggleButton1);
});

passwordInput2.addEventListener("input", () => {
    if (password2.value !== password.value) {
        showError(password2, "*Las contraseñas no coinciden.");
    } else {
        showSuccess(password2);
    }
});

toggleButton2.addEventListener("click", () => {
    togglePasswordVisibility(passwordInput2, toggleButton2);
});

institucion.addEventListener("input", () => {
    checkInputLength(institucion, 8, 60, "*Debe tener entre 8 y 60 caracteres.");
});

email2.addEventListener("blur", () => {
    if (!checkEmailValidity(email2.value)) {
        showError(email2, "*El correo no es valido");
    } else {
        showSuccess(email2);
    }
});

lgPassword.addEventListener("input", () => {
    checkInputLength(lgPassword, 8, 20, "*Debe tener entre 8 y 20 caracteres.");
});

toggleButton.addEventListener("click", () => {
    togglePasswordVisibility(passwordInput, toggleButton);
});

function areSmallElementsEmpty(form) {
    const smallElements = form.querySelectorAll('small');
    for (let small of smallElements) {
        if (small.textContent.trim() !== '') {
            return false; // Al menos un small tiene texto, el formulario no es válido
        }
    }
    return true; // Todos los small están vacíos, el formulario es válido
}

async function register() {

    let form_data = $("#form-register")[0];
    let data = new FormData(form_data);
    data.append('controller', 'user');
    data.append('action', 'registerUser');
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
                document.querySelector('#spinner').style.display = 'none';
                form_data.reset();
            } else {
                Toastify({
                    text: response.message,
                    duration: 4000,
                    style: {
                        background: "linear-gradient(to right, #ef4444, #b91c1c)",
                    }
                }).showToast();
                document.querySelector('#spinner').style.display = 'none';
            }
        }
    });
}

form.addEventListener('submit', (e) => {
    e.preventDefault();
    document.querySelector('#spinner').style.display = 'block';
    if (areSmallElementsEmpty(form)) {
        register()
    } else {
        Toastify({
            text: "Por favor, llene correctamente los campos para poder continuar",
            duration: 3000,
            style: {
                background: "linear-gradient(to right, #ef4444, #b91c1c)",
            }
        }).showToast();

    }
});


async function login() {

    let form_data = $("#form-login")[0];
    let data = new FormData(form_data);
    data.append('controller', 'user');
    data.append('action', 'login');
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
                document.querySelector('#spinner1').style.display = 'none';
                form_data.reset();
                $(location).attr("href", "home.php");
            } else {
                Toastify({
                    text: response.message,
                    duration: 4000,
                    style: {
                        background: "linear-gradient(to right, #ef4444, #b91c1c)",
                    }
                }).showToast();
                document.querySelector('#spinner1').style.display = 'none';
            }
        }
    });
}


lgForm.addEventListener('submit', (e) => {
    e.preventDefault();
    document.querySelector('#spinner1').style.display = 'block';
    if (areSmallElementsEmpty(lgForm)) {
        login()
    } else {
        Toastify({
            text: "Por favor, llene correctamente los campos para poder continuar",
            duration: 3000,
            style: {
                background: "linear-gradient(to right, #ef4444, #b91c1c)",
            }
        }).showToast();

    }
});






