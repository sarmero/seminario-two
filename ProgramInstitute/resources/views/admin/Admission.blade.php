@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/admission.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('title')
    Admision
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title">
                <div class="tit">Admision</div>
            </div>

            <form action="{{ route('admin.admission.program') }}" method="POST">
                @csrf
                <div class="semester">
                    <label for="program" class="form-label">Programa:</label>
                    <select class="form-select" name="program" id="program" required alt="gandalf">
                        <option value="">Choose...</option>
                        @foreach ($program as $pro)
                            <option value="{{ $pro->id }}">{{ $pro->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <script>
                document.getElementById('program').addEventListener('change', function() {
                    this.form.submit();
                });
            </script>

            <div class="program my-4 text-center">
                @isset($name)
                    <h3>{{ $name->name }}
                        <br> <span>Cupos: {{ $name->quotas }} | Solicitudes: {{ $requests }}</span>
                    </h3>
                @endisset
            </div>

            <div class="accordion accordion-flush" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Pendientes ( @isset($earrings)
                                {{ count($earrings) }}
                            @endisset )
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @isset($earrings)
                                <div class="table-responsive">
                                    <table class="table table-striped table table-bordered align-middle">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center" scope="col">#</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Apellido</th>
                                                <th class="text-center" scope="col">opcion</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($earrings as $i => $item)
                                                <tr>
                                                    <td class="text-center">{{ $i + 1 }}</td>

                                                    <td>{{ $item->first_name }}</td>

                                                    <td> {{ $item->last_name }}</td>

                                                    <td class="text-center">
                                                        <div class="icon">
                                                            <a href="{{ route('admin.admission.person', $item->id) }}"
                                                                title="descripcion" target="_blank"><i
                                                                    class="fas fa-eye"></i></a>
                                                            <a type="button"
                                                                href="{{ route('admin.admission.option', ['state' => 1, 'id' => $item->id, 'pro' => $item->pro]) }}"
                                                                title="Aprobar"><i class="fas fa-check-circle"></i></a>
                                                            <a href="{{ route('admin.admission.option', ['state' => 3, 'id' => $item->id, 'pro' => $item->pro]) }}"
                                                                title="Rechazar"><i class="fas fa-times-circle"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Aprobados ( @isset($approved)
                                {{ count($approved) }}
                            @endisset )
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @isset($approved)
                                <div class="table-responsive">
                                    <table class="table table-striped table table-bordered align-middle">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center" scope="col">#</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Apellido</th>
                                                <th class="text-center" scope="col">opcion</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($approved as $i => $item)
                                                <tr>
                                                    <td class="text-center">{{ $i + 1 }}</td>

                                                    <td>{{ $item->first_name }}</td>

                                                    <td> {{ $item->last_name }}</td>

                                                    <td class="text-center">
                                                        <div class="icon">
                                                            <a href="{{ route('admin.admission.person', $item->id) }}"
                                                                target="_blank" title="descripcion"><i
                                                                    class="fas fa-eye"></i></a>
                                                            <a href="{{ route('admin.admission.option', ['state' => 2, 'id' => $item->id, 'pro' => $item->pro]) }}"
                                                                title="pendiente"><i class="fas fa-minus-circle"></i></a>
                                                            <a href="{{ route('admin.admission.option', ['state' => 3, 'id' => $item->id, 'pro' => $item->pro]) }}"
                                                                title="Rechazar"><i class="fas fa-times-circle"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Rechazados ( @isset($rejected)
                                {{ count($rejected) }}
                            @endisset )
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @isset($rejected)
                                <div class="table-responsive">
                                    <table class="table table-striped table table-bordered align-middle">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center" scope="col">#</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Apellido</th>
                                                <th class="text-center" scope="col">opcion</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($rejected as $i => $item)
                                                <tr>
                                                    <td class="text-center">{{ $i + 1 }}</td>

                                                    <td>{{ $item->first_name }}</td>

                                                    <td> {{ $item->last_name }}</td>

                                                    <td class="text-center">
                                                        <div class="icon">
                                                            <a href="{{ route('admin.admission.person', $item->id) }}"
                                                                target="_blank" title="descripcion"><i
                                                                    class="fas fa-eye"></i></a>
                                                            <a type="button"
                                                                href="{{ route('admin.admission.option', ['state' => 1, 'id' => $item->id, 'pro' => $item->pro]) }}"
                                                                title="Aprobar"><i class="fas fa-check-circle"></i></a>
                                                            <a href="{{ route('admin.admission.option', ['state' => 2, 'id' => $item->id, 'pro' => $item->pro]) }}"
                                                                title="Pendiente"><i class="fas fa-minus-circle"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>

            <br><br>
            <div class="text-center">
                @isset($name)
                    <a href="#" onclick="closeOffer('{{ $name->offer }}');" class="btn btn-primary" role="button">
                        Cerrar oferta
                    </a>
                @endisset
            </div>
        </div>
    </div>

    <script>
        function closeOffer(id) {
            if (confirm('¿Estás seguro de que deseas cerrar esta oferta?')) {
                $.ajax({
                    type: 'GET',
                    url: '/admin/admission/close/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.href = '/admin/admission';
                    },
                    error: function(error) {
                        console.error('Error en la solicitud Ajax:', error);
                    }
                });
            }
        }
    </script>

@endsection
