// Hacer la barra de navegación pegajosa al hacer scroll
window.addEventListener('scroll', () => {
    const header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 0);
});

// Alternar entre las dos secciones de listas
const btnListar1 = document.getElementById("listar-1");
const btnListar2 = document.getElementById("listar-2");
const sectionListar1 = document.getElementById("listar1");
const sectionListar2 = document.getElementById("listar2");
const contenedorListas = document.getElementById('contenedor-listas');

btnListar1.addEventListener('click', () => {
    btnListar1.classList.add('list-active');
    btnListar2.classList.remove('list-active');
    sectionListar1.classList.remove('ocultar');
    sectionListar2.classList.remove('ocultar');
    contenedorListas.classList.remove('height');
});

btnListar2.addEventListener('click', () => {
    btnListar2.classList.add('list-active');
    btnListar1.classList.remove('list-active');
    sectionListar1.classList.add('ocultar');
    sectionListar2.classList.add('ocultar');
    contenedorListas.classList.add('height');
});

// Inicializar DataTables
const dataTable = new DataTable('#example', {
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-CO.json',
    },
    responsive: true
});
