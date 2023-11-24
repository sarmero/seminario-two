<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#page-top">
            <img src="{{ asset('image/nav/v1_122.png') }}" alt="Instituti Técnico" width="100">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Acerca de</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('program') }}">Programas</a></li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Admiciones
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admission') }}">Consultar</a>
                        <a class="dropdown-item" href="{{ route('preinscription') }}">Preinscripcion</a>
                    </div>
                </li>

                @if (Auth::check())
                    <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @if (session('photo'))
                            <img src="{{ asset(session('photo')) }}" alt="user" width="15" height="15"
                                class="d-inline-block align-text-center">
                        @else
                            <img src="{{ asset('image/profile/profile.png') }}" alt="user" width="30"
                                height="30" class="d-inline-block align-text-center">
                        @endif
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a>
                    </div>
                @else
                    <li class="nav-item ">
                        <a href="{{ route('login') }}" class="nav-link btn btn-primary btn " role="button"
                            style="padding:4px; background-color:green; width:100px; font-size:12px;">Ingresar</a>
                    </li>
                @endif



            </ul>
        </div>
    </div>
</nav>
