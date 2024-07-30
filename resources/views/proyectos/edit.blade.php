@extends('layouts.admin')

@section('main-content')

    <div class="row">
        <div class="col justify-content-right">
            <a href="{{ route('proyectos.index') }}" class="btn btn-success">Regresar</a>
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
                            <th>Código Único</th>
                            <th>Responsable del Proyecto</th>
                            <th>Estado del Proyecto</th>
                            <th>Nombre del Proyecto</th>
                            <th>Descripción</th>
                            <th>Tipo de Formato</th>
                            <th>Situación</th>
                            <th>Costo del Proyecto</th>
                            <th>Costo Actualizado</th>
                            <th>Registro de Cierre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $proyecto->codigo_unico }}</td>
                            <td>{{ $proyecto->responsable_proyecto }}</td>
                            <td>{{ $proyecto->estado_proyecto }}</td>
                            <td>{{ $proyecto->nombre_proyecto }}</td>
                            <td>{{ $proyecto->descripcion }}</td>
                            <td>{{ $proyecto->tipo_formato }}</td>
                            <td>{{ $proyecto->situacion }}</td>
                            <td>S/.{{ $proyecto->costo_proyecto }}</td>
                            <td>S/.{{ $proyecto->costo_actualizado }}</td>
                            <td>{{ $proyecto->registro_cierre }}</td>
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
                    <h6 class="m-0 font-weight-bold text-primary">Editar proyecto</h6>
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

                    <form method="POST" action="{{ route('proyectos.update', $proyecto->id) }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h6 class="heading-small text-muted mb-4">Información del proyecto</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="codigo_unico" class="form-label">Código Único de proyecto<span
                                                class="small text-danger">*</span></label>
                                        <input disabled type="text" id="codigo_unico" name="codigo_unico"
                                            class="form-control" placeholder="Código Único de proyecto"
                                            value="{{ old('codigo_unico', $proyecto->codigo_unico) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="estado_proyecto" class="form-label">Estado del proyecto<span
                                                class="small text-danger">*</span></label>
                                        <select id="estado_proyecto" name="estado_proyecto" class="form-control">
                                            <option value="" disabled>Seleccione el estado</option>
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado }}"
                                                    {{ $proyecto->estado_proyecto == $estado ? 'selected' : '' }}>
                                                    {{ $estado }}</option>
                                            @endforeach
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
                                            value="{{ old('responsable_proyecto', $proyecto->responsable_proyecto) }}">
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
                                            value="{{ old('nombre_proyecto', $proyecto->nombre_proyecto) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="registro_cierre" class="form-label">Registro de cierre<span
                                                class="small text-danger">*</span></label>
                                        <input type="date" id="registro_cierre" name="registro_cierre"
                                            class="form-control"
                                            value="{{ old('registro_cierre', $proyecto->registro_cierre) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="descripcion" class="form-label">Descripción<span
                                        class="small text-danger">*</span></label>
                                <input type="text" id="descripcion" name="descripcion" class="form-control"
                                    placeholder="Descripción" value="{{ old('descripcion', $proyecto->descripcion) }}">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="tipo_formato" class="form-label">Tipo de formato<span
                                                class="small text-danger">*</span></label>
                                        <select id="tipo_formato" name="tipo_formato" class="form-control">
                                            <option value="" disabled>Seleccione el tipo de formato</option>
                                            @foreach ($tiposFormato as $tipo)
                                                <option value="{{ $tipo }}"
                                                    {{ $proyecto->tipo_formato == $tipo ? 'selected' : '' }}>
                                                    {{ $tipo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="situacion" class="form-label">Situación<span
                                                class="small text-danger">*</span></label>
                                        <select id="situacion" name="situacion" class="form-control">
                                            <option value="" disabled>Seleccione la situación</option>
                                            @foreach ($situaciones as $situacion)
                                                <option value="{{ $situacion }}"
                                                    {{ $proyecto->situacion == $situacion ? 'selected' : '' }}>
                                                    {{ $situacion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label for="costo_proyecto" class="form-label">Costo de inversión<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="costo_proyecto" name="costo_proyecto"
                                            class="form-control" placeholder="Costo de inversión"
                                            value="{{ old('costo_proyecto', $proyecto->costo_proyecto) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label for="costo_actualizado" class="form-label">Costo actualizado<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="costo_actualizado" name="costo_actualizado"
                                            class="form-control" placeholder="Costo actualizado"
                                            value="{{ old('costo_actualizado', $proyecto->costo_actualizado) }}">
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
                                    <button type="submit" class="btn btn-primary"
                                        onclick="return confirm('Actualizado correctamente')">Actualizar</button>
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
