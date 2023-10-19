// Función para mostrar un mensaje de error
function showError(input, error) {
    const formControl = input.parentElement;
    formControl.className = 'form-control2 error';
    const small = formControl.querySelector('small');
    small.innerText = error;
}

// Función para mostrar un mensaje de éxito
function showSuccess(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control2 success';
    const small = formControl.querySelector('small');
    small.innerText = '';
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
const email2 = document.querySelector('.email-2');
const lgPassword = document.querySelector('.password-2');
const passwordInput = document.querySelector(".password-2");
const toggleButton = document.getElementById("seePassword");
const lgForm = document.querySelector('.form-lg');


lgPassword.addEventListener("input", () => {
    checkInputLength(lgPassword, 8, 20, "*Debe tener entre 8 y 20 caracteres.");
});

toggleButton.addEventListener("click", () => {
    togglePasswordVisibility(passwordInput, toggleButton);
});

// Evitar envío de formulario en blanco
lgForm.addEventListener('submit', (e) => {
    e.preventDefault();
});
