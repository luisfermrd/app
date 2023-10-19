<?php
ob_start();
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../public/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/student.css">
    <link rel="stylesheet" href="../lib/toastify-js/toastify.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home</title>
</head>

<body>
    <?php include './template/header.php'; ?>
    <main>
        <article>
            <h1>Añadir Usuario</h1>
            <hr>
            <p>Introduce los siguientes datos para crear un nuevo usuario. Recuerda que por seguridad, es recomendable no usar el nombre real del usuario. Por favor, asegúrate de la veracidad de los datos introducidos. Para que el usuario pueda acceder directamente a nuestra plataforma, para realizar el test, indica una contraseña y podrá acceder con ella y su nombre de usuario.</p>
        </article>
        <section>
            <form id="createStudent">
                <h2>Datos del usuario</h2>
                <div class="content-input">
                    <label for="userName">Nombre de usuario</label>
                    <input type="text" name="userName" id="userName" required>
                    <span></span>
                </div>
                <div class="content-input">
                    <label for="groupID">Seleccione un grupo (opcional)</label>
                    <select name="groupID" id="groupID">
                        <option value="">Aun no tienes grupos</option>
                    </select>
                </div>
                <div class="content-input">
                    <label for="birthDate">Fecha de nacimiento</label>
                    <input type="date" name="birthDate" id="birthDate" required>
                    <span></span>
                </div>
                <div class="content-input">
                    <p>Sexo</p>
                    <div>
                        <input type="radio" name="gender" id="sex" value="Masculino" required>
                        <label for="sex">Masculino</label>
                    </div>
                    <div>
                        <input type="radio" name="gender" id="sex1" value="Femenino">
                        <label for="sex1">Femenino</label>
                    </div>
                    <div>
                        <input type="radio" name="gender" id="sex2" value="Prefiero no decirlo">
                        <label for="sex2">Prefiero no decirlo</label>
                    </div>
                    <div>
                        <input type="radio" name="gender" id="sex3" value="Otro">
                        <label for="sex3">Otro</label>
                    </div>
                </div>
                <div class="content-input">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" required>
                    <span></span>
                </div><div class="content-input">
                    <label for="password-2">Repetir contraseña</label>
                    <input type="password" name="password-2" id="password2" required>
                    <span></span>
                </div>
                <button type="submit">Registrar</button>
            </form>
        </section>
    </main>
    <?php include './template/footer.php'; ?>
</body>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="../lib/toastify-js/toastify.js"></script>
<script src="../public/js/newStudent.js"></script>
<script src="../public/js/menu.js"></script>

</html>
<?php
}
ob_end_flush();
?>