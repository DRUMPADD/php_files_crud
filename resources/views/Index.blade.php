@extends('layouts.base')
@section('title') Principal @endsection
@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/styles.css') }}">
@endsection
@section('content')
    <div class="menu">
        <button onclick="visualizar()">Visualizar</button>
        <button onclick="agregar()">Agregar</button>
        <button onclick="borrar()">Borrar</button>
    </div>

    <div id="visualizarDiv" class="contenido" style="display:none;">
        <!-- Contenido de visualización -->
        <p>Contenido a visualizar...</p>
        <embed id="vistaPrevia" type="application/pdf" width="400" height="400">
    </div>

    <div id="agregarDiv" class="contenido" style="display:none;">
        <!-- Contenido de agregar un archivo pdf -->
        <form method="POST" action="/archivo" enctype="multipart/form-data">
            @csrf
            <label for="nuevoElemento"></label>
            <input type="file" name="archivo" id="pdffFile" required>
            <button name="upload-pdf">Subir PDF</button>
        </form>
    </div>

    <div id="borrarDiv" class="contenido" style="display:none;">
        <!-- Contenido de borrar -->
        <p>Selecciona un elemento para borrar:</p>
        <select id="elementosParaBorrar"></select>
        <button type="button" onclick="borrarElemento()">Borrar</button>
    </div>

    <div class="files-box" style="height: 1000px; display: flex; align-items: start">
        @foreach ($files as $file)
            <div class="card">
                <h3>{{ $file->nombre }}</h3>
                <p>{{ $file->fecha_subida }}</p>
            </div>
        @endforeach
    </div>
@endsection
@section('scripts')
<script src="{{ url('assets/js/index.js') }}"></script>
@endsection