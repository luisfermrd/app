<?php
ob_start();
session_start();

if (isset($_GET['id'])) {
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="../public/img/icon.png" type="image/x-icon">
        <title>Test Result</title>
        <link rel="stylesheet" href="../public/css/test.css" />
        <link rel="stylesheet" href="../lib/toastify-js/toastify.css" />
    </head>

    <body>
        <input type="hidden" name="studentID" id="studentID" value="<?php echo $_GET['id'] ?>">
        <section class="initial_section" id="initial_section">
            <div class="content2">
                <header class="in-header">
                    <button id="backToHome">&lt;</button>
                </header>
                <h2 class="text-center p" id="name"></h2>
                <p class="text-center p">
                Resultado de la prueba de cribado Dytective de dificultades de lecto-escritura.
                </p>
                <div class="chart">
                    <img src="../public/img/test-chart.png" alt="char" class="img1">
                    <img src="../public/img/chart-pointer.png" alt="pointer" class="img2">
                </div>
                <main class="column">
                    <div class="text-center md hydrated end">
                        <div class="img">
                            <img alt="try" src="../public/img/intentalo.svg" />
                        </div>
                        <h3>lo importante es intentarlo</h3>
                        <p>
                            no importa si no entiendes completamente una prueba:<br /><strong>asegúrate de intentarlo al menos una vez, no tienes nada que
                                perder :)</strong>
                        </p>
                    </div>
                </main>
            </div>
        </section>
    </body>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="../lib/toastify-js/toastify.js"></script>
    <script src="../public/js/testResult.js"></script>

    </html>
<?php
} else {
    header("Location: home.php");
}
ob_end_flush();
?>