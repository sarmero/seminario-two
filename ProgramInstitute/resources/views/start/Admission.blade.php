@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('start/css/admission.css') }}">
@endsection

@section('title')
    Admision
@endsection

@section('content')
    <div class="container">
        <div class="message">
            <form action="{{ route('search.users') }}" method="POST">
                @csrf
                <div class="form-label">
                    <label class='form-label' for='identification'>N° de identificacion</label>
                    <div class="id">
                        <input class='form-control form-control-sm' type='text' name='identification' id='identification'
                            aria-label="form-control-sm" required>
                        <button type="submit" class="btn btn-primary btn-sm">Consultar</button>
                    </div>
                </div>
            </form>

            <div class="text">
                @if (session('aceptado'))
                    <p>
                        Felicitaciones, <strong>Has Sido Admitido en el Programa {{ session('program') }}</strong>
                        <br><br>
                        Querido <strong>{{ session('name') }}</strong>,
                        <br><br>
                        Nos complace enormemente informarte que has sido admitido en el Programa
                        <strong>{{ session('program') }} </strong> en Instituto técnico visionarios del mañana.
                        ¡Felicitaciones
                        por este logro! <br><br>

                        Tu dedicación y tu interés en la seguridad alimentaria son muy evidentes, y estamos seguros de que
                        te convertirás en un valioso profesional en la industria alimentaria. Durante tu tiempo con
                        nosotros, aprenderás las mejores prácticas en higiene y manipulación de alimentos, así como los
                        conocimientos
                        necesarios para garantizar la calidad y la seguridad en la preparación de alimentos.
                        <br><br>
                        Estamos emocionados de tenerte como parte de nuestra comunidad educativa y esperamos verte en la
                        orientación
                        para nuevos estudiantes que se llevará a cabo el [fecha]. Aquí, podrás conocer a tus compañeros de
                        clase y obtener información detallada sobre el programa.
                        <br><br>
                        Si tienes alguna pregunta antes de tu llegada o necesitas asistencia en cualquier etapa del proceso
                        de admisión, no dudes en ponerte en contacto con nosotros. Estamos aquí para apoyarte en cada paso
                        del
                        camino.

                        Una vez más, felicitaciones por tu admisión al Programa Técnico en Manipulación de Alimentos.
                        Esperamos con ansias verte en el campus y ayudarte a alcanzar tus metas educativas y profesionales.
                        Saludos cordiales,
                        <br><br>
                        <br>

                        <strong>Instituto Técnico Visionarios del mañana</strong><br>
                        visinariosmañana@mail.com
                    </p>
                @elseIf (session('pendiente'))
                    <p>
                        Estimado <strong>{{ session('name') }}</strong>, <br><br>

                        Esperamos que estés bien. Queremos agradecerte por tu interés en formar parte de la comunidad
                        educativa del <strong>"Instituto Técnico Visionarios del mañana"</strong>. Tu solicitud de admisión
                        ha sido recibida y actualmente se encuentra en proceso de <strong>revisión</strong>. Queremos
                        asegurarte que estamos comprometidos en brindar a cada solicitud la atención y consideración que
                        merece.<br><br>

                        Entendemos que la espera puede generar incertidumbre, pero este período de revisión es esencial para
                        garantizar que podamos tomar decisiones informadas y justas. Nuestro equipo de admisiones está
                        trabajando diligentemente para evaluar todas las solicitudes y revisar todos los documentos
                        presentados.<br><br>

                        Apreciamos tu paciencia y te aseguramos que te informaremos de la decisión de admisión tan pronto
                        como concluyamos el proceso de revisión. Estamos comprometidos en garantizar que cada estudiante
                        admitido en el <strong>"Instituto Técnico Visionarios del mañana"</strong> tenga el potencial y la
                        determinación necesarios para tener éxito en nuestra comunidad educativa.<br><br>

                        Si tienes alguna pregunta o necesitas más información sobre el estado de tu solicitud, no dudes en
                        ponerte en contacto con nosotros. Estamos aquí para brindarte el apoyo que necesitas en este
                        proceso.<br><br>

                        Agradecemos tu interés en el <strong>"Instituto Técnico Visionarios del mañana"</strong> y esperamos
                        poder darte una respuesta pronto. Mientras tanto, te animamos a continuar con tu enfoque en el
                        aprendizaje y en la preparación para el futuro.<br><br>

                        Atentamente, <br><br>

                        Mario Aristizabal Valdez<br>
                        <strong>Cordinador<strong> <br><br>
                    </p>
                @elseIf (session('rechazado'))
                    <p>
                        Querido <strong>{{ session('name') }}</strong>, <br><br>

                        Esperamos que este mensaje te encuentres bien. En nombre del <strong>"Instituto Técnico Visionarios
                            del mañana"</strong>, queremos agradecerle por su interés en nuestra institución y por haber
                        presentado su solicitud de admisión.<br><br>

                        Valoramos el tiempo y la consideración que dedicas a este proceso. <br><br>

                        Lamentablemente, después de una revisión minuciosa, hemos tomado la difícil decisión de no admitirte
                        en esta ocasión. Queremos que sepas que esta decisión no se toma a la ligera y se basa en una serie
                        de factores, incluyendo el número limitado de plazas disponibles y los criterios de selección
                        establecidos. <br><br>

                        Entendemos que esta noticia puede ser decepcionante, pero queremos alentarte a no desanimarte. La
                        educación es un viaje continuo, y esta decisión no define tu potencial ni tu valía. Hay muchas otras
                        instituciones educativas excelentes y oportunidades disponibles que pueden ser un ajuste perfecto
                        para ti.

                        Agradecemos nuevamente tu interés en el <strong>"Instituto Técnico Visionarios del mañana"</strong>
                        y te deseamos mucho éxito en tu búsqueda educativa. Si tienes alguna <br><br>

                        Te deseamos lo mejor en tus futuros esfuerzos y logros. Continúa persiguiendo tus sueños y
                        trabajando duro para alcanzar tus metas. <br><br>

                        Atentamente, <br><br>

                        Mario Aristizabal Valdez<br>
                        <strong>Cordinador<strong> <br><br>
                    </p>
                @elseif (session('noExiste'))
                    <p class="text-center">El usuario no se encuentra registrado</p>
                @else
                    <p class="text-center">Por favor Ingrese su numero de documento</p>
                @endif
            </div>
        </div>
    </div>
@endsection
