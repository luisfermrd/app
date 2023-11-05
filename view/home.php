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
        <link rel="stylesheet" href="../public/css/home.css">
        <link rel="stylesheet" href="../lib/sweetalert2/sweetalert2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
        <title>Home</title>
    </head>

    <body>
        <?php include './template/header.php'; ?>
        <main>
            <article>
                <h1>Escritorio</h1>
                <hr>
                <p>Como colegio, puedes organizar tus alumnos en <a href="groups.php">grupos</a>. De esta forma puedes organizar alumnos en clases y tener un mejor manejo. Cómo administrador de la cuenta, sólo tu puedes crear alumnos y grupos</p>
            </article>
            <article>
                <section class="panel">
                    <div class="buscar">
                        <input type="search" name="buscar" id="buscar" placeholder="Buscar usuarios">
                        <span></span>
                    </div>
                    <div class="opciones">
                        <a href="newStudent.php" id="agregar" class="agregar"><i class="fa-solid fa-circle-plus"></i> Crear alumno</a>
                        <div id="list">
                            <div class="list list-active" id="listar-1">
                                <i class="fa-solid fa-address-card"></i>
                            </div>
                            <div class="list" id="listar-2">
                                <i class="fa-solid fa-table-list"></i>
                            </div>
                        </div>
                    </div>
                </section>
                <article class="contenedor-listas" id="contenedor-listas">
                    <section class="section-listar" id="listar1">

                    </section>


                    <section class="section-listar2" id="listar2">
                        <table id="tableStudents" class="table table-striped nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Edad</th>
                                    <th>Prueba</th>
                                    <th>Grupo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </section>
                </article>
            </article>
        </main>
        <?php include './template/footer.php'; ?>
    </body>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="../lib/toastify-js/toastify.js"></script>
    <script src="../lib/sweetalert2/sweetalert2.min.js"></script>
    <script src="../public/js/home.js"></script>
    <script src="../public/js/menu.js"></script>

    </html>
<?php
}
ob_end_flush();
?>