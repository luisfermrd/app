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
        <link rel="stylesheet" href="../public/css/Newstudent.css">
        <link rel="stylesheet" href="../lib/toastify-js/toastify.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Home</title>
    </head>

    <body>
        <?php include './template/header.php'; ?>
        <main>
            <article>
                <h1>Añadir estudiante</h1>
                <hr>
                <p>Introduce los siguientes datos para crear un nuevo estudiante. Recuerda que por seguridad, es recomendable no usar el nombre real del estudiante. Por favor, asegúrate de la veracidad de los datos introducidos. Para que el estudiante pueda acceder directamente a nuestra plataforma, para realizar el test, indica una contraseña y podrá acceder con ella y su nombre de usuario.</p>
            </article>
            <section>
            <?php
                    $action = 'Registrar';
                    include_once './template/formStudent.php'
                ?>
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