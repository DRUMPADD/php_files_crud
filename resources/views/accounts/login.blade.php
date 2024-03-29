@extends('layouts.base')
@section('title') Iniciar sesión @endsection
@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/login.css') }}">
@endsection
@section('content')
    <h1>Fluidos Mcgreen de México</h1>
    @include('layouts.partials.messages')
    <div class="form-box">
        <abbr title="Registro o inicio de sesión">
        <p class="change-option">
            <i class="fa-solid fa-right-to-bracket"></i>
        </p>
        </abbr>
        <form action="/login_user" method="post" class="form-login active">
            <h3>Iniciar sesión</h3>
            @csrf
            <div class="form-content">
                <label for="user">Usuario</label>
                <div class="form-input">
                    <input type="text" name="email" class="input" id="user">
                    <p>
                        <i class="fa-regular fa-user"></i>
                    </p>
                </div>
            </div>
            <div class="form-content">
                <label for="password">Contraseña</label>
                <div class="form-input">
                        <input type="password" name="password" class="input" id="password">
                        <p class="hide-password hide">
                        <i class="fa-regular fa-eye"></i>
                        </p>
                </div>
            </div>
            <input type="submit" value="Ingresar">
        </form>
        <form action="/register_user" method="post" class="form-register">
            <h3>Registro</h3>
            @csrf
            <div class="form-content">
                <label for="nombre">Nombre</label>
                <div class="form-input">
                    <input type="text" id="nombre" name="name" required>
                    <p>
                    <i class="fa-regular fa-user"></i>
                    </p>
                </div>
            </div>
            <div class="form-content">
                <label for="correo">Correo electrónico:</label>
                <div class="form-input">
                    <input type="text" id="correo" name="email" required>
                    <p>
                    <i class="fa-solid fa-at"></i>
                    </p>
                </div>
            </div>
            <div class="form-content">
                <label for="contrasenia">Contraseña:</label>
                <div class="form-input">
                    <input type="password" name="password" class="input" id="contrasenia">
                    <p class="hide-password">
                    <i class="fa-regular fa-eye"></i>
                    </p>
                </div>
            </div>
            <input type="submit" value="Registrar">
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/js/login.js') }}"></script>
@endsection