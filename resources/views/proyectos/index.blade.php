@extends('layouts.admin')

@section('main-content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Listado de proyectos
                    </div>
                    <h2 class="page-title">
                        Proyectos registrados
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <form action="{{ route('proyectos.index') }}" method="GET" class="d-flex me-3 mr-2">
                            <input type="text" name="search" class="form-control me-2"
                                placeholder="Buscar por Código Único" value="{{ request()->input('search') }}">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>
                        <a href="{{ route('proyectos.create') }}" class="btn btn-warning">+ Crear proyecto</a>
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
                                        <th>Código Único</th>
                                        <th>Responsable del proyecto</th>
                                        <th>Estado de inversión</th>
                                        <th>Nombre de proyecto</th>
                                        <th>Tipo de formato</th>
                                        <th>Situación</th>
                                        <th>Costo de proyecto</th>
                                        <th>Costo actualizado</th>
                                        <th>Fase de Ejecución</th>
                                        <th>Registro de cierre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proyectos as $proyecto)
                                        <tr>
                                            <td>{{ $proyecto->id }}</td>
                                            <td>{{ $proyecto->codigo_unico }}</td>
                                            <td>{{ $proyecto->responsable_proyecto }}</td>
                                            <td>{{ $proyecto->estado_proyecto }}</td>
                                            <td>{{ $proyecto->nombre_proyecto }}</td>
                                            <td>{{ $proyecto->tipo_formato }}</td>
                                            <td>{{ $proyecto->situacion }}</td>
                                            <td>S/. {{ number_format($proyecto->costo_proyecto, 2) }}</td>
                                            <td>S/.{{ number_format($proyecto->costo_actualizado, 2) }}</td>
                                            <td>
                                                <a href="" class="btn btn-sm">
                                                    <i class="fa fa-cogs" style="color: #1bd8d8; border-radius: 5px;"></i>
                                                </a>
                                                <!-- Botón para ver la carpeta asociada -->
                                                @if ($proyecto->carpeta)
                                                    <a href="{{ route('carpetauno.ver', $proyecto->carpeta->id) }}"
                                                        class="btn btn-sm">
                                                        <i class="fa fa-file-text"
                                                            style="color: #28a745; border-radius: 5px;"></i>
                                                    </a>
                                                @else
                                                    <p>No hay carpeta asociada.</p>
                                                @endif
                                            </td>
                                            <td>{{ $proyecto->registro_cierre }}</td>
                                            <td>
                                                <!-- Botón para editar y eliminar -->
                                                <a href="{{ route('proyectos.edit', $proyecto->id) }}"
                                                    class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('proyectos.destroy', $proyecto->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('¿Estás seguro de eliminar este proyecto?')">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex mr-4 justify-content-between align-items-end">
                        <div>
                            <p class="m-4">Existe un total de {{ $proyectos->total() }} registros</p>
                        </div>
                        <div class="pagination">
                            {{ $proyectos->links() }}
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
