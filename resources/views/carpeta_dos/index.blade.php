@extends('layouts.admin')

@section('main-content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col text-left">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Listado de contenido de {{ $carpeta_uno->nombre }}
                    </div>
                    <h2 class="page-title">
                        Registro
                    </h2>
                </div>
                @can('acciones-proyecto')
                    <div class="col-12 col-md-auto ms-auto d-print-none">
                        @can('acciones-carpetas')
                            <div class="btn-list">
                                <a href="{{ route('carpetados.create', ['carpeta_uno' => $carpeta_uno->id]) }}"
                                    class="btn btn-warning">
                                    <i class="fas fa-plus"></i> Crear Subcarpeta
                                </a>
                                <a href="{{ route('carpetados.arch', ['carpeta_uno' => $carpeta_uno->id]) }}"
                                    class="btn btn-success">
                                    <i class="fas fa-plus"></i> Añadir Archivo
                                </a>
                            </div>
                        @endcan
                    </div>
                @endcan
            </div>
        </div>
    </div>

    <br><br>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <!-- Table for files -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Archivos</h3>
                            <!-- Search form -->
                            <form method="GET" action="{{ route('carpetados.index') }}" class="d-flex">
                                <input type="hidden" name="carpeta_uno" value="{{ $carpeta_uno->id }}">
                                <input type="text" name="search" class="form-control me-2"
                                    placeholder="Buscar por nombre o número de archivo" value="{{ request()->search }}">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre del Archivo</th>
                                            <th>N° Documento</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carpetaDos as $contenido)
                                            @if ($contenido->archivo)
                                                <tr>
                                                    <td>{{ $contenido->nombre_archivo }}</td>
                                                    <td>{{ $contenido->numero_archivo }}</td>
                                                    <td>{{ $contenido->fecha_registro }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            @php
                                                                $rutaArchivo = asset(
                                                                    str_replace('\\', '/', $contenido->archivo),
                                                                );
                                                            @endphp
                                                            <button type="button" class="btn btn-primary btn-sm btn-ver"
                                                                onclick="window.open('{{ $rutaArchivo }}', '_blank')">
                                                                <i class="fas fa-eye"></i> Ver
                                                            </button>
                                                            @can('acciones-carpetas')
                                                                <form
                                                                    action="{{ route('carpetados.destroy', $contenido->id) }}"
                                                                    method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('¿Estás seguro de eliminar este archivo?')">
                                                                        <i class="fas fa-trash"></i> Eliminar
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cards for folders -->
            <div class="row">
                @foreach ($carpetaDos as $contenido)
                    @if (!$contenido->archivo)
                        @php
                            $numero_registros = $contenido->carpetaTres()->count();
                        @endphp
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <a href="{{ route('carpetados.show', $contenido->id) }}" class="text-decoration-none">
                                <div class="card-folder p-3 h-100">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <i class="fas fa-folder fa-3x text-warning"></i>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm btn-ver2">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @can('acciones-carpetas')
                                                <form action="{{ route('carpetados.destroy', $contenido->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar esta subcarpeta?')">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <div>{{ $contenido->nombre }}</div>
                                        <div class="text-muted">{{ $numero_registros }} registros</div>
                                        <div class="text-muted">hace {{ $contenido->updated_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .card-folder {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #e0f7fa;
            /* Celeste bajo */
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
        }

        .card-folder:hover {
            transform: scale(1.05);
        }

        .card-folder i {
            margin-right: 10px;
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
        }

        .page-header .page-pretitle,
        .page-header .page-title {
            text-align: left;
            /* Cambiar a izquierda */
        }

        .page-header .btn-list {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .page-body {
            margin-top: 20px;
        }

        .page-body .container-xl {
            max-width: 1200px;
        }

        .btn-sm {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }

        .btn-ver2 {
            width: 50px;
            /* Ancho fijo para el botón Ver */
        }

        .btn-ver {
            width: 1px;
            /* Ancho fijo para el botón Ver */
        }

        .btn-list .btn {
            margin-right: 15px;
            /* Ajusta el valor según lo necesario */
        }

        .btn-primary,
        .btn-danger {
            margin: 0 5px;
        }

        .pagination {
            margin-top: 20px;
            justify-content: center;
        }

        .pagination .page-item .page-link {
            color: #5a5a5a;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        .card-folder a {
            color: inherit;
            text-decoration: none;
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
@endsection
