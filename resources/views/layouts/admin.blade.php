<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">


    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Expedientes</div>
            </a>
            @can('ver-busquedas')
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item {{ Nav::isRoute('inicio') }}">
                    <a class="nav-link" href="{{ route('inicio') }}">
                        <i class="fa fa-search"></i>
                        <span>{{ __('Busqueda de proyecto') }}</span>
                    </a>
                </li>
                <!-- Nav Item - Dashboard -->
                <li class="nav-item {{ Nav::isRoute('b_expediente') }}">
                    <a class="nav-link" href="{{ route('b_expediente') }}">
                        <i class="fa fa-search"></i>
                        <span>{{ __('Busqueda de expedientes') }}</span>
                    </a>
                </li>
            @endcan
            @can('acciones-internas')
                <!-- Divider -->
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    {{ __('Acciones Internas') }}
                </div>

                <li class="nav-item {{ Nav::isRoute('carpetauno.ver', 1) }}">
                    <a class="nav-link" href="{{ route('carpetauno.ver', 1) }}">
                        <i class="fa fa-book"></i>
                        <span>{{ __('Archivos internos') }}</span>
                    </a>
                </li>
            @endcan
            @can('acciones-externos')
                <div class="sidebar-heading">
                    {{ __('Acciones Externas') }}
                </div>

                <li class="nav-item {{ Nav::isRoute('carpetauno.ver', 2) }}">
                    <a class="nav-link" href="{{ route('carpetauno.ver', 2) }}">
                        <i class="fa fa-book"></i>
                        <span>{{ __('Archivos Externos') }}</span>
                    </a>
                </li>
            @endcan
            @can('acciones-expediente')
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <li class="nav-item {{ Nav::isRoute('expedientes.index') }}">
                    <a class="nav-link" href="{{ route('expedientes.index') }}">
                        <i class="fa fa-book"></i>
                        <span>{{ __('Expedientes') }}</span>
                    </a>
                </li>
            @endcan

            @can('acciones-proyecto')
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
                <div class="sidebar-heading">
                    {{ __('Acciones proyectos') }}
                </div>

                <li class="nav-item {{ Nav::isRoute('proyectos.index') }}">
                    <a class="nav-link" href="{{ route('proyectos.index') }}">
                        <i class="fa fa-clone"></i>
                        <span>{{ __('Proyectos') }}</span>
                    </a>
                </li>
            @endcan

            @can('acciones-admin')
                <!-- Divider -->
                <hr class="sidebar-divider my-0"> <br>
                <div class="sidebar-heading">
                    {{ __('Acciones Admin') }}
                </div>
                <!-- Nav Item - Profile -->
                <li class="nav-item {{ Nav::isRoute('usuarios.index') }}">
                    <a class="nav-link" href="{{ route('usuarios.index') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('Usuarios') }}</span>
                    </a>
                </li>

                <!-- Nav Item - Profile -->
                <li class="nav-item {{ Nav::isRoute('roles.index') }}">
                    <a class="nav-link" href="{{ route('roles.index') }}">
                        <i class="fa fa-check"></i>
                        <span>{{ __('Roles') }}</span>
                    </a>
                </li>
            @endcan


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <figure class="img-profile rounded-circle avatar font-weight-bold"
                                    data-initial="{{ Auth::user()->name[0] }}"></figure>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('main-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ __('
                                                                                                                                                                                                                                                                            ¿Listo para salir?') }}
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancelar') }}</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Cerrar sesión') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>
