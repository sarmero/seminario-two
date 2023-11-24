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
                        <li><a href="{{ route('teacher.activity') }}">Actividades</a></li>
                    @endif

                @endif

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
                                <a class="dropdown-item" href="{{ route('teacher.ratings') }}">Calificaciones</a>
                                <a class="dropdown-item" href="{{ route('teacher.chairs') }}">Catedras</a>
                                <a class="dropdown-item" href="{{ route('teacher.activity') }}">Actividades</a>
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
