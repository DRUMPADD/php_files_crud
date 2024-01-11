// Función para ocultar todos los divs de contenido
function ocultarTodos() {
    document.getElementById("visualizarDiv").style.display = "none";
    document.getElementById("agregarDiv").style.display = "none";
    document.getElementById("borrarDiv").style.display = "none";
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
    document.getElementById("borrarDiv").style.display = "block";
    document.getElementById("borrarDiv").remove();

    // Simulación de elementos para borrar (puedes obtener estos elementos de tu base de datos)
    var elementos = ["Elemento 1", "Elemento 2", "Elemento 3"];

    // Llenar el dropdown con los elementos
    var select = document.getElementById("elementosParaBorrar");
    for (var i = 0; i < elementos.length; i++) {
        var option = document.createElement("option");
        option.text = elementos[i];
        select.appendChild(option);
    }
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