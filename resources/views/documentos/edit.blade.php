@extends('layouts.admin')

@section('main-content')

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="col-lg-8 order-lg-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Crear documentos</h6>
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

                <form method="POST" action="{{ route('documentos.update', $documento->id) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <h6 class="heading-small text-muted mb-4">Información del Documento</h6>

                    <div class="pl-lg-4">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre<span class="small text-danger">*</span></label>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" value="{{ old('nombre', $documento->nombre) }}">
                        </div>

                        <div class="form-group">
                            <label for="numero_documento" class="form-label">Numero del documento<span class="small text danger">*</span></label>
                            <input type="text" id="numero_documento" name="numero_documento" class="form-control" placeholder="Numero del documento" value="{{ old('numero_documento', $documento->numero_documento) }}">
                        </div>

                        <div class="form-group">
                            <label for="fecha_registro" class="form-label">Fecha de registro<span class="small text-danger">*</span></label>
                            <input type="date" id="fecha_registro" name="fecha_registro" class="form-control" value="{{ old('fecha_registro', $documento->fecha_registro) }}">
                        </div>

                        <div class="form-group">
                            <label for="archivo" class="form-label">Archivo<span class="small text-danger">*</span></label>
                            <input type="file" id="archivo" name="archivo" class="form-control">
                        </div>

                        <input type="hidden" name="carpeta_cuatro_id" value="{{ $carpeta_cuatro }}">

                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary" onclick="return confirm('Actualizado correctamente')">Actualizar</button>
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
