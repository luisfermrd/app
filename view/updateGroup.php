<?php
ob_start();
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
} else if (isset($_GET['id'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../public/img/icon.png" type="image/x-icon">
        <link rel="stylesheet" href="../public/css/Newgroup.css">
        <link rel="stylesheet" href="../lib/toastify-js/toastify.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Home</title>
    </head>

    <body>
        <?php include './template/header.php'; ?>
        <main>
            <article>
                <h1>Actualizar grupo</h1>
                <hr>
                <p>Modifica los campos los necesarios y luego preciona el boton actualizar.</p>
            </article>
            <section>
                <input type="hidden" name="groupID" id="groupID" value="<?php echo $_GET['id'] ?>">
                <?php
                $action = 'Actualizar';
                include_once './template/formGroup.php'
                ?>
            </section>
        </main>
        <?php include './template/footer.php'; ?>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="../lib/toastify-js/toastify.js"></script>
    <script src="../public/js/updateGroup.js"></script>
    <script src="../public/js/menu.js"></script>

    </html>
<?php
} else {
    header("Location: home.php");
}
ob_end_flush();
?>