<?php
ob_start();
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../public/img/icon.png" type="image/x-icon">
        <link rel="stylesheet" href="../public/css/groups.css">
        <link rel="stylesheet" href="../lib/sweetalert2/sweetalert2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
        <title>Grupos</title>
    </head>

    <body>
        <?php include './template/header.php'; ?>
        <main>
            <article>
                <h1>Grupos</h1>
                <hr>
                <p>En esta sección encontraras los grupos con los cuales podras asociar los alumnos.</p>
            </article>
            <article class="container">
                <a href="./newGroup.php" class="btn"><i class="fa-solid fa-circle-plus"></i> Crear grupo</a>
                <table id="tableGroups" class="table table-striped nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </article>
        </main>
        <?php include './template/footer.php'; ?>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="../lib/sweetalert2/sweetalert2.min.js"></script>
    <script src="../public/js/groups.js"></script>
    <script src="../public/js/menu.js"></script>

    </html>
<?php
}
ob_end_flush();
?>