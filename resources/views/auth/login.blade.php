@extends('layouts.auth')

@section('title', 'Login')

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
            <h2 class="h2 text-center mb-4">Inicie sesión en su cuenta</h2>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        placeholder="Ingrese su correo" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <div class="input-group input-group-flat">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Ingrese su contraseña" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                </div>
            </form>

        </div>
    </div>
@endsection
