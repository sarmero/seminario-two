<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/icon/v1_28.png') }}" />
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Inter&display=swap') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('start/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('session/css/navigation.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('style')
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <div class="icon-x">
                <img src="{{ asset('image/icon/v1_90.png') }}">
                <div>Administrador</div>
            </div>

            <div class="cont">
                <ul>
                    <li><a href="{{ route('admin') }}">Inicio</a></li>
                    <li><a href="{{ route('admissions.index') }}">Admisiones</a></li>
                    <li><a href="{{ route('program.index') }}">Programas</a></li>
                    <li><a href="{{ route('subject.index') }}">Asignaturas</a></li>
                    <li><a href="{{ route('teacher.index') }}">Docentes</a></li>
                    <li><a href="{{ route('student.index') }}">Estudiante</a></li>



                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                           Ofertas
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('offer-program.index') }}">Programa</a>
                            <a class="dropdown-item" href="{{ route('offer-subject.index') }}">Asignaturas</a>

                        </div>

                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if (session('photo'))
                                <img src="{{ asset(session('photo')) }}" alt="user" width="30" height="30"
                                    class="d-inline-block align-text-center">
                            @else
                                <img src="{{ asset('image/profile/profile.png') }}" alt="user" width="30"
                                    height="30" class="d-inline-block align-text-center">
                            @endif

                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            {{-- <a class="dropdown-item" href="{{ route('home') }}">Principal</a>
                            <a>
                                <hr>
                            </a>
                            <a class="dropdown-item" href="#">Cerrar y crear calendario</a>
                            <a>
                                <hr>
                            </a> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a>
                        </div>

                    </li>
                </ul>
            </div>

        </div>
    </nav>


    @yield('content')

    @include('common.footer')

    {{-- Script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
</body>

</html>
