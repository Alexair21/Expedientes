@extends('layouts.admin')

@section('main-content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Lista
                    </div>
                    <h2 class="page-title">
                        Regisro de contenido
                    </h2>
                </div>
                @can('acciones-proyecto')
                    <div class="col-12 col-md-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('carpetauno.create') }}" class="btn btn-warning">
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
                @foreach ($carpeta_uno as $carpeta)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <a href="" class="text-decoration-none text-dark">
                            <div class="card-folder text-center p-3">
                                <i class="fas fa-folder fa-5x text-warning"></i>
                                <div class="mt-2">{{ $carpeta->nombre }}</div>
                                <div class="btn-group mt-2" role="group">
                                    @can('acciones-proyecto')
                                        <a href="{{ route('carpetauno.edit', $carpeta->id) }}"
                                            class="btn btn-sm btn-warning mr-2" style="border-radius: 3px;">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('carpetauno.destroy', $carpeta->id) }}" method="POST"
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
                @endforeach
            </div>
        </div>
    </div>
@endsection
