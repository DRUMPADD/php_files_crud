// Función para ocultar todos los divs de contenido
function ocultarTodos() {
    document.getElementById("visualizarDiv").style.display = "none";
    document.getElementById("agregarDiv").style.display = "none";
}

// Función para visualizar contenido
function visualizar() {
    ocultarTodos();
    document.getElementById("visualizarDiv").style.display = "block";
}

// Función para agregar contenido
function agregar() {
    ocultarTodos();
    document.getElementById("agregarDiv").style.display = "block";
}

// Función para borrar contenido
function borrar() {
    ocultarTodos();
    var elementos = ["Elemento 1", "Elemento 2", "Elemento 3"];
}

// Función para agregar un nuevo elemento
function agregarElemento() {
    let pdffFile = document.querySelector('#pdffFile').files[0];
    let pdffFileURL = URL.createObjectURL(pdffFile) + "#toolbar=0";
    document.querySelector('#vistaPrevia').setAttribute('src', pdffFileURL);
}
document.querySelector('#pdffFile').addEventListener('change', agregarElemento)

// Función para borrar un elemento seleccionado
function borrarElemento() {
    var select = document.getElementById("elementosParaBorrar");
    var elementoSeleccionado = select.options[select.selectedIndex].text;
    // Aquí podrías realizar la lógica para borrar el elemento seleccionado de tu base de datos
    console.log("Borrar elemento: " + elementoSeleccionado);
}