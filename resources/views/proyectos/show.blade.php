@extends('layouts.admin')

@section('main-content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Listado de carpetas
                    </div>
                    <h2 class="page-title">
                        Carpetas registradas
                    </h2>
                </div>
                <a href="{{ route('proyectos.index') }}" class="btn btn-primary">Volver</a>
                @can('acciones-proyecto')
                    <div class="col-12 col-md-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('carpetas.create', ['proyecto_id' => $proyecto_id]) }}" class="btn btn-warning">
                                <i class="fas fa-plus"></i> Crear Carpeta
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
                @foreach ($carpetas as $carpeta)
                    @if ($carpeta->proyecto_id == $proyecto_id)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <a href="{{ route('carpetas.show', $carpeta->id) }}" class="text-decoration-none text-dark">
                                <div class="card-folder text-center p-3">
                                    <i class="fas fa-folder fa-5x text-warning"></i>
                                    <div class="mt-2">{{ $carpeta->nombre }}</div>
                                    <div class="btn-group mt-2" role="group">
                                        @can('acciones-proyecto')
                                            <a href="{{ route('carpetas.edit', $carpeta->id) }}"
                                                class="btn btn-sm btn-warning mr-2" style="border-radius: 3px;">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('carpetas.destroy', $carpeta->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
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
