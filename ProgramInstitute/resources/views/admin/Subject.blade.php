@extends('layouts.app')

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
                <div class="tit">Asignaturas</div>
            </div>

            <form action="{{ route('admin.subject.program') }}" method="POST">
                @csrf
                <div class="semester">
                    <label for="program" class="form-label">Programa:</label>
                    <select class="form-select" name="program" id="program" required alt="gandalf">
                        <option value="">Choose...</option>
                        @foreach ($program as $sem)
                            <option value="{{ $sem->id }}">{{ $sem->name }}
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

            @isset($name)
                <div class="program my-4 text-center">
                    <h3>{{ $name->name }}</h3>
                </div>
            @endisset

            <div class="table-responsive">
                <table class="table table-striped table table-bordered align-middle">
                    <thead class="">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">Asignatura</th>
                            <th class="text-center" scope="col">semestre</th>
                            <th class="text-center" scope="col">Opcion</th>

                        </tr>
                    </thead>

                    <tbody>
                        @isset($subject)
                            @foreach ($subject as $i => $item)
                                <tr>
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td class="text-center">{{ $item->semester_id }}</td>

                                    <td class="text-center">
                                        <a href="#"
                                            onclick="atualizarElementosForm('{{ $item->id }}', '{{ $item->description }}', '{{ $name->name }}');"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" onclick="deleteElement('{{ $item->id }}');" title="Eliminar"><i
                                            class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="actualizarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Atualizar Asignatura</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form id="update" method="POST">
                                @csrf
                                @method('PUT')

                                <form class="needs-validation" novalidate>

                                    <div class="row">


                                        <div class="col-sm-12">
                                            <div class="name" id="nameProgram"></div>
                                        </div>


                                        <div class="col-sm-12">
                                            <label for="subject" class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" name="subject" id="subject"
                                                placeholder="" value="" required>
                                            <div class="invalid-feedback">
                                                Valid Name is required.
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <label for="program" class="form-label">Semestre:</label>
                                            <select class="form-select" name="semester" id="semester" required
                                                alt="gandalf">
                                                <option value="">Choose...</option>
                                                @foreach ($semester as $sem)
                                                    <option value="{{ $sem->id }}">{{ $sem->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid Genero
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
        function atualizarElementosForm(id, subject, program) {

            $('#nameProgram').html('');
            title = document.querySelector('#nameProgram');
            const cont = document.createElement('h3');
            cont.setAttribute('style', 'width:100%;');
            cont.textContent = program;
            title.appendChild(cont);

            document.querySelector('#subject').value = subject;


            form = document.querySelector('#update');
            form.setAttribute('action', '/admin/subject/update/' + id);

            $('#actualizarModal').modal('show');

        }

        function deleteElement(id) {
            if (confirm('¿Estás seguro de que quieres eliminar esta oferta?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/admin/subject/' + id,
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
