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
            <div class="content2" id="respondioTest" style="display: none;">
                <header class="in-header">
                    <?php
                    if (isset($_SESSION["studentID"])) {
                        echo '<button id="backToHome2">&lt;</button>';
                    } else {
                        echo '<button id="backToHome">&lt;</button>';
                    }
                    ?>

                </header>
                <h2 class="text-center p" id="name"></h2>
                <p class="text-center p">
                    Resultado de la prueba de cribado DislexiaApp de dificultades de lecto-escritura.
                </p>
                <div class="chart">
                    <img src="../public/img/test-chart.png" alt="char" class="img1">
                    <img src="../public/img/chart-pointer.png" alt="pointer" class="img2" id="img2">
                </div>
                <div class="footerChart">
                    <span>Con Riesgo</span>
                    <span>Sin Riesgo</span>

                </div>
                <main class="text">
                    <br>
                    <div class="md hydrated" id="resultadoTest">

                    </div>
                    <div>
                        <br>
                        <br>
                        <h3>Recuerda que...</h3>
                        <br>
                        <p>Esto no es un diagnóstico de dislexia, es solo una prueba de cribado que determina el riesgo de tener dificultades de
                            lecto-escritura. El resultado de esta prueba puede ser uno de estos dos: <strong>Sin Riesgo</strong> o <strong>Con Riesgo</strong>.
                        </p>
                        <br>
                        <p>Si has obtenido como resultado Con Riesgo sería buena idea derivar a un profesional, ya sea dentro del centro educativo
                            o a un profesional externo en un centro de salud o especializado.</p>
                    </div>
                </main>
            </div>
            <div class="content2" id="noRespondioTest" style="display: none;">
                <header class="in-header">
                    <?php
                    if (isset($_SESSION["studentID"])) {
                        echo '<button id="backToHome2">&lt;</button>';
                    } else {
                        echo '<button id="backToHome">&lt;</button>';
                    }
                    ?>
                </header>
                <h2 class="text-center p">Hola!</h2>
                <p class="text-center p">
                    Al parecer este usuario aun no ha realizado el test, debe realizarlo antes de verificar sus resultados.
                </p>
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