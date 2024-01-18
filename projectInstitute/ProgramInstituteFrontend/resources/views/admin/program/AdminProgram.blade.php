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
                <div class="tit">Programas</div>
            </div>

            <div class="create mb-3 d-flex justify-content-end">
                <a href="{{ route('program.create') }}" class="btn btn-primary btn-sm" role="button">
                    Crear Programa
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table table-bordered align-middle">
                    <thead class="">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">Programa</th>
                            <th class="text-center" scope="col">Asignaturas</th>
                            <th class="text-center" scope="col">Opcion</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($program as $i => $item)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">{{ $item->subject_count }}</td>

                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('content', $item->id) }}" title="contenido" target="_blank"><i
                                            class="fas fa-eye "></i>
                                    </a>
                                    <a href="{{ route('program.edit', $item->id) }}" title="Editar">
                                        <i class="fas fa-edit mx-2"></i>
                                    </a>

                                    <a href="#" onclick="deleteProgramModal('{{ $item->id }}');"
                                        title="Eliminar"><i class="fas fa-trash-alt"></i>
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

    <script>
        function deleteProgramModal(program) {

            $('#staticBackdropLabel').html('');
            title = document.querySelector('#staticBackdropLabel');
            title.textContent = 'Eliminar Programa';

            $('#message').html('');
            message = document.querySelector('#message');
            message.textContent = '¿Estas seguro que deseas Eliminar este programa?';


            form = document.querySelector('#delete');
            form.setAttribute('action', 'program/' + program);

            $('#deleteModal').modal('show');
        }
    </script>
@endsection
