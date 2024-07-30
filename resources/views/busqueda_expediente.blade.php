@extends('layouts.admin')

@section('main-content')

<body>
    <main>
        <br>
        <center>
            <p class="titulo"> BÚSQUEDA DE EXPEDIENTE </p>
        </center>
        <!-- Búsqueda de expediente -->
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <center><p class="titulo">Elija opción</p></center>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="w-100">
                                    <!-- Formulario de búsqueda por número de expediente -->
                                    <form action="{{ route('buscarExpediente') }}" method="POST" onsubmit="buscarExpediente(event, this)">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="numero_expediente" class="form-label">Ingrese Número de Expediente:</label>
                                            <input type="text" class="form-control" id="numero_expediente" name="numero_expediente" onclick="toggleInput(this, 'nombre_documento')">
                                        </div>
                                        <div class="text-center my-3">
                                            <strong>o</strong>
                                        </div>
                                        <!-- Formulario de búsqueda por nombre del documento -->
                                        <div class="mb-3">
                                            <label for="nombre_documento" class="form-label">Ingrese Nombre del Documento:</label>
                                            <input type="text" class="form-control" id="nombre_documento" name="nombre_documento" onclick="toggleInput(this, 'numero_expediente')">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Buscar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Búsqueda de expediente -->

        <!-- Área para mostrar los datos del expediente -->
        <div class="container mt-4">
            <div id="expedienteTable" class="table-responsive" style="display: none;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Número de Expediente</th>
                            <th>Nombre del Documento</th>
                            <th>Encargado</th>
                            <th>Fecha de Emisión</th>
                            <th>Hora de Emisión</th>
                            <th>Área Remitida</th>
                            <th>Archivo</th>
                        </tr>
                    </thead>
                    <tbody id="expedienteTableBody">
                        <!-- Aquí se mostrará la información del expediente -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Área para mostrar los datos del expediente -->
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
        function toggleInput(clickedInput, otherInputId) {
            var otherInput = document.getElementById(otherInputId);
            if (clickedInput.value === '') {
                otherInput.disabled = !otherInput.disabled;
            }
        }

        function mostrarResultadoExpediente(datos) {
            var expedienteTable = document.getElementById('expedienteTable');
            expedienteTable.style.display = 'block'; // Mostrar el área de la tabla

            var expedienteTableBody = document.getElementById('expedienteTableBody');
            expedienteTableBody.innerHTML = ''; // Limpiar el contenido actual de la tabla

            if (datos.success) {
                var expediente = datos.expediente;
                var baseUrl = document.querySelector('meta[name="base-url"]').getAttribute('content');
                var newRow = expedienteTableBody.insertRow();
                newRow.innerHTML = `
                    <td>${expediente.numero_expediente}</td>
                    <td>${expediente.nombre_documento}</td>
                    <td>${expediente.encargado}</td>
                    <td>${expediente.fecha_emision}</td>
                    <td>${expediente.hora_emision}</td>
                    <td>${expediente.area_remitida}</td>
                    <td><a href="${expediente.archivo}" target="_blank">Descargar Archivo</a></td>
                `;
            } else {
                expedienteTableBody.innerHTML = `
                    <tr>
                        <td colspan="7">${datos.message}</td>
                    </tr>
                `;
            }
        }

        function buscarExpediente(event, form) {
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
                .then(data => mostrarResultadoExpediente(data))
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
