@extends('layouts.admin')

@section('main-content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Listado de contenido de la carpeta {{ $carpeta->nombre }}
                    </div>
                    <h2 class="page-title">
                        Registro
                    </h2>
                </div>
                @can('acciones-carpetas')
                    <div class="col-12 col-md-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('proyectos.show', $proyecto->id) }}" class="btn btn-primary">Volver
                            </a>
                            <a href="{{ route('subcarpetas.create', ['carpeta_id' => $carpeta_id]) }}" class="btn btn-warning">
                                <i class="fas fa-plus"></i> Crear Subcarpeta
                            </a>
                            <a href="{{ route('subcarpetas.arch', ['carpeta_id' => $carpeta_id]) }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Añadir Archivo
                            </a>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>

    <br><br>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                @foreach ($subcarpetas as $carpeta)
                    @if (is_null($carpeta->nombre_archivo))
                        @if ($carpeta->carpeta_id == $carpeta_id)
                            <div class="col-md-3 col-sm-6 mb-4">
                                <a href="{{ route('subcarpetas.show', $carpeta->id) }}"
                                    class="text-decoration-none text-dark">
                                    <div class="card-folder text-center p-3">
                                        <i class="fas fa-folder fa-5x text-warning"></i>
                                        <div class="mt-2">{{ $carpeta->nombre }}</div>
                                        @can('acciones-carpetas')
                                            <div class="btn-group mt-2" role="group">
                                                <form action="{{ route('subcarpetas.destroy', $carpeta->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar esta subcarpeta?')">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endif
                @endforeach

                @foreach ($archivos as $archivo)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card-folder text-center p-3">
                            <i class="fas fa-file-alt fa-5x text-primary"></i>
                            <div class="mt-2">{{ $archivo->nombre_archivo }}</div>
                            <div class="btn-group mt-2" role="group">
                                @php
                                    $rutaArchivo = asset('storage/' . str_replace('\\', '/', $archivo->archivo));
                                @endphp
                                <button type="button" class="btn btn-primary btn-sm"
                                    onclick="window.open('{{ $rutaArchivo }}', '_blank')">Ver</button>
                                @can('acciones-carpetas')
                                    <form action="{{ route('subcarpetas.destroy', $archivo->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar este archivo?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
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
