@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/teacher.css') }}">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
@endsection

@section('title')
    Docentes
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title">
                <div class="tit">Docentes</div>
            </div>

            <div class="create mb-3 d-flex justify-content-end">
                <a href="{{ route('teacher.create') }}" class="btn btn-primary btn-sm" role="button">
                    Añadir Docente
                </a>
            </div>


            <div>
                <label for="program" class="form-label">Programa:</label>
                <select class="form-select" name="program" id="program" required alt="gandalf">
                    <option value="">Choose...</option>
                    @foreach ($program as $sem)
                        <option value="{{ $sem->id }}">{{ $sem->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="program-name my-4 text-center"></div>

            <div class="table-responsive">
                <table class="table table-striped table table-bordered align-middle">
                    <thead class="">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">Code</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th class="text-center" scope="col">opcion</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody"></tbody>

                </table>
            </div>

            @include('admin.common.ConfirmationDelete')

        </div>
    </div>
    <script>
        function deleteElement(id) {

            $('#staticBackdropLabel').html('');
            title = document.querySelector('#staticBackdropLabel');
            title.textContent = 'Eliminar Docente';

            $('#message').html('');
            message = document.querySelector('#message');
            message.textContent = '¿Estas seguro que deseas Eliminar este Docente?';

            form = document.querySelector('#delete');
            form.setAttribute('action', 'teacher/' + id);

            $('#deleteModal').modal('show');
        }

        function obtain_data_table(response) {
            const tableBody = document.querySelector('#tableBody');

            $.each(response, function(index, teacher) {

                const rowData = document.createElement('tr');

                const ind = document.createElement('td');
                ind.classList.add('text-center');
                ind.setAttribute('scope', 'row');

                const code = document.createElement('td');
                const name = document.createElement('td');
                const last = document.createElement('td');

                const opt = document.createElement('td');
                opt.classList.add('text-center');

                ind.textContent = index + 1;
                code.textContent = teacher.code;
                name.textContent = teacher.first_name;
                last.textContent = teacher.last_name;

                opt.innerHTML = `
                <div class="icon">
                    <a href="/admin/teacher/person/ ${teacher.idp}" title="visualizar" target="_blank"><i class="fas fa-eye"></i></a>
                    <a href="teacher/${teacher.id}/edit" title="Editar"><i class="fas fa-edit mx-1"></i></a>
                    <a href="#" onclick="deleteElement('${teacher.id}');" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                    </div>
                            `;

                rowData.appendChild(ind);
                rowData.appendChild(code);
                rowData.appendChild(name);
                rowData.appendChild(last);
                rowData.appendChild(opt);

                tableBody.appendChild(rowData);
            });
        }

        $(document).ready(function() {
            $('#program').change(function() {
                var program = $(this).val();

                if (program !== '') {
                    $.ajax({
                        url: '/teacher/' + program,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(response) {

                            $('.program-name').html('');
                            title = document.querySelector('.program-name');
                            cont = document.createElement('h3');
                            cont.textContent = response.name.name;
                            title.appendChild(cont);

                            if (response.teacher.length > 0) {
                                $('#tableBody').html('');
                                obtain_data_table(response.teacher);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>
@endsection
