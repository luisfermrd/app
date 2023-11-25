const backToHome = document.getElementById("backToHome");
const nextSection = document.getElementById("nextSection");
const nextSection2 = document.getElementById("nextSection2");
const go = document.getElementById("go");
const test_section = document.getElementById("test_section");
const loadAudio = document.getElementById("loadAudio");
const test = document.getElementById("test");
const testOption = document.getElementById("test_option");
const nextTest = document.getElementById("nextTest");
const playAudio = document.getElementById("playAudio");
const CotinueTest = document.getElementById("CotinueTest");
let pressedKeysElement = document.getElementById("pressedKeys");

let numTest = 0;
let attempts = 0;
let failedAttempts = 0;
let successfulAttempts = 0;
let answers = [];
let con = 0;
let lines = [];
let currentLineIndex = 0; // Índice de la línea actual
const type3 = `
<div id="pressedKeys">

</div>
<div class="keyboard">
    <div class="fila1">
        <button class="key2 tab disables" data-key="">Tab</button>
        <button class="key2" data-key="Q">Q</button>
        <button class="key2" data-key="W">W</button>
        <button class="key2" data-key="E">E</button>
        <button class="key2" data-key="R">R</button>
        <button class="key2" data-key="T">T</button>
        <button class="key2" data-key="Y">Y</button>
        <button class="key2" data-key="U">U</button>
        <button class="key2" data-key="I">I</button>
        <button class="key2" data-key="O">O</button>
        <button class="key2" data-key="P">P</button>
    </div>

    <div class="fila2">
        <button class="key2 bloq-meyus disables" data-key="">Bloq Mayús</button>
        <button class="key2" data-key="A">A</button>
        <button class="key2" data-key="S">S</button>
        <button class="key2" data-key="D">D</button>
        <button class="key2" data-key="F">F</button>
        <button class="key2" data-key="G">G</button>
        <button class="key2" data-key="H">H</button>
        <button class="key2" data-key="J">J</button>
        <button class="key2" data-key="K">K</button>
        <button class="key2" data-key="L">L</button>
        <button class="key2" data-key="Ñ">Ñ</button>
    </div>

    <div class="fila3">
        <button class="key2 mayus disables" data-key="">Mayús</button>
        <button class="key2 disables" data-key="">
            <>
        </button>
        <button class="key2" data-key="Z">Z</button>
        <button class="key2" data-key="X">X</button>
        <button class="key2" data-key="C">C</button>
        <button class="key2" data-key="V">V</button>
        <button class="key2" data-key="B">B</button>
        <button class="key2" data-key="N">N</button>
        <button class="key2" data-key="M">M</button>
        <button class="key2 disables" data-key="">,</button>
        <button class="key2 disables" data-key="">.</button>
        <button class="key2 disables" data-key="">-</button>
    </div>

    <div class="fila4">
        <button class="key2 f1 disables" data-key="">Ctrl</button>
        <button class="key2 f1 disables" data-key="">Win</button>
        <button class="key2 f1 disables" data-key="">alt</button>
        <button class="key2 espacio" data-key=" "></button> </button>
        <button class="key2 f1 disables" data-key="">AltGr</button>
        <button class="key2 f1 disables" data-key="">Fn</button>
    </div>
</div>`;

