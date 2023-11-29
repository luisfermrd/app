// Variables globales
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
let keyboard = document.getElementById("keyboard");

let numTest = 0;
let attempts = 0;
let failedAttempts = 0;
let successfulAttempts = 0;
let answers = [];
let con = 0;
let lines = [];
let currentLineIndex = 0;

// Tipos de teclado
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
const type4 = `
<div id="pressedKeys">

</div>
<div id="keyboard" class="groupKeys">
    
</div>`;

// Datos para las pruebas
const dataForTest = [
  {
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
    arreglo: [
      ["l", "i"],
      ["o", "u"],
      ["r", "n"],
      ["h", "n"],
      ["a", "e"],
      ["f", "t"],
      ["c", "s"],
      ["s", "z"],
      ["v", "w"],
      ["y", "g"],
    ],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_group.mp3",
    type: 2,
  },
  {
    arreglo: [
      ["d", "b"],
      ["q", "p"],
      ["n", "m"],
      ["v", "u"],
      ["ñ", "n"],
      ["e", "a"],
      ["g", "c"],
      ["z", "s"],
      ["w", "v"],
      ["t", "d"],
    ],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_group.mp3",
    type: 2,
  },
  {
    arreglo: [
      ["x", "y"],
      ["m", "n"],
      ["s", "z"],
      ["d", "t"],
      ["c", "g"],
      ["f", "t"],
      ["r", "n"],
      ["l", "i"],
      ["a", "e"],
      ["k", "h"],
    ],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_group.mp3",
    type: 2,
  },
  {
    arreglo: [
      ["k", "h"],
      ["y", "g"],
      ["s", "z"],
      ["t", "d"],
      ["e", "a"],
      ["c", "g"],
      ["r", "n"],
      ["l", "i"],
      ["a", "e"],
      ["x", "y"],
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
  },
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
  {
    arreglo: [
      ["ELEF NTE", ["C", "X", "R", "E", "A", "M"], 4],
      ["COCODR LO", ["D", "I", "C", "R", "A", "T"], 1],
      ["HIPÓDROM ", ["L", "U", "G", "O", "A", "R"], 3],
      ["MAGNOL A", ["I", "O", "M", "E", "R", "U"], 0],
      ["EXC LENCIA", ["B", "P", "G", "O", "T", "E"], 5],
      ["COMPUT DORA", ["Z", "V", "M", "U", "T", "A"], 5],
      ["INSTR MENTO", ["O", "P", "U", "I", "A", "L"], 2],
      ["TEL VISIÓN", ["M", "E", "N", "L", "C", "T"], 1],
      ["DELIBER CIÓN", ["H", "I", "T", "R", "A", "N"], 4],
      ["EXTRAORD NARIO", ["L", "E", "I", "R", "D", "I"], 2],
    ],
    src: "../public/song/inserttarget.mp3",
    type: 4,
  },
  {
    arreglo: [
      ["EUCAL PTO", ["M", "P", "I", "L", "E", "T"], 2],
      ["PARTIC LARIDAD", ["C", "I", "L", "U", "T", "D"], 3],
      ["FOT GRAFÍA", ["H", "R", "T", "I", "F", "O"], 5],
      ["INDEP NDIENTE", ["C", "I", "T", "N", "D", "E"], 5],
      ["LAB RATORIO", ["M", "O", "T", "R", "A", "I"], 1],
      ["MALABAR STA", ["N", "O", "R", "A", "L", "I"], 5],
      ["TRANSPOR ADOR", ["C", "D", "A", "T", "R", "N"], 3],
      ["EXPERIM NTACIÓN", ["R", "M", "E", "N", "T", "O"], 2],
      ["AV NTURERO", ["P", "O", "R", "V", "E", "T"], 4],
      ["IMPRESCIND BLE", ["N", "S", "P", "C", "R", "I"], 5],
    ],
    src: "../public/song/inserttarget.mp3",
    type: 4,
  },
  {
    arreglo: [
      ["TARDBE", 4],
      ["FLOER", 3],
      ["EJEMPILO", 5],
      ["JUESGO", 3],
      ["GRPANDE", 2],
      ["PATATRA", 5],
      ["ÁLBUNM", 4],
      ["RÁPDIDO", 2],
      ["CARTPON", 4],
      ["ESXCRITO", 2],
    ],
    src: "../public/song/pickletter.mp3",
    type: 5,
  },
  {
    arreglo: [
      // Hay que arreglar este

      ["FELICIDAD", 8],
      ["CIENCIA", 3],
      ["AMIGO", 4],
      ["SÍNTOMA", 5],
      ["COMPUTADORA", 7],
      ["COMPROMISO", 6],
      ["DECEPCIÓN", 4],
      ["EMPRESA", 6],
      ["IMPORTANTE", 4],
      ["CIENCIA", 2],
    ],
    src: "../public/song/pickletter.mp3",
    type: 5,
  },
  {
    arreglo: [
      ["CASA", "ACAS"],
      ["PERRO", "ROPER"],
      ["GATO", "OGAT"],
      ["SOL", "LOS"],
      ["CIELO", "OCEIL"],
      ["ARBOL", "OLBAR"],
      ["AGUA", "AUGA"],
      ["LIBRO", "ORBIL"],
      ["MESA", "AMES"],
      ["SILLA", "ILLAS"],
    ],
    src: "../public/song/orderchunks_letters.mp3",
    type: 6,
  },
  {
    arreglo: [
      ["SILLA", "ILLAS"],
      ["MESA", "AMES"],
      ["LIBRO", "ORBIL"],
      ["ARBOL", "OLBAR"],
      ["CIELO", "OCEIL"],
      ["SOL", "LOS"],
      ["GATO", "OGAT"],
      ["AGUA", "AUGA"],
      ["PERRO", "ROPER"],
      ["CASA", "ACAS"],
    ],
    src: "../public/song/orderchunks_letters.mp3",
    type: 6,
  },
  {
    arreglo: [
      ["CAMINAR", ["MI", "CA", "NAR"]],
      ["ESTOFADO", ["DO", "FA", "ES", "TO"]],
      ["LIBRO", ["BRO", "LI"]],
      ["SISTEMA", ["TE", "MA", "SIS"]],
      ["CAFE", ["FE", "CA"]],
      ["ARAÑA", ["RA", "ÑA", "A"]],
      ["GATO", ["TO", "GA"]],
      ["COMPUTADORA", ["TA", "DO", "RA", "COM", "PU"]],
      ["EMPRESA", ["SA", "PRE", "EM"]],
      ["CIENCIA", ["CIA", "CI", "EN"]],
    ],
    src: "../public/song/orderchunks_syllable.mp3",
    type: 6,
  },
];

// Listeners de los botones
backToHome.addEventListener("click", () => {
  window.location.href = "home.php";
});

nextSection.addEventListener("click", () => {
  showHideSections("initial_section", "secondary_section");
});

playAudio.addEventListener("click", () => {
  playAudioFile("../public/song/activa_el_volumen_de_tu_ordenador.mp3", () => {
    nextSection2.removeAttribute("disabled");
  });
});

nextSection2.addEventListener("click", () => {
  showHideSections("secondary_section", "tertiary_section");
});

go.addEventListener("click", () => {
  showHideSections("tertiary_section", "test_section");
  startTest();
});

CotinueTest.addEventListener("click", () => {
  nextTest.style.display = "none";
  if (numTest >= dataForTest.length) {
    console.log("Se ha finalizado el test");
    printTestResults();
  } else {
    showHideSections("test_section", "loadAudio");
    startNextTest();
  }
});

// Funciones auxiliares (separadas por funcionalidad)
function showHideSections(hideSectionId, showSectionId) {
  document.getElementById(hideSectionId).style.display = "none";
  document.getElementById(showSectionId).style.display = "flex";
}

function playAudioFile(src, callback) {
  const audio = new Audio(src);
  audio.addEventListener("ended", callback);
  audio.play();
}

function startTest() {
  showHideSections("tertiary_section", "test_section");
  setTimeout(() => {
    playAudioFile(dataForTest[numTest].src, () => {
      showHideSections("loadAudio", "test");
      createButtons(dataForTest[numTest]);
      test.style.display = "flex";
      startTimer();
      setTimeout(() => {
        finishTest();
      }, 12000);
    });
  }, 500);
}

function startNextTest() {
  showHideSections("test_section", "loadAudio");
  setTimeout(() => {
    playAudioFile(dataForTest[numTest].src, () => {
      showHideSections("loadAudio", "test");
      createButtons(dataForTest[numTest]);
      test.style.display = "flex";
      startTimer();
      setTimeout(() => {
        finishTest();
      }, 12000);
    });
  }, 500);
}

function finishTest() {
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
  console.log("Test N° ", numTest);
  if (numTest == dataForTest.length) {
    console.log("Se ha finalizado el test XD");
    printTestResults();
  }
}

function printTestResults() {
  const totalAttempts = answers.reduce(
    (total, item) => total + item.attempts,
    0
  );
  const totalSuccessfulAttempts = answers.reduce(
    (total, item) => total + item.successfulAttempts,
    0
  );
  const overallEffectiveness =
    (totalSuccessfulAttempts / totalAttempts) * 100 || 0;

  console.log("Efectividad General:", overallEffectiveness.toFixed(2) + "%");
}

function createButtons(obj) {
  let randomNumber1, randomNumber2, randomNumber3;
  const div = document.createElement("div");

  if ("class" in obj) {
    keyboard.innerHTML = type4;
  } else {
    keyboard.innerHTML = type3;
  }

  keyboard.appendChild(div);

  // Crea los botones
  const button1 = document.createElement("button");
  const button2 = document.createElement("button");
  const button3 = document.createElement("button");

  // Obtén números aleatorios únicos para los botones
  do {
    randomNumber1 = Math.floor(Math.random() * 3);
    randomNumber2 = Math.floor(Math.random() * 3);
    randomNumber3 = Math.floor(Math.random() * 3);
  } while (
    randomNumber1 == randomNumber2 ||
    randomNumber1 == randomNumber3 ||
    randomNumber2 == randomNumber3
  );

  // Establece el texto de los botones
  button1.textContent = obj.options[randomNumber1];
  button2.textContent = obj.options[randomNumber2];
  button3.textContent = obj.options[randomNumber3];

  // Establece las clases para los botones
  button1.classList.add("btn");
  button2.classList.add("btn");
  button3.classList.add("btn");

  // Establece los manejadores de eventos para los botones
  button1.addEventListener("click", () => checkAnswer(button1, obj));
  button2.addEventListener("click", () => checkAnswer(button2, obj));
  button3.addEventListener("click", () => checkAnswer(button3, obj));

  // Agrega los botones al contenedor div
  div.appendChild(button1);
  div.appendChild(button2);
  div.appendChild(button3);
}

function checkAnswer(button, obj) {
  attempts++;
  const selectedText = button.textContent;
  const correctText = obj.correct;
  const correct = selectedText === correctText;

  if (correct) {
    successfulAttempts++;
  } else {
    failedAttempts++;
  }

  console.log(
    "Intento N°",
    attempts,
    "| Aciertos:",
    successfulAttempts,
    "| Fallos:",
    failedAttempts
  );

  // Realiza las operaciones correspondientes al resultado (puedes ajustar según tus necesidades)
  if (correct) {
    console.log("¡Respuesta correcta!");
  } else {
    console.log("Respuesta incorrecta. La respuesta correcta es:", correctText);
  }
}

function startTimer() {
  let time = 11;
  const timerElement = document.getElementById("timer");

  const timerInterval = setInterval(() => {
    time--;
    timerElement.textContent = time;

    if (time <= 0) {
      clearInterval(timerInterval);
    }
  }, 1000);
}
