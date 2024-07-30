@extends('layouts.admin')

@section('main-content')

    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-lg-8 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Crear expediente</h6>
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

                    <form method="POST" action="{{ route('expedientes.store') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <h6 class="heading-small text-muted mb-4">Información del Expediente</h6>

                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label for="numero_expediente" class="form-label">Número Expediente<span
                                        class="small text-danger">*</span></label>
                                <input type="number" id="numero_expediente" name="numero_expediente" class="form-control"
                                    placeholder="Número de expediente" value="{{ old('numero_expediente') }}">
                            </div>

                            <div class="form-group">
                                <label for="descripcion" class="form-label">Nombre del documento<span
                                        class="small text-danger">*</span></label>
                                <input type="text" id="nombre_documento" name="nombre_documento" class="form-control"
                                    placeholder="Nombre del documento" value="{{ old('nombre_documento') }}">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="etapa" class="form-label">Encargado<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="encargado" name="encargado" class="form-control"
                                            placeholder="Encargado" value="{{ old('encargado') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="responsable" class="form-label">Fecha de emisión<span
                                                class="small text-danger">*</span></label>
                                        <input type="date" id="fecha_emision" name="fecha_emision" class="form-control"
                                            placeholder="Fecha de emisión" value="{{ old('fecha_emision') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="fecha_inicio" class="form-label">Hora de emisión<span
                                                class="small text-danger">*</span></label>
                                        <input type="time" id="hora_emision" name="hora_emision" class="form-control"
                                            placeholder="Hora de emisión" value="{{ old('hora_emision') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="fecha_fin" class="form-label">Area remitida<span
                                                class="small text-danger">*</span></label>
                                        <select name="area_remitida" id="area_remitida" class="form-control">
                                            <option value="">Seleccione...</option>
                                            <option value="Gerencia">Gerencia</option>
                                            <option value="Gerencia de obras">Gerencia de obras</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group focused">
                                <label for="fecha_fin" class="form-label">Archivo<span
                                        class="small text-danger">*</span></label>
                                <input type="file" id="archivo" class="form-control" name="archivo">
                            </div>

                            <input type="hidden" id="carpeta_id" name="carpeta_id" class="form-control" placeholder="Carpeta"
                                value="4">

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
