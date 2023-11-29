<?php
ob_start();
session_start();

if (!isset($_SESSION["user_id"])) {
  header("Location: index.php");
} else if (isset($_GET['id'])) {
?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../public/img/icon.png" type="image/x-icon">
    <title>Test</title>
    <link rel="stylesheet" href="../public/css/test.css" />
    <link rel="stylesheet" href="../lib/toastify-js/toastify.css" />
  </head>

  <body>
  <input type="hidden" name="studentID" id="studentID" value="<?php echo $_GET['id'] ?>">
    <section class="initial_section" id="initial_section">
      <div class="content">
        <header class="in-header">
          <button id="backToHome">&lt;</button>
        </header>
        <h2 class="text-center p">Prueba de cribado de Dislexia App</h2>
        <p class="text-center p">
          Estos consejos te ayudarán a hacer el test lo mejor posible
        </p>
        <span class="text-center p">Un adulto tiene que supervisar este test</span>
        <main class="column">
          <div class="text-center md hydrated">
            <div class="img">
              <img alt="Duration" src="../public/img/duracion.svg" />
            </div>
            <h3>duración:<br />15 min</h3>
            <p>sin pausas</p>
          </div>
          <div class="text-center md hydrated">
            <div class="img">
              <img alt="Unique" src="../public/img/unica.svg" />
            </div>
            <h3>hacer<br />1 sola vez</h3>
            <p>no se debe repetir puesto que no mide la evolución</p>
          </div>
          <div class="text-center md hydrated">
            <div class="img">
              <img alt="individual" src="../public/img/individual.svg" />
            </div>
            <h3>es un test individual</h3>
            <p>no se puede realizar en grupo</p>
          </div>
          <div class="text-center md hydrated">
            <div class="img">
              <img alt="calm" src="../public/img/calm.svg" />
            </div>
            <h3>busca<br />la calma</h3>
            <p>para poder concentrarte y que no te interrumpan</p>
          </div>
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
        <button id="nextSection">Entendido :)</button>
      </div>
    </section>

    <section class="secondary_section" id="secondary_section" style="display: none">
      <div class="content text-center">
        <img alt="headphones" src="../public/img/auriculares.svg" class="main" />
        <h2 class="text-center">
          prueba de sonido<br />ponte los auriculares :)
        </h2>
        <span class="text-center p">
          dale al play y asegúrate de que puedes oír la voz que te guiará por el
          test, alto y claro
        </span>
        <button fill="clear" class="play md button button-clear activatable focusable hydrated" id="playAudio">
          <img alt="Play" src="../public/img/play-test.svg" />
        </button>
        <button class="btn-lg divor divor-secondary md button button-block button-round button-solid activatable focusable hydrated" disabled id="nextSection2">
          oigo todo genial
        </button>
      </div>
    </section>

    <section class="tertiary_section" id="tertiary_section" style="display: none">
      <div class="content text-center">
        <img alt="thumbs up" src="../public/img/thumbs_up.svg" class="main" />
        <h2 class="text-center p">¡ya está todo!</h2>
        <span class="text-center p">
          recuerda contestar todas las preguntas, solo necesitas pulsar la
          pantalla para ello (no hace falta arrastrar ni dibujar)
        </span>
        <h2 class="text-center">
          A partir de ahora tienes que contestar las preguntas, ¡sabemos que lo
          harás genial!
        </h2>
        <button id="go" class="btn-lg divor divor-secondary md button button-block button-round button-solid activatable focusable hydrated">
          Vamos allá
        </button>
      </div>
    </section>

    <section class="test_section" id="test_section" style="display: none">
      <article id="loadAudio">
        <div class="contenedor">
          <div class="onda"></div>
          <img src="../public/img/sound.gif" alt="Gif con efecto de onda" />
        </div>
      </article>
      <article id="test" style="display: none">
        <div class="progress-container">
          <svg class="progress-ring" width="60" height="60">
            <circle class="progress-ring-circle" cx="30" cy="30" r="24" fill="transparent" stroke="#3498db" stroke-width="6"></circle>
          </svg>
          <div id="temporizador" class="contador">10</div>
        </div>
        <div class="test_option" id="test_option">

        </div>
      </article>
      <article id="nextTest" style="display: none">
        <div>
          <h2>Resumen</h2>
          <p>Aciertos: <span id="aciertos">0</span></p>
          <button id="CotinueTest">Continuemos...</button>
        </div>
      </article>
    </section>
  </body>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="../lib/toastify-js/toastify.js"></script>
  <script src="../public/js/test.js"></script>

  </html>
<?php
} else {
  header("Location: home.php");
}
ob_end_flush();
?>