const dataForTest = [
  /* {
    principal: "e",
    secundaria: ["a"],
    numVeces: 9,
    class: "x3",
    src: "../public/song/clicktarget_e.mp3",
    type: 1,
  },
  {
    principal: "g",
    secundaria: ["p"],
    numVeces: 9,
    class: "x3",
    src: "../public/song/clicktarget_g.mp3",
    type: 1,
  },
  {
    principal: "b",
    secundaria: ["d", "p"],
    numVeces: 9,
    class: "x3",
    src: "../public/song/clicktarget_b.mp3",
    type: 1,
  },
  {
    principal: "d",
    secundaria: ["b", "p"],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_d.mp3",
    type: 1,
  },
  {
    principal: "ba",
    secundaria: ["da", "pa"],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_ba.mp3",
    type: 1,
  },
  {
    principal: "gar",
    secundaria: ["jar"],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_gar.mp3",
    type: 1,
  },
  {
    principal: "pla",
    secundaria: ["bla", "fla", "cla"],
    numVeces: 25,
    class: "x5",
    src: "../public/song/clicktarget_pla.mp3",
    type: 1,
  },
  {
    principal: "bla",
    secundaria: ["fla", "cla", "pla"],
    numVeces: 25,
    class: "x5",
    src: "../public/song/clicktarget_bla.mp3",
    type: 1,
  },
  {
    principal: "glis",
    secundaria: ["lis", "clis", "glit"],
    numVeces: 25,
    class: "x5",
    src: "../public/song/clicktarget_glis.mp3",
    type: 1,
  },
  {
    principal: "pala",
    secundaria: ["bala", "dala", "mala"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_pala.mp3",
    type: 1,
  },
  {
    principal: "boda",
    secundaria: ["doda", "poda", "moda"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_boda.mp3",
    type: 1,
  },
  {
    principal: "plata",
    secundaria: ["blata", "clata", "flata"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_plata.mp3",
    type: 1,
  },
  {
    principal: "labrado",
    secundaria: ["labrabo", "labrada", "labran"],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_labrado.mp3",
    type: 1,
  }, 
  {
    arreglo: [
      ["b", "d"],
      ["p", "q"],
      ["m", "n"],
      ["u", "v"],
      ["n", "ñ"],
      ["a", "e"],
      ["c", "g"],
      ["s", "z"],
      ["v", "w"],
      ["d", "t"],
    ],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_group.mp3",
    type: 2,
  },
   {
    principal: "pamata",
    secundaria: ["bamada"],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_pamata.mp3",
    type: 1,
  },
  {
    principal: "dapama",
    secundaria: ["dabama"],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_dapama.mp3",
    type: 1,
  },
  {
    principal: "dabapa",
    secundaria: ["dapaba"],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_dabapa.mp3",
    type: 1,
  },
  {
    principal: "dabapaba",
    secundaria: ["dapaba"],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_dabapaba.mp3",
    type: 1,
  },*/
  {
    palabra: "BEBIDA",
    src: "../public/song/hearwrite_bebida.mp3",
    type: 3,
  },
  {
    palabra: "PRINCIPIO",
    src: "../public/song/hearwrite_principio.mp3",
    type: 3,
  },
  {
    palabra: "ARBITRARIO",
    src: "../public/song/hearwrite_arbitrario.mp3",
    type: 3,
  },
  {
    palabra: "PERCEPCION",
    src: "../public/song/hearwrite_percepcion.mp3",
    type: 3,
  },
  {
    palabra: "TADA",
    src: "../public/song/hearwrite_tada.mp3",
    type: 3,
  },
  {
    palabra: "DANAMA",
    src: "../public/song/hearwrite_danama.mp3",
    type: 3,
  },
  {
    palabra: "MABADANA",
    src: "../public/song/hearwrite_mabadana.mp3",
    type: 3,
  },
  {
    palabra: "LALADALA",
    src: "../public/song/hearwrite_laladala.mp3",
    type: 3,
  },
];

backToHome.addEventListener("click", () => {
  window.location.href = "home.php";
});

nextSection.addEventListener("click", () => {
  document.getElementById("initial_section").style.display = "none";
  document.getElementById("secondary_section").style.display = "flex";
});

playAudio.addEventListener("click", () => {
  var audio = new Audio("../public/song/activa_el_volumen_de_tu_ordenador.mp3");
  audio.play();
  nextSection2.removeAttribute("disabled");
});

