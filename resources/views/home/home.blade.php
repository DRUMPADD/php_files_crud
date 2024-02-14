@extends('layouts.base')

@section('content')
    <h1>Administrador de Archivos</h1>
    <div class="container  row">
        <div class="col-6 col-sm-4">
            <h3>Archivo</h3>
            <p>23 de Febrero de 2023</p>
        </div>
        @foreach ($files as $file)
            <div class="col-6 col-sm-4">
                <h3>{{ $file->nombre }}</h3>
                <iframe src="{{ asset('upload/'.$file->nombre) }}" width="400" height="300">
                    This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('upload/'.$file->nombre) }}">Download PDF</a>
                </iframe>
                <p>{{ $file->fecha_subida }}</p>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
@endsection