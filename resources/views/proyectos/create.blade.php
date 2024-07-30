@extends('layouts.admin')

@section('main-content')

<br><br><br>
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-lg-8 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Crear proyecto</h6>
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

                    <form method="POST" action="{{ route('proyectos.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <h6 class="heading-small text-muted mb-4">Información del Proyecto</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="codigo_unico" class="form-label">Código Único de proyecto<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="codigo_unico" name="codigo_unico" class="form-control"
                                            placeholder="Código Único de proyecto" value="{{ old('codigo_unico') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="estado_proyecto" class="form-label">Estado del proyecto<span
                                                class="small text-danger">*</span></label>
                                        <select id="estado_proyecto" name="estado_proyecto" class="form-control">
                                            <option value="" selected>Seleccione el estado</option>
                                            <option value="ACTIVADO">Activado</option>
                                            <option value="DESACTIVADO">Desactivado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="responsable_proyecto" class="form-label">Responsable del proyecto<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="responsable_proyecto" name="responsable_proyecto"
                                            class="form-control" placeholder="Responsable del proyecto"
                                            value="{{ old('responsable_proyecto') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nombre_proyecto" class="form-label">Nombre del proyecto<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="nombre_proyecto" name="nombre_proyecto"
                                            class="form-control" placeholder="Nombre del proyecto"
                                            value="{{ old('nombre_proyecto') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="registro_cierre" class="form-label">Registro de cierre<span
                                                class="small text-danger">*</span></label>
                                        <input type="date" id="registro_cierre" name="registro_cierre"
                                            class="form-control" value="{{ old('registro_cierre') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="descripcion" class="form-label">Descripción<span
                                        class="small text-danger">*</span></label>
                                <input type="text" id="descripcion" name="descripcion" class="form-control"
                                    placeholder="Descripción" value="{{ old('descripcion') }}">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="tipo_formato" class="form-label">Tipo de formato<span
                                                class="small text-danger">*</span></label>
                                        <select id="tipo_formato" name="tipo_formato" class="form-control">
                                            <option value="" selected>Seleccione el tipo de formato</option>
                                            <option value="PROYECTO">Proyecto</option>
                                            <option value="IOARR">IOARR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="situacion" class="form-label">Situación<span
                                                class="small text-danger">*</span></label>
                                        <select id="situacion" name="situacion" class="form-control">
                                            <option value="" selected>Seleccione la situación</option>
                                            <option value="VIABLE">Viable</option>
                                            <option value="EN FORMULACION">En Formulación</option>
                                            <option value="APROBADO">Aprobado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label for="costo_proyecto" class="form-label">Costo de inversión<span
                                                class="small text-danger">*</span></label>
                                        <input type="number" id="costo_proyecto" name="costo_proyecto"
                                            class="form-control" placeholder="Costo de inversión"
                                            value="{{ old('costo_proyecto') }} " step="0.02">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label for="costo_actualizado" class="form-label">Costo actualizado<span
                                                class="small text-danger">*</span></label>
                                        <input type="number" id="costo_actualizado" name="costo_actualizado"
                                            class="form-control" placeholder="Costo actualizado"
                                            value="{{ old('costo_actualizado') }}" step="0.02">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="archivo" class="form-label">Archivo<span
                                                class="small text-danger">*</span></label>
                                        <input type="file" id="archivo" name="archivo" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('¿Desea crear el proyecto?')">Crear proyecto</button>
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
