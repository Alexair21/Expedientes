@extends('layouts.auth')

@section('title', 'Register')

@section('main-content')
    <style>
        .bg-login-image {
            background-image: url('https://convenioandresbello.org/wp-content/uploads/2020/04/noticia38_teletrabajo_01.jpg');
            background-position: center;
        }

        .btn-user {
            font-size: 0.8rem;
            border-radius: 10rem;
            padding: 0.75rem 1rem;
        }

        .custom-control-input:checked~.custom-control-label::before {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .card {
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
        }

        .form-label {
            color: #4D72DE;
            /* Color acorde a una temática de cafetería */
        }

        .btn-primary {
            background-color: #4D72DE;
            /* Color de botón acorde a una temática de cafetería */
            border-color: #4D72DE;
        }

        .btn-primary:hover {
            background-color: #4D72DE;
            border-color: #4D72DE;
        }

        .navbar-brand-autodark img {
            max-height: 80px;
        }

        .icon {
            stroke: #4D72DE;
            /* Color del icono acorde a una temática de cafetería */
        }

        .container-tight {
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <div class="container container-tight py-4">
        <div class="card card-md shadow-lg">
            <div class="text-center mb-4">
                <a href="" class="navbar-brand navbar-brand-autodark">
                    <img src="https://cdn-icons-png.flaticon.com/512/8502/8502370.png" alt="logo"
                        class="navbar-brand-image">
                </a>
            </div>
            <h2 class="h2 text-center mb-4">Regístrese en su cuenta</h2>
            @if ($errors->any())
                <div class="alert alert-danger border-left-danger" role="alert">
                    <ul class="pl-4 my-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('register') }}" method="post" autocomplete="off" novalidate>
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Nombre" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                name="last_name" placeholder="Apellido" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        placeholder="Correo electrónico" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        placeholder="Contraseña" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password_confirmation"
                        placeholder="Confirmar contraseña" required>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                </div>
            </form>
            <div class="text-center text-muted mt-3">
                ¿Ya tienes una cuenta? <a href="{{ route('login') }}" tabindex="-1">Inicia sesión</a>
            </div>
        </div>
    </div>
@endsection