nextSection2.addEventListener("click", () => {
  document.getElementById("secondary_section").style.display = "none";
  document.getElementById("tertiary_section").style.display = "flex";
});

go.addEventListener("click", () => {
  document.getElementById("tertiary_section").style.display = "none";
  test_section.style.display = "flex";
  setTimeout(() => {
    reproducirAudio(dataForTest[numTest].src, () => {
      console.log("Se reprodujo el audio");
      loadAudio.style.display = "none";
      crearBotones(dataForTest[numTest]);
      test.style.display = "flex";
      temporizador();
      setTimeout(() => {
        answers.push({
          attempts,
          successfulAttempts,
          failedAttempts,
        });
        document.getElementById("aciertos").textContent = successfulAttempts;
        attempts = 0;
        successfulAttempts = 0;
        failedAttempts = 0;
        numTest++;
        test.style.display = "none";
        nextTest.style.display = "flex";
        console.log("Se acabo el tiempo, next", answers);
      }, 12000);
    });
  }, 500);
});

CotinueTest.addEventListener("click", () => {
  nextTest.style.display = "none";
  if (numTest >= dataForTest.length) {
    console.log("se acabo el test");
  } else {
    test_section.style.display = "flex";
    loadAudio.style.display = "flex";
    setTimeout(() => {
      reproducirAudio(dataForTest[numTest].src, () => {
        console.log("Se reprodujo el audio");
        loadAudio.style.display = "none";
        crearBotones(dataForTest[numTest]);
        test.style.display = "flex";
        temporizador();
        setTimeout(() => {
          answers.push({
            attempts,
            successfulAttempts,
            failedAttempts,
          });
          document.getElementById("aciertos").textContent = successfulAttempts;
          attempts = 0;
          successfulAttempts = 0;
          failedAttempts = 0;
          con = 0;
          lines = [];
          currentLineIndex = 0;
          numTest++;
          test.style.display = "none";
          nextTest.style.display = "flex";
          console.log("Se acabo el tiempo, next", answers);
        }, 12000);
      });
    }, 500);
  }
});

async function reproducirAudio(src, callback) {
  const audio = new Audio(src);
  audio.addEventListener("ended", function () {
    callback();
  });
  await audio.play();
}

function crearBotones(obj) {
  let numeroAleatorio1, numeroAleatorio2, numeroAleatorio3;
  const div = document.createElement("div");
  if ("class" in obj) {
    div.classList.add(obj.class);
  }

  if ("numVeces" in obj) {
    let [n1, n2, n3] = obtenerNumerosAleatorios(0, obj.numVeces - 1);
    numeroAleatorio1 = n1;
    numeroAleatorio2 = n2;
    numeroAleatorio3 = n3;
  } else {
    console.log(" NO tiene numVeces");
  }
  switch (obj.type) {
    case 1:
      for (let i = 0; i < obj.numVeces; i++) {
        const Button = document.createElement("button");
        Button.classList.add("key");
        if (
          numeroAleatorio1 == i ||
          numeroAleatorio2 == i ||
          numeroAleatorio3 == i
        ) {
          Button.dataset.key = obj.principal;
          Button.textContent = obj.principal;
        } else {
          const j =
            Math.floor(Math.random() * (obj.secundaria.length - 1 - 0 + 1)) + 0;
          Button.dataset.key = obj.secundaria[j];
          Button.textContent = obj.secundaria[j];
        }

        div.appendChild(Button);
      }
      limpiarContenedor(testOption);
      testOption.appendChild(div);
      listenSelected(obj);
      break;
    case 2:
      for (let i = 0; i < obj.numVeces; i++) {
        const Button = document.createElement("button");
        Button.classList.add("key");
        if (numeroAleatorio1 == i) {
          Button.dataset.key = obj.arreglo[con][0];
          Button.textContent = obj.arreglo[con][0];
        } else {
          Button.dataset.key = obj.arreglo[con][1];
          Button.textContent = obj.arreglo[con][1];
        }

        div.appendChild(Button);
      }
      con++;
      if (con == obj.arreglo.length) {
        con = 0;
      }
      limpiarContenedor(testOption);
      testOption.appendChild(div);
      listenSelected2(obj);
      break;
    case 3:
      limpiarContenedor(testOption);
      testOption.innerHTML = type3;
      pressedKeysElement = document.getElementById("pressedKeys");
      generarLineas(obj.palabra);
      listenSelected3(obj);
      break;

    default:
      console.log("Error en el tipo de test");
      break;
  }
}

