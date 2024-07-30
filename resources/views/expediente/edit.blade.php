@extends('layouts.admin')

@section('main-content')

    <div class="row">
        <div class="col justify-content-right">
            <a href="{{ route('expedientes.index') }}" class="btn btn-success">Regresar</a>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Datos Actualizados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>Número de Expediente</th>
                            <th>Nombre del Documento</th>
                            <th>Encargado</th>
                            <th>Fecha de Emisión</th>
                            <th>Hora de Emisión</th>
                            <th>Área Remitida</th>
                            <th>Archivo</th>
                            <th>Carpeta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $expediente->numero_expediente }}</td>
                            <td>{{ $expediente->nombre_documento }}</td>
                            <td>{{ $expediente->encargado }}</td>
                            <td>{{ $expediente->fecha_emision }}</td>
                            <td>{{ $expediente->hora_emision }}</td>
                            <td>{{ $expediente->area_remitida }}</td>
                            <td>
                                @if ($expediente->archivo)
                                    <a href="{{ asset($expediente->archivo) }}" target="_blank">Ver archivo</a>
                                @endif
                            </td>
                            <td>{{ $expediente->carpeta_id }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center" style=" margin-top: 3rem;">
        <div class="col-lg-8 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Editar Expediente</h6>
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

                    <form method="POST" action="{{ route('expedientes.update', $expediente->id) }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h6 class="heading-small text-muted mb-4">Información del Expediente</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="numero_expediente" class="form-label">Número de Expediente<span
                                                class="small text-danger">*</span></label>
                                        <input disabled type="text" id="numero_expediente" name="numero_expediente"
                                            class="form-control"
                                            value="{{ old('numero_expediente', $expediente->numero_expediente) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="nombre_documento" class="form-label">Nombre del Documento<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="nombre_documento" name="nombre_documento"
                                            class="form-control"
                                            value="{{ old('nombre_documento', $expediente->nombre_documento) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="encargado" class="form-label">Encargado<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="encargado" name="encargado" class="form-control"
                                            value="{{ old('encargado', $expediente->encargado) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="area_remitida" class="form-label">Área Remitida<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="area_remitida" name="area_remitida" class="form-control"
                                            value="{{ old('area_remitida', $expediente->area_remitida) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="fecha_emision" class="form-label">Fecha de Emisión<span
                                                class="small text-danger">*</span></label>
                                        <input type="date" id="fecha_emision" name="fecha_emision" class="form-control"
                                            value="{{ old('fecha_emision', $expediente->fecha_emision) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="hora_emision" class="form-label">Hora de Emisión<span
                                                class="small text-danger">*</span></label>
                                        <input type="time" id="hora_emision" name="hora_emision" class="form-control"
                                            value="{{ old('hora_emision', $expediente->hora_emision) }}">
                                    </div>
                                </div>
                            </div>


                            <input type="hidden" id="carpeta_id" name="carpeta_id" class="form-control"
                                value="{{ old('carpeta_id', $expediente->carpeta_id) }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="archivo" class="form-label">Archivo<span
                                                class="small text-danger">*</span></label>
                                        <input type="file" id="archivo" name="archivo" class="form-control">
                                        @if ($expediente->archivo)
                                            <p>Archivo actual: <a href="{{ asset($expediente->archivo) }}"
                                                    target="_blank">Ver archivo</a></p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>
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
