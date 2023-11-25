const backToHome = document.getElementById("backToHome");
const nextSection = document.getElementById("nextSection");
const nextSection2 = document.getElementById("nextSection2");
const go = document.getElementById("go");
const test_section = document.getElementById("test_section");
const loadAudio = document.getElementById("loadAudio");
const test = document.getElementById("test");
const nextTest = document.getElementById("nextTest");
const playAudio = document.getElementById("playAudio");
const CotinueTest = document.getElementById("CotinueTest");

let numTest = 0;
let attempts = 0;
let failedAttempts = 0;
let successfulAttempts = 0;
let answers = [];

const dataForTest = [
  {
    principal: "e",
    secundaria: ["a"],
    numVeces: 9,
    class: "x3",
    src: "../public/song/clicktarget_e.mp3",
  },
  {
    principal: "g",
    secundaria: ["p"],
    numVeces: 9,
    class: "x3",
    src: "../public/song/clicktarget_g.mp3",
  },
  {
    principal: "b",
    secundaria: ["d", "p"],
    numVeces: 9,
    class: "x3",
    src: "../public/song/clicktarget_b.mp3",
  },
  {
    principal: "d",
    secundaria: ["b", "p"],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_d.mp3",
  },
  {
    principal: "ba",
    secundaria: ["da", "pa"],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_ba.mp3",
  },
  {
    principal: "gar",
    secundaria: ["jar"],
    numVeces: 16,
    class: "x4",
    src: "../public/song/clicktarget_gar.mp3",
  },
  {
    principal: "pla",
    secundaria: ["bla", "fla", "cla"],
    numVeces: 25,
    class: "x5",
    src: "../public/song/clicktarget_pla.mp3",
  },
  {
    principal: "bla",
    secundaria: ["fla", "cla", "pla"],
    numVeces: 25,
    class: "x5",
    src: "../public/song/clicktarget_bla.mp3",
  },
  {
    principal: "glis",
    secundaria: ["lis", "clis", "glit"],
    numVeces: 25,
    class: "x5",
    src: "../public/song/clicktarget_glis.mp3",
  },
  {
    principal: "pala",
    secundaria: ["bala", "dala", "mala"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_pala.mp3",
  },
  {
    principal: "boda",
    secundaria: ["doda", "poda", "moda"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_boda.mp3",
  },
  {
    principal: "plata",
    secundaria: ["blata", "clata", "flata"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_plata.mp3",
  },
  {
    principal: "labrado",
    secundaria: ["labrabo", "labrada", "labran"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_labrado.mp3",
  },
  {
    principal: "group",
    secundaria: ["grup"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_group.mp3",
  },
  {
    principal: "pamada",
    secundaria: ["bamada"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_pamada.mp3",
  },
  {
    principal: "dapama",
    secundaria: ["dabama"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_dapama.mp3",
  },
  {
    principal: "dabapa",
    secundaria: ["dapaba"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_dabapa.mp3",
  },
  {
    principal: "dabapaba",
    secundaria: ["dapaba"],
    numVeces: 36,
    class: "x6",
    src: "../public/song/clicktarget_dabapaba.mp3",
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
      loadAudio.style.display = "none";
      crearBotones(dataForTest[numTest]);
      test.style.display = "flex";
      setTimeout(() => {
        answers.push({
            attempts,
            successfulAttempts,
            failedAttempts
        })
        document.getElementById('aciertos').textContent = successfulAttempts;
        attempts = 0;
        successfulAttempts = 0;
        failedAttempts = 0;
        numTest++;
        test.style.display = "none";
        nextTest.style.display = "flex";
        console.log("Se acabo el tiempo, next", answers);

      }, 10000);
    });
  }, 1000);
});

CotinueTest.addEventListener("click", () => {
  nextTest.style.display = "none";
  test_section.style.display = "flex";
  loadAudio.style.display = "flex";
  setTimeout(() => {
    reproducirAudio(dataForTest[numTest].src, () => {
      loadAudio.style.display = "none";
      crearBotones(dataForTest[numTest]);
      test.style.display = "flex";
      setTimeout(() => {
        answers.push({
            attempts,
            successfulAttempts,
            failedAttempts
        })
        document.getElementById('aciertos').textContent = successfulAttempts;
        attempts = 0;
        successfulAttempts = 0;
        failedAttempts = 0;
        numTest++;
        test.style.display = "none";
        nextTest.style.display = "flex";
        console.log("Se acabo el tiempo, next", answers);
      }, 10000);
    });
  }, 1000);
});

async function reproducirAudio(src, callback) {
  const audio = new Audio(src);
  audio.addEventListener("ended", function () {
    callback();
  });
  await audio.play();
}

function crearBotones(obj) {
  const div = document.createElement("div");
  div.classList.add(obj.class);

  const numeroAleatorio =
    Math.floor(Math.random() * (obj.numVeces - 1 - 0 + 1)) + 0;
  for (let i = 0; i < obj.numVeces; i++) {
    const Button = document.createElement("button");
    Button.classList.add("key");
    if (numeroAleatorio == i) {
      Button.dataset.key = obj.principal;
      Button.textContent = obj.principal;
    } else {
      const i =
        Math.floor(Math.random() * (obj.secundaria.length - 1 - 0 + 1)) + 0;
      Button.dataset.key = obj.secundaria[i];
      Button.textContent = obj.secundaria[i];
    }

    div.appendChild(Button);
  }
  limpiarContenedor(test);
  test.appendChild(div);
  listenSelected(obj);
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

        if (numTest >= dataForTest.length) {
        }

        crearBotones(obj);
      }
    });
  });
}

function limpiarContenedor(contenedor) {
  while (contenedor.firstChild) {
    contenedor.removeChild(contenedor.firstChild);
  }
}