function listenSelected(obj) {
  const keys = document.querySelectorAll(".key");

  keys.forEach((key) => {
    key.addEventListener("click", () => {
      const keyValue = key.dataset.key;
      if (keyValue != "") {
        attempts++;
        if (keyValue === obj.principal) {
          successfulAttempts++;
        } else {
          failedAttempts++;
        }
        console.log(attempts, successfulAttempts, failedAttempts);

        crearBotones(obj);
      }
    });
  });
}

function listenSelected2(obj) {
  const keys = document.querySelectorAll(".key");

  keys.forEach((key) => {
    key.addEventListener("click", () => {
      const keyValue = key.dataset.key;
      if (keyValue != "") {
        attempts++;
        if (keyValue === obj.arreglo[con - 1][0]) {
          successfulAttempts++;
        } else {
          failedAttempts++;
        }
        console.log(attempts, successfulAttempts, failedAttempts);

        crearBotones(obj);
      }
    });
  });
}

function listenSelected3(obj) {
  const keys = document.querySelectorAll(".key2");

  keys.forEach((key) => {
    key.addEventListener("click", () => {
      const keyValue = key.dataset.key;
      if (keyValue != "") {
        if (currentLineIndex < lines.length) {
          const line = lines[currentLineIndex];
          line.textContent = keyValue;
          currentLineIndex++;
          if (currentLineIndex === lines.length) {
            attempts++;
            const typedWord = lines.map((line) => line.textContent).join("");
            if (typedWord.toUpperCase() === obj.palabra) {
              successfulAttempts++;
            } else {
              failedAttempts++;
            }
          }
        }
      }
    });
  });
}

function limpiarContenedor(contenedor) {
  while (contenedor.firstChild) {
    contenedor.removeChild(contenedor.firstChild);
  }
}

function obtenerNumerosAleatorios(min, max) {
  let numeros = [];

  while (numeros.length < 3) {
    let numeroAleatorio = Math.floor(Math.random() * (max - min + 1)) + min;

    // Verificar si el número ya está en la lista
    if (!numeros.includes(numeroAleatorio)) {
      numeros.push(numeroAleatorio);
    }
  }

  return numeros;
}

function temporizador() {
  const progressCircle = document.querySelector(".progress-ring-circle");
  let segundos = 10;
  if (segundos == 10) {
    progressCircle.style.strokeDashoffset = 0;
  }
  const duracion = segundos;
  const temporizadorElement = document.getElementById("temporizador");
  const dashoffset = progressCircle.getTotalLength();
  function actualizarTemporizador() {
    temporizadorElement.textContent = segundos;
    const progreso = (segundos / duracion) * 100;
    const nuevoDashoffset = ((100 - progreso) / 100) * dashoffset;
    progressCircle.style.strokeDashoffset = nuevoDashoffset;

    if (segundos === 0) {
      clearInterval(temporizadorInterval);
    } else {
      segundos--;
    }
  }
  const temporizadorInterval = setInterval(actualizarTemporizador, 1000);
}

function generarLineas(palabra) {
  lines = [];
  currentLineIndex = 0;
  const wordLines = palabra.length;
  for (let i = 0; i < wordLines; i++) {
    const line = document.createElement("div");
    line.classList.add("line");
    lines.push(line);
    pressedKeysElement.appendChild(line);
  }
}
