@extends('layouts.admin')

@section('main-content')

    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-lg-8 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Creando contenido</h6>
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

                    <form method="POST" action="{{ route('carpetacuatro.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <h6 class="heading-small text-muted mb-4">Información del Documento</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nombre_archivo" class="form-label">Nombre<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="nombre_archivo" name="nombre_archivo" class="form-control"
                                            placeholder="Nombre" value="{{ old('nombre') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="descripcion" class="form-label">Numero del Documento<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="numero_archivo" name="numero_archivo" class="form-control"
                                            placeholder="Numero del Documento" value="{{ old('numero') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="archivo" class="form-label">Fecha de registro<span
                                                class="small text-danger">*</span></label>
                                        <input type="date" id="fecha_registro" name="fecha_registro" class="form-control"
                                            value="{{ old('fecha_registro') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="archivo" class="form-label">Archivo<span
                                                class="small text-danger">*</span></label>
                                        <input type="file" id="archivo" name="archivo" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="carpeta_tres_id" value="{{ $carpeta_tres }}">

                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
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
