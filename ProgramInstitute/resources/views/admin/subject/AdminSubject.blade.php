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
                <div class="tit">Asignaturas</div>
            </div>

            <div class="create mb-3 d-flex justify-content-end">
                <a href="{{ route('subject.create') }}" class="btn btn-primary btn-sm" role="button">
                    Crear Asignatura
                </a>
            </div>

            <div class="semester">
                <label for="program" class="form-label">Programa:</label>
                <select class="form-select" name="program" id="program" required alt="gandalf">
                    <option value="">Elija...</option>
                    @foreach ($program as $sem)
                        <option value="{{ $sem->id }}">{{ $sem->name }}
                        </option>
                    @endforeach
                </select>
            </div>

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

                    <tbody id="tableBody">
                    </tbody>

                </table>
            </div>

            @include('admin.common.ConfirmationDelete')

        </div>
    </div>

    <script>
        function deleteElement(id) {

            $('#staticBackdropLabel').html('');
            title = document.querySelector('#staticBackdropLabel');
            title.textContent = 'Eliminar Asignatura';

            $('#message').html('');
            message = document.querySelector('#message');
            message.textContent = '¿Estas seguro que deseas Eliminar esta Asignatura?';

            form = document.querySelector('#delete');
            form.setAttribute('action', 'subject/' + id);

            $('#deleteModal').modal('show');
        }


        $(document).ready(function() {
            $('#program').change(function() {
                var program = $(this).val();

                $('#tableBody').html('<tbody id="tableBody"></tbody>');

                if (program !== '') {
                    $.ajax({
                        url: '/subject/' + program,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(response) {

                            if (response.subject.length > 0) {
                                $('#tableBody').html('<tbody id="tableBody"></tbody>');
                                ontain_data_table(response.subject);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });

            function ontain_data_table(response) {
                const tableBody = document.querySelector('#tableBody');

                $.each(response, function(index, subject) {

                    const rowData = document.createElement('tr');

                    const ind = document.createElement('td');
                    ind.classList.add('text-center');
                    ind.setAttribute('scope', 'row');

                    const name = document.createElement('td');
                    const sem = document.createElement('td');
                    sem.classList.add('text-center');

                    const opt = document.createElement('td');
                    opt.setAttribute('class', 'd-flex justify-content-center');
                    // opt.classList.add('d-flex justify-content-center');

                    ind.textContent = index + 1;
                    name.textContent = subject.description;
                    sem.textContent = subject.semester_id;
                    opt.innerHTML =
                        `
                    <a href="subject/${subject.id}/edit" title="Editar"><i class="fas fa-edit mx-1"></i></a>
                    <a href="#" onclick="deleteElement('${subject.id}');" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                    `;

                    rowData.appendChild(ind);
                    rowData.appendChild(name);
                    rowData.appendChild(sem);
                    rowData.appendChild(opt);

                    tableBody.appendChild(rowData);
                });
            }
        });
    </script>
@endsection
