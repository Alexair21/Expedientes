@extends('layouts.admin')

@section('main-content')

    <body>
        <main>
            <br>
            <center>
                <p class="titulo"> BÚSQUEDA DE PROYECTO </p>
            </center>
            <!-- Búsqueda de proyecto -->
            <div class="container-fluid">
                <div class="row justify-content-center mt-5">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- Formulario de búsqueda por código único de proyecto -->
                                <form action="{{ route('buscarProyecto') }}" method="POST"
                                    onsubmit="buscarProyectoPorCodigo(event, this)">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="codigoUnico" class="form-label">Ingrese Código Único de
                                            Proyecto:</label>
                                        <input type="text" class="form-control" id="codigoUnico" name="codigo_unico">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Búsqueda de proyecto -->

            <!-- Área para mostrar los datos del proyecto -->
            <div class="container mt-4">
                <div id="proyectoTable" class="table-responsive" style="display: none;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Código Único</th>
                                <th>Estado</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Tipo de Formato</th>
                                <th>Situación</th>
                                <th>Costo</th>
                                <th>Costo Actualizado</th>
                                <th>Fase de ejecución</th>
                                <th>Registro de Cierre</th>
                                <th>Archivo</th>
                            </tr>
                        </thead>
                        <tbody id="proyectoTableBody">
                            <!-- Aquí se mostrará la información del proyecto -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Área para mostrar los datos del proyecto -->
        </main>

        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>

        <!-- SweetAlert2 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

        <!-- Meta tag para la base URL -->
        <meta name="base-url" content="{{ url('/') }}">

        <!-- Script para enviar la solicitud de búsqueda al servidor -->
        <script>
            function mostrarResultadoProyecto(datos) {
                var proyectoTable = document.getElementById('proyectoTable');
                proyectoTable.style.display = 'block'; // Mostrar el área de la tabla

                var proyectoTableBody = document.getElementById('proyectoTableBody');
                proyectoTableBody.innerHTML = ''; // Limpiar el contenido actual de la tabla

                if (datos.success) {
                    var proyecto = datos.proyecto;
                    var baseUrl = document.querySelector('meta[name="base-url"]').getAttribute('content');
                    var newRow = proyectoTableBody.insertRow();
                    newRow.innerHTML = `
                    <td>${proyecto.codigo_unico}</td>
                    <td>${proyecto.estado_proyecto}</td>
                    <td>${proyecto.nombre_proyecto}</td>
                    <td>${proyecto.descripcion}</td>
                    <td>${proyecto.tipo_formato}</td>
                    <td>${proyecto.situacion}</td>
                    <td>${new Intl.NumberFormat('es-PE', { style: 'currency', currency: 'PEN' }).format(proyecto.costo_proyecto)}</td>
                    <td>${new Intl.NumberFormat('es-PE', { style: 'currency', currency: 'PEN' }).format(proyecto.costo_actualizado)}</td>
                    <td>
                        <a href="{{ route('carpetauno.ver', 3) }}" class="fa fa-file-text" style="color: #aaeb29;"></a>
                    </td>
                    <td>${proyecto.registro_cierre}</td>
                    <td><a href="${proyecto.archivo}" target="_blank">Descargar Archivo</a></td>
                `;
                } else {
                    proyectoTableBody.innerHTML = `
                    <tr>
                        <td colspan="10">${datos.message}</td>
                    </tr>
                `;
                }
            }

            function buscarProyectoPorCodigo(event, form) {
                event.preventDefault(); // Evitar que el formulario se envíe automáticamente

                // Obtener la URL de la acción del formulario
                var url = form.action;

                // Obtener los datos del formulario
                var formData = new FormData(form);

                // Realizar la solicitud POST al servidor
                fetch(url, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => mostrarResultadoProyecto(data))
                    .catch(error => console.error('Error:', error));
            }
        </script>
    </body>

    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/inicio.css">
@stop

@section('js')
    <script></script>
@stop
