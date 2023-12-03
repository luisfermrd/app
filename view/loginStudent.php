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

        <div class="form-container login-container">
            <form class="form-lg" id="form-login">
                <h1>Iniciar sesíon.</h1>
                <div class="form-control2">
                    <i class="fa-solid fa-user icon"></i>
                    <input type="text" class="email-2" name="user" placeholder="Usuario" required />
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
                <button type="submit" value="submit">
                    <i class="fa-solid fa-spinner fa-spin-pulse" id="spinner1" style="display: none;"></i>
                    Iniciar
                </button>
                <div class="pass-link">
                    <a href="index.php">Entrar como profesor</a>
                </div>
                <br>
                <div class="pass-link">
                    <a>Si olvidaste la contradeña ponte en contacto con tu profesor</a>
                </div>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1 class="title">
                        ¡Hola <br />
                        amiguito!
                    </h1>
                    <p>
                        Te invitamos a realizar nuestro test para analizar tu estado
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="../lib/toastify-js/toastify.js"></script>
<script src="../public/js/loginStudent.js"></script>

</html>