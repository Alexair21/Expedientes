@extends('layouts.admin')

@section('main-content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Listado de expedientes
                    </div>
                    <h2 class="page-title">
                        Expedientes registrados
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <form action="{{ route('expedientes.index') }}" method="GET" class="d-flex me-3 mr-2">
                            <input type="text" name="search" class="form-control me-2"
                                placeholder="Buscar por Número de Expediente o Nombre del Documento"
                                value="{{ request()->input('search') }}">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>
                        @can('acciones-expediente')
                            <a href="{{ route('expedientes.create') }}" class="btn btn-warning">+ Crear Expediente</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Número de Expediente</th>
                                        <th>Nombre del documento</th>
                                        <th>Encargado</th>
                                        <th>Fecha Emision</th>
                                        <th>Hora de emision</th>
                                        <th>Area remitida</th>
                                        <th>Archivo</th>
                                        <th>Carpeta</th>
                                        @can('acciones-expediente')
                                            <th>Acciones</th>
                                        @endcan

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expedientes as $expediente)
                                        <tr>
                                            <td>{{ $expediente->id }}</td>
                                            <td>{{ $expediente->numero_expediente }}</td>
                                            <td>{{ $expediente->nombre_documento }}</td>
                                            <td>{{ $expediente->encargado }}</td>
                                            <td>{{ $expediente->fecha_emision }}</td>
                                            <td>{{ $expediente->hora_emision }}</td>
                                            <td>{{ $expediente->area_remitida }}</td>
                                            <td>
                                                @php
                                                    $rutaArchivo = str_replace('\\', '/', $expediente->archivo);
                                                @endphp
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    onclick="window.open('{{ $rutaArchivo }}', '_blank')">Ver</button>
                                            </td>
                                            <td>
                                                <!-- Botón para ver la carpeta asociada -->
                                                @if ($expediente->carpeta)
                                                    <a href="{{ route('carpetauno.ver', $expediente->carpeta->id) }}"
                                                        class="btn btn-sm">
                                                        <i class="fa fa-file-text"
                                                            style="color: #28a745; border-radius: 5px;"></i>
                                                    </a>
                                                @else
                                                    <p>No hay carpeta asociada.</p>
                                                @endif
                                            </td>
                                            @can('acciones-expediente')
                                                <td>
                                                    <a href="{{ route('expedientes.edit', $expediente->id) }}"
                                                        class="btn btn-sm btn-warning">Editar</a>
                                                    <form action="{{ route('expedientes.destroy', $expediente->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                                    </form>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $expedientes->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                position: 'center'
            });
        </script>
    @endif
@endsection
