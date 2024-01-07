<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/icon/v1_28.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/material-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('start/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('session/css/navigation.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('style')
</head>

<body>
    <div class="bodyx">
        <nav class="navbar">
            <div class="container">
                <div class="icon-x">
                    <img src="{{ asset('image/icon/v1_121.png') }}">
                    <div>{{ session('page') }}</div>
                </div>

                @if (session('page') == 'Inicio')
                    <div class="title">
                        <div class="tit">Bienvenido</div>
                    </div>
                @endif

                <div class="cont">
                    <ul>

                        @if (session('page') != 'Inicio')
                            <li><a href="{{ route('session.home') }}">Inicio</a></li>

                            @if (session('role') == 1)
                                <li><a href="{{ route('ratings') }}">Calificaciones</a></li>
                                <li><a href="{{ route('session.offer') }}">Ofertas</a></li>
                                <li><a href="{{ route('plan') }}">Plan de estudio</a></li>
                            @else
                                <li><a href="{{ route('teacher.ratings') }}">Calificaciones</a></li>
                                <li><a href="{{ route('teacher.chairs') }}">Catedras</a></li>
                                <li><a href="{{ route('activity.index') }}">Actividades</a></li>
                            @endif

                        @endif

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if (session('image'))
                                    <img src="{{ asset('storage/profile/' . session('image')) }}" alt="user"
                                        width="30" height="30" class="d-inline-block align-text-center">
                                @else
                                    <img src="{{ asset('image/profile/profile.png') }}" alt="user" width="30"
                                        height="30" class="d-inline-block align-text-center">
                                @endif

                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">Principal</a>
                                <a>
                                    <hr>
                                </a>
                                @if (session('page') == 'Inicio')

                                    @if (session('role') == 1)
                                        <a class="dropdown-item" href="{{ route('ratings') }}">Calificaciones</a>
                                        <a class="dropdown-item" href="{{ route('session.offer') }}">Ofertas</a>
                                        <a class="dropdown-item" href="{{ route('plan') }}">Plan de estudio</a>
                                    @else
                                        <a class="dropdown-item"
                                            href="{{ route('teacher.ratings') }}">Calificaciones</a>
                                        <a class="dropdown-item" href="{{ route('teacher.chairs') }}">Catedras</a>
                                        <a class="dropdown-item" href="{{ route('activity.index') }}">Actividades</a>
                                    @endif

                                    <a>
                                        <hr>
                                    </a>

                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a>
                            </div>

                        </li>
                    </ul>
                </div>

            </div>
        </nav>


        @yield('content')

        @include('common.footer')

    </div>
    {{-- Script --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/simpleLightbox.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script> --}}

</body>

</html>
