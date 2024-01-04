@extends('session.BaseSession')

@section('style')
    <link rel="stylesheet" href="{{ asset('session/css/offer.css') }}">
@endsection

@section('title')
    Calificaciones
@endsection

@section('content')
    <div class="container">
        <div class="content">

            <form action="{{ route('teacher.ratings.subject') }}" method="POST">
                @csrf
                <div class="semester">
                    <label for="subject" class="form-label">Asignatura:</label>
                    <select class="form-select" name="subject" id="subject" required alt="gandalf">
                        <option value="">Choose...</option>
                        @foreach ($subject as $item)
                            <option value="{{ $item->id }}">{{ $item->subject->description }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <br><br>

            @isset($student)
                @if (count($student) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table table-bordered align-middle">
                            <thead class="">
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th scope="col">code</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Nota</th>
                                    <th class="text-center" scope="col">opcion</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($student as $i => $item)

                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td>{{ $item->inscription->student->code }}</td>
                                        <td>{{ $item->inscription->student->admission->person->first_name }}</td>
                                        <td>{{ $item->inscription->student->admission->person->last_name }}</td>
                                        <td>{{ $item->note }}</td>

                                        <td class="text-center">

                                            <a href="{{ route('student.person', $item->inscription->student->admission->person->id) }}" title="visualizar"
                                                target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="#"
                                                onclick="atualizarElementosForm('{{ $item->id }}', '{{ $item->inscription->student->admission->person->first_name . ' ' . $item->inscription->student->admission->person->last_name }}','{{ $item->note }}');"title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @else
                    <br><br>
                    <div class="text-center">
                        <span>
                            No hay estudiantes inscrito
                        </span>
                    </div>
                @endif
            @endisset

        </div>
    </div>

    <div class="modal fade" id="actualizarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Atualizar Calificacion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="update" method="POST">
                        @csrf
                        @method('PUT')

                        <form class="needs-validation" novalidate>

                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="name" id="nameStudent">

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <label for="note" class="form-label">Note:</label>
                                    <input type="text" class="form-control" name="note" id="notex" required>
                                    <div class="invalid-feedback">
                                        Valid last note is required.
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

    <div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Calificacion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="create" method="POST">
                        @csrf
                        @method('PUT')

                        <form class="needs-validation" novalidate>

                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="name" id="nameStudentx"></div>
                                </div>

                                <div class="col-sm-12">
                                    <label for="note" class="form-label">Nota:</label>
                                    <input type="text" class="form-control" name="note" id="note" >

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

    <script>
        document.getElementById('subject').addEventListener('change', function() {
            this.form.submit();
        });

        function atualizarElementosForm(id, name, note) {

            $('#nameStudent').html('<div class="name" id="nameStudent"><span>Alumno:</span><br></div>');
            title = document.querySelector('#nameStudent');
            const cont = document.createElement('h3');
            cont.setAttribute('style', 'width:100%;');
            cont.textContent = name;
            title.appendChild(cont);

            document.querySelector('#notex').value = note;

            form = document.querySelector('#update');
            form.setAttribute('action', '/users/teacher/ratings/update/' + id);

            $('#actualizarModal').modal('show');
        }

    </script>

@endsection
