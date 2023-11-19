<nav class="navbar">
    <div class="container">
        <div class="icon-x">
            <img src="{{ asset('image/icon/v1_90.png') }}">
            <div>Administrador</div>
        </div>


        <div class="cont">
            <ul>
                <li><a href="{{ route('session.home') }}">Inicio</a></li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Programas
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.program') }}">Lista</a>
                        <a class="dropdown-item" href="{{ route('admin.program') }}">Oferta</a>
                        <a class="dropdown-item" href="{{ route('admin.program.register') }}">Registrar</a>
                    </div>

                </li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Asignaturas
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.subject') }}">lista</a>
                        <a class="dropdown-item" href="{{ route('admin.subject') }}">Oferta</a>
                        <a class="dropdown-item" href="{{ route('admin.subject.register') }}">Registrar</a>
                    </div>

                </li>

                <li><a href="{{ route('admin.admission') }}">Admisiones</a></li>
                {{-- <li><a href="{{ route('session.offer') }}">Ofertas</a></li> --}}
                <li><a href="{{ route('admin.student') }}">Estudiantes</a></li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Docente
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.teacher') }}">lista</a>
                        <a class="dropdown-item" href="{{ route('admin.teacher.register') }}">Registrar</a>
                    </div>

                </li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @if (session('photo'))
                            <img src="{{ asset('image/profile/profile.png') }}" alt="user"
                                width="30" height="30" class="d-inline-block align-text-center">
                        @else
                            <img src="{{ asset('image/profile/profile.png') }}" alt="user" width="30"
                                height="30" class="d-inline-block align-text-center">
                        @endif

                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a>
                    </div>

                </li>
            </ul>
        </div>

    </div>
</nav>
