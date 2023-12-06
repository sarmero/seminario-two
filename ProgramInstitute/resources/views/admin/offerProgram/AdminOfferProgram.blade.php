@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/program.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('title')
    Programas
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">

            <div class="title">
                <div class="tit">Ofertas de Programas</div>
            </div>

            <div class="create mb-3 d-flex justify-content-end">
                <a href="{{ route('offer-program.create') }}" class="btn btn-primary btn-sm" role="button">
                    Crear Oferta
                </a>
            </div>


            <div class="table-responsive">
                <table class="table table-striped table table-bordered align-middle">
                    <thead class="">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">codigo</th>
                            <th scope="col">programa</th>
                            <th class="text-center" scope="col">Modalidad</th>
                            <th class="text-center" scope="col">Cupos</th>
                            <th class="text-center" scope="col">opcion</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($offer as $i => $item)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">{{ $item->modality }}</td>
                                <td class="text-center">{{ $item->quotas }}</td>

                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('offer-program.edit', $item->id) }}" title="Editar">
                                        <i class="fas fa-edit mx-1"></i>
                                    </a>
                                    <a href="#" onclick="deleteElement('{{ $item->id }}');" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @include('admin.common.ConfirmationDelete')

        </div>
    </div>

    {{-- <script src="{{ asset('admin/js/offerProgram.js') }}"></script> --}}
    <script>
        function deleteElement(offer) {
            $('#staticBackdropLabel').html('');
            title = document.querySelector('#staticBackdropLabel');
            title.textContent = 'Eliminar oferta de Programa';

            $('#message').html('');
            message = document.querySelector('#message');
            message.textContent = '¿Estas seguro que deseas Eliminar este oferta?';

            form = document.querySelector('#delete');
            form.setAttribute('action', 'offer-program/' + offer);

            $('#deleteModal').modal('show');
        }

    </script>
@endsection
