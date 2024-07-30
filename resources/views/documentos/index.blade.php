@extends('layouts.admin')
@section('main-content')

    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Listado de documentos
                    </div>
                    <h2 class="page-title">
                        Documentos registrados
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list d-flex">
                        <a href="{{ route('carpetacuatro.index', ['carpeta_tres' => $carpeta_cuatro->carpeta_tres_id]) }}"
                            class="btn btn-primary me-2">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <form action="{{ route('documentos.index') }}" method="GET" class="d-flex">
                            <input type="hidden" name="carpeta_cuatro" value="{{ $carpeta_cuatro->id }}">
                            <input type="text" name="buscar" class="form-control"
                                placeholder="Buscar por nombre o número" value="{{ request()->get('buscar') }}">
                            <button type="submit" class="btn btn-primary ms-2">Buscar</button>
                        </form>
                        @can('acciones-carpetas')
                            <a href="{{ route('documentos.create', ['carpeta_cuatro' => $carpeta_cuatro->id]) }}"
                                class="btn btn-warning ms-2">+ Crear Documento</a>
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
                                    <th>Nro</th>
                                    <th>Nombre</th>
                                    <th>Numero del documento</th>
                                    <th>Fecha de registro</th>
                                    <th>Archivo</th>
                                    @can('acciones-carpetas')
                                        <th>Acciones</th>
                                    @endcan
                                </thead>
                                <tbody>
                                    @foreach ($documentos as $documento)
                                        <tr>
                                            <td>{{ $documento->id }}</td>
                                            <td>{{ $documento->nombre }}</td>
                                            <td>{{ $documento->numero_documento }}</td>
                                            <td>{{ $documento->fecha_registro }}</td>
                                            <td>
                                                @php
                                                    $rutaArchivo = str_replace('\\', '/', $documento->archivo);
                                                @endphp
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    onclick="window.open('{{ $rutaArchivo }}', '_blank')">Ver</button>
                                            </td>
                                            @can('acciones-carpetas')
                                                <td>
                                                    <a href="{{ route('documentos.edit', $documento->id) }}"
                                                        class="btn btn-warning btn-sm">Editar</a>

                                                    <form action="{{ route('documentos.destroy', $documento->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('¿Estás seguro de eliminar este documento?')">Eliminar</button>
                                                    </form>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .btn-list .btn {
            margin-right: 15px;
            /* Ajusta el valor según lo necesario */
        }
    </style>

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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
