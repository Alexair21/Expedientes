@extends('layouts.admin')

@section('main-content')

    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-lg-8 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Crear carpeta</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>¡Revise los campos!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('carpetatres.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <h6 class="heading-small text-muted mb-4">Información de la carpeta</h6>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control"
                                placeholder="Nombre de la carpeta" value="{{ old('nombre') }}">
                        </div>

                        <input type="hidden" name="carpeta_dos_id" value="{{ $carpeta_dos }}">

                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
