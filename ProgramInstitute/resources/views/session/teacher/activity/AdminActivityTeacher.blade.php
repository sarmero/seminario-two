@extends('session.BaseSession')

@section('style')
    <link rel="stylesheet" href="{{ asset('session/css/offer.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('title')
    Actividades
@endsection

@section('content')
    <div class="container">
        <div class="content">

            <div class="create mb-3 d-flex justify-content-end">
                <a href="{{ route('activity.create') }}" class="btn btn-primary btn-sm" role="button">
                    Añadir Actividad
                </a>
            </div>

            <div class="my-3">
                <label for="subject" class="form-label">Asignatura:</label>
                <select class="form-select" name="subject" id="subject" required alt="gandalf">
                    <option value="">Elejir...</option>
                    @foreach ($subject as $item)
                        <option value="{{ $item->id }}">{{ $item->subject }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table table-bordered align-middle">
                    <thead class="">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">Actividades</th>
                            <th class="text-center" scope="col">Fecha</th>
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
    <script>
        function deleteElement(activity) {

            $('#staticBackdropLabel').html('');
            title = document.querySelector('#staticBackdropLabel');
            title.textContent = 'Eliminar Actividad';

            $('#message').html('');
            message = document.querySelector('#message');
            message.textContent = '¿Estas seguro que deseas Eliminar esta Actividad?';


            form = document.querySelector('#delete');
            form.setAttribute('action', 'activity/' + activity);

            $('#deleteModal').modal('show');
        }

        $(document).ready(function() {
            $('#subject').change(function() {
                var id = $(this).val();

                $('#tableBody').html('<tbody id="tableBody"></tbody>');

                if (id !== '') {
                    $.ajax({
                        url: '/activity/' + id,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(response) {

                            if (response.activity.length > 0) {
                                $('#tableBody').html('<tbody id="tableBody"></tbody>');
                                ontain_data_table(response.activity);
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

                $.each(response, function(index, activity) {

                    const rowData = document.createElement('tr');

                    const ind = document.createElement('td');
                    ind.classList.add('text-center');
                    ind.setAttribute('scope', 'row');

                    const act = document.createElement('td');
                    const dea = document.createElement('td');
                    dea.classList.add('text-center');

                    const opt = document.createElement('td');
                    opt.setAttribute('class', 'd-flex justify-content-center');

                    console.log('date: ', activity.deadline);
                    año = activity.deadline.slice(0, 4);
                    mes = activity.deadline.slice(5, 7);
                    dia = activity.deadline.slice(8, 10);
                    date = año + '-' + mes + '-' + dia;

                    ind.textContent = index + 1;
                    act.textContent = activity.description;
                    dea.textContent =date;
                    opt.innerHTML = `
                        <a href="activity/${activity.id}/edit" title="Editar"><i class="fas fa-edit mx-1"></i></a>
                        <a href="#" onclick="deleteElement('${activity.id}');" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                    `;

                    rowData.appendChild(ind);
                    rowData.appendChild(act);
                    rowData.appendChild(dea);
                    rowData.appendChild(opt);

                    tableBody.appendChild(rowData);
                });
            }
        });
    </script>
@endsection
