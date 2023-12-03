
// Función para cambiar la visibilidad de la contraseña
function togglePasswordVisibility(passwordInput, toggleButton) {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    toggleButton.classList.remove("fa-eye");
    toggleButton.classList.add("fa-eye-slash");
  } else {
    passwordInput.type = "password";
    toggleButton.classList.remove("fa-eye-slash");
    toggleButton.classList.add("fa-eye");
  }
}
const passwordInput = document.querySelector(".password-2");
const toggleButton = document.getElementById("seePassword");
const lgForm = document.querySelector(".form-lg");

toggleButton.addEventListener("click", () => {
  togglePasswordVisibility(passwordInput, toggleButton);
});


async function login() {
  let form_data = $("#form-login")[0];
  let data = new FormData(form_data);
  data.append("controller", "student");
  data.append("action", "login");
  await $.ajax({
    type: "post",
    url: "../indexRequest.php",
    data: data,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response.status == "success") {
        Toastify({
          text: response.message,
          duration: 4000,
          style: {
            background: "linear-gradient(to right, #22c55e, #15803d)",
          },
        }).showToast();
        document.querySelector("#spinner1").style.display = "none";
        form_data.reset();
        $(location).attr("href", "student.php");
      } else {
        Toastify({
          text: response.message,
          duration: 4000,
          style: {
            background: "linear-gradient(to right, #ef4444, #b91c1c)",
          },
        }).showToast();
        document.querySelector("#spinner1").style.display = "none";
      }
    },
  });
}

lgForm.addEventListener("submit", (e) => {
  e.preventDefault();
  document.querySelector("#spinner1").style.display = "block";
  login();
});
