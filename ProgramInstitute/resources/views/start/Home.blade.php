@extends('start.BaseStart')

@section('style')
    <link rel="stylesheet" href="{{ asset('start/css/home.css') }}">
@endsection

@section('title')
    Home
@endsection


@section('content')
    <div id="page-top">
        <div class="start">
            <br><br><br>
            <div class="main">
                <div class="name">
                    <span class="title">Instituto Técnico Visionarios del Mañana</span>
                    <span class="motto">Iluminando mentes, forjando el futuro</span>
                    <button type="button" class="btn btn-success">Preinscribirme</button>
                </div>

                <div class="image">
                    <div class="slider">
                        <ul>
                            <li>
                                <img src="{{ asset('image/carrusel/image.jpg') }}">
                            </li>
                            <li>
                                <img src="{{ asset('image/carrusel/image2.jpg') }}">
                            </li>
                            <li>
                                <img src="{{ asset('image/carrusel/image3.png') }}">
                            </li>
                            <li>
                                <img src="{{ asset('image/carrusel/image4.jpg') }}">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <br><br><br>

        <div class="container ">
            <div class="body-top">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="logo">
                            <img src="{{ asset('image/icon/v1_121.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="text-welcom">
                            <p>Bienvenidos al <strong>Instituto Técnico Visionarios del Mañana</strong>, un lugar donde la
                                educación se convierte en una experiencia única y transformadora. Nuestra institución está
                                comprometida con la excelencia académica y el desarrollo integral de cada uno de nuestros
                                estudiantes. Aquí, no solo fomentamos el aprendizaje, sino que también cultivamos valores,
                                habilidades y una mentalidad abierta que les permitirá enfrentar los desafíos del mundo
                                moderno.</p>
                        </div>
                    </div>

                </div>

            </div>

            <br>
            <hr><br>
        </div>

        <div class="info">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="body-left">
                            <h5>Nuestro Compromiso</h5>

                            <div class="text">
                                <p>
                                    En el Instituto Técnico Visionarios del Mañana, creemos que la educación no solo es
                                    una preparación para la vida, sino que es la vida misma. Estamos dedicados a crear un
                                    ambiente donde los estudiantes puedan florecer, explorar sus pasiones y contribuir
                                    positivamente a la sociedad.

                                </p>
                            </div>

                            <div class="left-img">
                                <img src="{{ asset('image/v1_97.png') }}" alt="">
                            </div>

                            <div class="text">
                                <p>
                                    Únete a nosotros en este emocionante viaje educativo y descubre cómo en el Instituto
                                    visionarios, estamos forjando sueños y construyendo un futuro brillante para
                                    nuestros estudiantes.
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="body-right">
                            <h5>Nuestro Enfoque</h5>
                            <div class="cont">
                                <div class="subtheme">
                                    <div class="title">

                                        <img src="{{ asset('image/item/item.png') }}" alt="">

                                        <div class="tex">
                                            <h5>Desarrollo Personal</h5>

                                            <p>
                                                Fomentamos el crecimiento personal y el desarrollo de habilidades
                                                deliderazgo, comunicación y trabajo en equipo que son esenciales en el mundo
                                                actual.
                                            </p>

                                        </div>
                                    </div>
                                </div>

                                <div class="subtheme">
                                    <div class="title">

                                        <img src="{{ asset('image/item/item2.png') }}" alt="">

                                        <div class="tex">
                                            <h5>Valores</h5>

                                            <p>
                                                En el instituto, los valores como la integridad, la empatía y la
                                                responsabilidad son fundamentales. Inculcamos en nuestros estudiantes un
                                                fuerte sentido de ética y respeto hacia los demás.
                                            </p>

                                        </div>
                                    </div>
                                </div>

                                <div class="subtheme">
                                    <div class="title">

                                        <img src="{{ asset('image/item/item3.png') }}" alt="">

                                        <div class="tex">
                                            <h5>Excelencia Académica</h5>

                                            <p>
                                                Nuestro equipo de educadores altamente calificados trabaja incansablemente
                                                para proporcionar una educación de calidad que desafía a nuestros
                                                estudiantes a alcanzar sus metas académicas.
                                            </p>

                                        </div>
                                    </div>
                                </div>

                                <div class="subtheme">
                                    <div class="title">

                                        <img src="{{ asset('image/item/item4.png') }}" alt="">

                                        <div class="tex">
                                            <h5>Innovación</h5>

                                            <p>
                                                Estamos comprometidos con la innovación en la enseñanza y la tecnología
                                                educativa para asegurarnos de que nuestros estudiantes estén preparados para
                                                un futuro digital y globalizado.
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="body-bottom">
                <p class="text-center">
                    Bienvenido a un mundo de oportunidades, bienvenido al<br>
                    <strong>Instituto Técnico Visionarios del Mañana.</strong>
                </p>
            </div>

        </div>
    </div>
@endsection
