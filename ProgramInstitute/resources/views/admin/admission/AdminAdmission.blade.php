@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/admission.css') }}">
@endsection

@section('title')
    Admision
@endsection

@section('content')
    @isset($name)
    @endisset

    <div class="container">
        <div class="cont-p">
            <div class="title">
                <div class="tit">Admision</div>
            </div>

            <div>
                <label for="program" class="form-label">Programa:</label>
                <select class="form-select" name="program" id="program" required alt="gandalf">
                    <option value="">Choose...</option>
                    @foreach ($program as $pro)
                        <option value="{{ $pro->id }}">{{ $pro->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="program-name my-4 text-center">

            </div>

            <div class="accordion accordion-flush" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div id="one">Aprobados</div>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

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

                                    <tbody id="tableBodyApproved">
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <div id="two">Pendiente</div>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

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

                                    <tbody id="tableBodyEarrings">
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree ">
                            <div id="three">Rechazados</div>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

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

                                    <tbody id="tableBodyRejected">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>
            <div class="text-center button-close"></div>
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
                        window.location.href = '/admissions';
                    },
                    error: function(error) {
                        console.error('Error en la solicitud Ajax:', error);
                    }
                });
            }
        }

        function updateState(state, id, pro) {

            $.ajax({
                url: '/admissions/' + id,
                type: 'PUT',
                data: {
                    state: state,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response.message);
                    window.location.href = '/admissions';
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });

        }

        function obtain_data_table(response, tableBody, state1, state2) {
            // const tableBody = document.querySelector('#tableBody');

            let icon1;
            let icon2

            if (state1 == 2 && state2 == 3) {
                icon1 = 'fa-minus-circle';
                icon2 = 'fa-times-circle';
            } else if (state1 == 1 && state2 == 3) {
                icon1 = 'fa-check-circle';
                icon2 = 'fa-times-circle';
            } else if (state1 == 1 && state2 == 2) {
                icon1 = 'fa-check-circle';
                icon2 = 'fa-minus-circle';
            }

            $.each(response, function(index, state) {

                const rowData = document.createElement('tr');

                const ind = document.createElement('td');
                ind.classList.add('text-center');
                ind.setAttribute('scope', 'row');

                const name = document.createElement('td');
                const last = document.createElement('td');

                const opt = document.createElement('td');
                opt.classList.add('text-center');

                ind.textContent = index + 1;
                name.textContent = state.first_name;
                last.textContent = state.last_name;

                opt.innerHTML = `
                <div class="icon">
                    <a href="/admin/admission/person/${state.id}" target="_blank" title="descripcion"><i class="fas fa-eye"></i></a>
                    <a href="#" onclick="updateState('${state1}', '${state.id}', '${state.pro}');" title="Aprobar"><i class="fas ${icon1}"></i></a>
                    <a href="#"onclick="updateState('${state2}','${state.id}','${state.pro}');"title="Pendiente"><i class="fas ${icon2}"></i></a>
                    </div>
                            `;

                rowData.appendChild(ind);
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
                        url: '/admissions/' + program,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(response) {


                            $('.program-name').html('');
                            title = document.querySelector('.program-name');
                            cont = document.createElement('h3');
                            cont.innerHTML =
                                `${response.name.name}<br><span>Cupos: ${response.name.quotas}  | Solicitudes: ${response.requests} </span>`;
                            title.appendChild(cont);

                            $('.button-close').html('');
                            btn = document.querySelector('.button-close');
                            cont = document.createElement('div');
                            cont.innerHTML =
                                `<a href="#" onclick="closeOffer('${response.name.offer}');" class="btn btn-primary" role="button">Cerrar oferta</a>`;
                            btn.appendChild(cont);



                            if (response.approved.length > 0) {
                                $('#tableBodyApproved').html('');
                                tableBody = document.querySelector('#tableBodyApproved');
                                obtain_data_table(response.approved, tableBody, 2, 3);

                                $('#one').html('');
                                head = document.querySelector('#one')
                                const div = document.createElement('div');
                                div.textContent = 'Aprobado(' + response.approved.length +
                                    ')';
                                head.appendChild(div);
                            }

                            if (response.earrings.length > 0) {
                                $('#tableBodyEarrings').html('');
                                tableBody = document.querySelector('#tableBodyEarrings');
                                obtain_data_table(response.earrings, tableBody, 1, 3);

                                $('#two').html('');
                                head = document.querySelector('#two')
                                const div = document.createElement('div');
                                div.textContent = 'Pendientes(' + response.earrings.length +
                                    ')';
                                head.appendChild(div);
                            }

                            if (response.rejected.length > 0) {
                                $('#tableBodyRejected').html('');
                                tableBody = document.querySelector('#tableBodyRejected');
                                obtain_data_table(response.rejected, tableBody, 1, 2);

                                $('#three').html('');
                                head = document.querySelector('#three')
                                const div = document.createElement('div');
                                div.textContent = 'Rechazados(' + response.rejected.length +
                                    ')';
                                head.appendChild(div);
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
