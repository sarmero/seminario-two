@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/program.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('title')
    Asignaturas
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title">
                <div class="tit">Ofertas de Asignaturas</div>
            </div>

            <div class="create mb-3 d-flex justify-content-end">
                <a href="{{ route('offer-subject.create') }}" class="btn btn-primary btn-sm" role="button">
                    Crear Oferta
                </a>
            </div>

            <form id="programItems">
                @csrf
                <div class="semester">
                    <label for="program" class="form-label">Programa:</label>
                    <select class="form-select" name="program" id="program">
                        <option value="">Elejir...</option>
                        @foreach ($program as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="program my-4 text-center">
                <h3 id="nameProgram"></h3>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table table-bordered align-middle">
                    <thead class="">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">Asignatura</th>
                            <th class="text-center" scope="col">semestre</th>
                            <th class="text-center" scope="col">Cupos</th>
                            <th class="text-center" scope="col">Docente</th>
                            <th class="text-center" scope="col">opcion</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">
                    </tbody>
                </table>
            </div>

            @include('admin.common.ConfirmationDelete')

        </div>

    </div>

    <script src="{{ asset('admin/js/offerSubject.js') }}"></script>
    {{-- <script>
        function deleteElement(id) {

            $('#staticBackdropLabel').html('');
            title = document.querySelector('#staticBackdropLabel');
            title.textContent = 'Eliminar Oferta';

            $('#message').html('');
            message = document.querySelector('#message');
            message.textContent = '¿Estas seguro que deseas Eliminar esta Oferta?';

            form = document.querySelector('#delete');
            form.setAttribute('action', 'offert-subject/' + id);

            $('#deleteModal').modal('show');
        }
    </script> --}}
@endsection
