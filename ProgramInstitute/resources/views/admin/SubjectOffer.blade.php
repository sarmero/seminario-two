@extends('layouts.app')

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

            <form id="programItems">
                @csrf
                <div class="semester">
                    <label for="program" class="form-label">Programa:</label>
                    <select class="form-select" name="program" id="program" required>
                        <option value="">Choose...</option>
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
                            <th class="text-center" scope="col">Docente</th>
                            <th class="text-center" scope="col">Cupos</th>
                            <th class="text-center" scope="col">opcion</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">
                    </tbody>
                </table>
            </div>

            <br><br><br>

            <div class="title">
                <div class="tit">Agregar Asignaturas</div>
            </div>

            <form action="{{ route('admin.subject.offer.store') }}" method="POST">
                @csrf
                <form class="needs-validation" novalidate>

                    <div class="row g-3">

                        <div class="col-sm-12">

                            <label for="subject" class="form-label">Asignaturas:</label>
                            <select class="form-select" name="subject" id="subject" required alt="gandalf">
                                <option value="">Choose...</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid Genero
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <label for="teacher" class="form-label">Docentes:</label>
                            <select class="form-select" name="teacher" id="teacher" required>
                                <option value="">Choose...</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid Genero
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="quotas" class="form-label">Cupos:</label>
                            <input type="text" class="form-control" name="quotas" id="quotas" placeholder=""
                                value="" required>
                            <div class="invalid-feedback">
                                Valid quotas is required.
                            </div>
                        </div>

                    </div>

                    <hr class="my-4">

                    <button class="w-50 btn btn-primary btn-sm offset-md-3" type="submit">Enviar</button>
                    <br><br>

                </form>
            </form>



            <div class="modal fade" id="actualizarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Atualizar Oferta</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form id="update" method="POST">
                                @csrf
                                @method('PUT')

                                <form class="needs-validation" novalidate>

                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="name" id="nameSubject"></div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="teacher" class="form-label">Docentes:</label>
                                            <select class="form-select" name="teacher" id="teacherx" required>
                                                <option value="">Choose...</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid Genero
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="quotas" class="form-label">Cupos:</label>
                                            <input type="text" class="form-control" name="quotas" id="quotas"
                                                placeholder="" value="" required>
                                            <div class="invalid-feedback">
                                                Valid quotas is required.
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

    <script src="{{ asset('admin/js/offerSubject.js') }}"></script>
@endsection
