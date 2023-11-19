@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('start/css/about.css') }}">
@endsection

@section('title')
    Acerca de
@endsection

@section('content')
    <div class="container ">
        <br><br><br>
        <div class="history">
            <h2>Historia</h2>
            <p>Fundado en 1985, el Instituto Técnico Visionarios del Mañana ha estado en la vanguardia de la
                educación
                durante décadas. Nuestra historia está marcada por una dedicación inquebrantable para brindar
                oportunidades educativas excepcionales a generaciones de estudiantes. Nos enorgullece haber
                contribuido
                al éxito de miles de jóvenes que han pasado por nuestras aulas.
                <br><br>
                Los fundadores del Instituto Renacer compartían una visión en común: crear un espacio educativo que
                no
                solo se centrara en el aprendizaje académico, sino que también promoviera el desarrollo integral de
                los
                estudiantes. Creían que la educación no solo debía transmitir conocimiento, sino también cultivar
                valores, habilidades sociales y un espíritu de servicio a la comunidad.
                <br><br>
                Los primeros años del instituto fueron desafiantes, pero los fundadores se mantuvieron comprometidos
                con
                su visión. A medida que crecía la reputación del instituto por su enfoque en la excelencia académica
                y
                el cuidado individualizado de los estudiantes, comenzaron a atraer a educadores talentosos y a
                familias
                que compartían su visión.
                <br><br>
                En las décadas siguientes, el Instituto Renacer experimentó un crecimiento constante. Se expandió
                para
                incluir cinco sedes únicas en entornos diversos, cada una especializada en una disciplina
                específica.
                Esta diversidad de especialidades permitió al instituto adaptarse a las necesidades cambiantes de la
                sociedad y ofrecer a los estudiantes oportunidades educativas excepcionales.
                <br><br>
                A lo largo de su historia, el instituto ha mantenido su compromiso con la innovación. Fue uno de los
                primeros en adoptar tecnologías educativas avanzadas y ha mantenido una inversión constante en la
                capacitación del personal y la mejora de las instalaciones. Esto ha permitido al instituto
                mantenerse a
                la vanguardia de la educación y preparar a sus estudiantes para enfrentar los desafíos de un mundo
                en
                constante cambio.
                <br><br>
                Hoy, el "Instituto Educativo Visionarios del Mañanar" es una institución respetada y admirada en el
                ámbito educativo. Su legado de excelencia académica, desarrollo personal y compromiso con los
                valores
                continúa guiando a generaciones de estudiantes hacia un futuro brillante. La historia del instituto
                es
                una historia de sueños forjados con dedicación, pasión y una creencia inquebrantable en el poder
                transformador de la educación.
            </p>
        </div>

        <div class="cont">
            <div class="row">
                <div class="col-sm-6">
                    <div class="section-1">

                        <div class="mision">
                            <h3>Mision</h3>
                            <p>En el Instituto Técnico Visionarios del Mañana, nuestra misión es simple pero
                                poderosa:
                                inspirar el aprendizaje, fomentar la creatividad y preparar a nuestros estudiantes
                                para
                                liderar en un mundo en constante cambio. Creemos que cada individuo tiene un
                                potencial
                                infinito, y estamos comprometidos a ayudarlos a alcanzarlo.
                                <br><br>
                                En el Instituto Técnico Visionarios del Mañana, nuestra misión es simple pero
                                poderosa:
                                inspirar el aprendizaje, fomentar la creatividad y preparar a nuestros estudiantes
                                para
                                liderar en un mundo en constante cambio. Creemos que cada individuo tiene un
                                potencial
                                infinito, y estamos comprometidos a ayudarlos a alcanzarlo.
                            </p>
                        </div>
                        <div class="vision">
                            <h3>Vision</h3>
                            <p>En el Instituto Técnico Visionarios del Mañana, tenemos la visión de ser un faro de
                                educación y excelencia académica que guíe a nuestros estudiantes hacia un futuro
                                brillante. Buscamos transformar vidas a través de la educación, inspirando a
                                nuestros
                                estudiantes a alcanzar su máximo potencial y convertirse en ciudadanos del mundo
                                comprometidos con la innovación, la ética y el servicio
                                <br><br>
                                Nuestra visión es ser reconocidos como un centro de referencia en la promoción de la
                                investigación científica, la tecnología y las artes. Queremos contribuir activamente
                                al
                                avance de la sociedad, al cuidado del medio ambiente y a la formación de líderes
                                capaces
                                de enfrentar los desafíos globales con confianza y determinación.
                                <br><br>
                                En el Instituto Renacer, creemos que la educación no solo se trata de preparar a los
                                estudiantes para la vida, sino de brindarles las herramientas y la inspiración para
                                que
                                sean arquitectos de un futuro mejor. Nuestra visión es ser un catalizador de sueños
                                y un
                                semillero de éxito, donde cada estudiante florece y deja una huella positiva en el
                                mundo."
                            </p>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="section-2">

                        <h3>Valores</h3>
                        <div class="valores">

                            <div class="subtheme">
                                <div class="title">

                                    <img src="{{ asset('image/item/item.png') }}" alt="">

                                    <div class="tex">
                                        <h5>Excelencia</h5>

                                        <p>
                                            En el Instituto Técnico Visionarios del Mañana, buscamos la excelencia
                                            en
                                            todo lo que hacemos. Nos esforzamos por alcanzar estándares de calidad
                                            excepcionales en la educación, el servicio y la conducta ética.
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="subtheme">
                                <div class="title">

                                    <img src="{{ asset('image/item/item.png') }}" alt="">

                                    <div class="tex">
                                        <h5>Integridad</h5>

                                        <p>
                                            Valoramos la integridad en todas nuestras interacciones. Fomentamos la
                                            honestidad, la transparencia y la responsabilidad en nuestros
                                            estudiantes,
                                            personal y comunidad.
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="subtheme">
                                <div class="title">

                                    <img src="{{ asset('image/item/item.png') }}" alt="">

                                    <div class="tex">
                                        <h5>Respeto</h5>

                                        <p>
                                            Promovemos el respeto mutuo y la inclusión. Celebramos la diversidad de
                                            opiniones, culturas y perspectivas, creando un ambiente de respeto y
                                            tolerancia.
                                        </p>

                                    </div>
                                </div>
                            </div>


                            <div class="subtheme">
                                <div class="title">

                                    <img src="{{ asset('image/item/item.png') }}" alt="">

                                    <div class="tex">
                                        <h5>Innovación</h5>

                                        <p>
                                            Abrazamos la innovación y la creatividad. Estamos comprometidos a estar
                                            a la
                                            vanguardia de la educación, adoptando nuevas tecnologías y métodos de
                                            enseñanza para preparar a nuestros estudiantes para un mundo en
                                            constante
                                            evolución.
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="subtheme">
                                <div class="title">

                                    <img src="{{ asset('image/item/item.png') }}" alt="">

                                    <div class="tex">
                                        <h5>Colaboración</h5>

                                        <p>
                                            Fomentamos la colaboración y el trabajo en equipo. Creemos que juntos
                                            podemos lograr más y ayudar a nuestros estudiantes a desarrollar
                                            habilidades
                                            sociales y de liderazgo.
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
