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
                                <td class="text-center">{{ $item->subject }}</td>

                                <td class="text-center">
                                    <a href="{{ route('content', $item->id) }}" title="contenido" target="_blank"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('program.edit', $item) }}"
                                        {{-- onclick="atualizarElementosForm('{{ $item->id }}', '{{ $item->name }}', '{{ $item->description }}');" --}}
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="deleteElement('{{ $item->id }}');" title="Eliminar"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="actualizarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Atualizar Oferta</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form id="update" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <form class="needs-validation" novalidate>

                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="name" id="nameSubject"></div>
                                        </div>

                                        <div class="col-sm-12">
                                            <label for="program" class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" name="program" id="program"
                                                placeholder="" value="" required>
                                            <div class="invalid-feedback">
                                                Valid Name is required.
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <label for="description" class="form-label">Description:</label>
                                            <textarea type="text" class="form-control" name="description" id="description" placeholder="" value=""
                                                required></textarea>
                                            <div class="invalid-feedback">
                                                Valid Name is required.
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <label for="imag" class="form-label">Imagen:</label>
                                            <input type="file" class="form-control" name="imag" id="imag"
                                                required>
                                            <div class="invalid-feedback">
                                                Valid last photo is required.
                                            </div>
                                        </div>

                                    </div>

                                    <hr class="my-4">

                                    <button class="w-50 btn btn-primary btn-sm offset-md-3" type="submit">Enviar</button>
                                    <br><br>

                                </form>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function atualizarElementosForm(id, program, description) {

            document.querySelector('#program').value = program;
            document.querySelector('#description').value = description;

            form = document.querySelector('#update');
            form.setAttribute('action', '/admin/program/update/' + id);

            $('#actualizarModal').modal('show');

        }

        function deleteElement(id) {
            if (confirm('¿Estás seguro de que quieres eliminar esta oferta?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/admin/program/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.error('Error en la solicitud Ajax:', error);
                    }
                });
            }
        }
    </script>
@endsection
