<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio</title>
  <link rel="shortcut icon" href="../public/img/icon.png" type="image/x-icon">
  <link rel="stylesheet" href="../public/css/index.css" />
  <link rel="stylesheet" href="../lib/toastify-js/toastify.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="container" id="container">
    <div class="form-container register-container">
      <form id="form-register">
        <h1>Registrate</h1>
        <div class="form-control">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" id="username" name="userName" placeholder="Nombres y Apellidos" required />
          <small id="username-error"></small>
          <span></span>
        </div>
        <div class="form-control">
          <i class="fa-solid fa-envelope icon"></i>
          <input type="email" id="email" name="email" placeholder="Correo" required />
          <small id="email-error"></small>
          <span></span>
        </div>
        <div class="form-control">
          <i class="fa-solid fa-key icon"></i>
          <input type="password" id="password" name="password" placeholder="Contraseña" required />
          <small id="password-error"></small>
          <span></span>
          <i class="fa-regular fa-eye icon2" id="seePasswordRegister1"></i>
        </div>
        <div class="form-control">
          <i class="fa-solid fa-key icon"></i>
          <input type="password" id="password2" name="password2" placeholder="Repetir contraseña" required />
          <small id="password2-error"></small>
          <span></span>
          <i class="fa-regular fa-eye icon2" id="seePasswordRegister2"></i>
        </div>
        <div class="form-control">
          <i class="fa-solid fa-building-columns icon"></i>
          <input type="text" id="institucion" name="institution" placeholder="Institución a la que pertenece" required />
          <small id="institucion-error"></small>
          <span></span>
        </div>
        <button type="submit" value="submit">
          <i class="fa-solid fa-spinner fa-spin-pulse" id="spinner" style="display: none;"></i>
          Registrar
        </button>
        <!-- <span>or use your account</span>
          <div class="social-container">
            <a href="#" class="social"
              ><i class="fa-brands fa-facebook-f"></i
            ></a>
            <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
            <a href="#" class="social"><i class="fa-brands fa-tiktok"></i></a>
          </div> -->
      </form>
    </div>

    <div class="form-container login-container">
      <form class="form-lg" id="form-login">
        <h1>Iniciar sesíon.</h1>
        <div class="form-control2">
          <i class="fa-solid fa-envelope icon"></i>
          <input type="email" class="email-2" name="email" placeholder="Correo" required />
          <small class="email-error-2"></small>
          <span></span>
        </div>
        <div class="form-control2">
          <i class="fa-solid fa-key icon"></i>
          <input type="password" class="password-2" name="password" placeholder="Contraseña" required />
          <small class="password-error-2"></small>
          <span></span>
          <i class="fa-regular fa-eye icon2" id="seePassword"></i>
        </div>

        <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="">Recuerdame</label>
          </div>
          <div class="pass-link">
            <a href="#">Olvide mi contraseña</a>
          </div>
        </div>
        <button type="submit" value="submit">
          <i class="fa-solid fa-spinner fa-spin-pulse" id="spinner1" style="display: none;"></i>
          Iniciar
        </button>
        <div class="pass-link">
          <a href="loginStudent.php">Entrar como alumno</a>
        </div>
        <!-- <span>Or use your account</span>
          <div class="social-container">
            <a href="#" class="social"
              ><i class="fa-brands fa-facebook-f"></i
            ></a>
            <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
            <a href="#" class="social"><i class="fa-brands fa-tiktok"></i></a>
          </div> -->
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1 class="title">
            Hola <br />
            amigos
          </h1>
          <p>Si ya tienes una cuenta, inicia sesíon!</p>
          <button class="ghost" id="login">
            Iniciar
            <i class="fa-solid fa-arrow-left"></i>
          </button>
        </div>

        <div class="overlay-panel overlay-right">
          <h1 class="title">
            ¿No tienes <br />
            cuenta?
          </h1>
          <p>
            Registrate para que pruebes el contenido de nuestra plataforma
          </p>
          <button class="ghost" id="register">
            Registrar
            <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="../lib/toastify-js/toastify.js"></script>
<script src="../public/js/index.js"></script>

</html>