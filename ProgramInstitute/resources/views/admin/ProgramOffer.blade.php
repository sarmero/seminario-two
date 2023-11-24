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
                                            <div class="name" id="nameProgram"></div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="modality" class="form-label">Modalidad:</label>
                                            <select class="form-select" name="modality" id="modality" required
                                                alt="gandalf">
                                                <option value="">Choose...</option>
                                                @foreach ($modality as $item)
                                                    <option value="{{ $item->id }}">{{ $item->description }}
                                                    </option>
                                                @endforeach
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

            <div class="title">
                <div class="tit">Ofertas de Programas</div>
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

                                <td class="text-center">
                                    <a href="#"
                                        onclick="atualizarElementosForm('{{ $item->id }}', '{{ $item->name }}');"title="Editar"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" onclick="deleteElement('{{ $item->id }}');" title="Eliminar"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>

            <div class="title">
                <div class="tit">Agregar Ofertas</div>
            </div>

            <form action="{{ route('admin.program.offer.store') }}" method="POST">
                @csrf
                <form class="needs-validation" novalidate>

                    <div class="row g-3">

                        <div class="col-sm-12">
                            <label for="program" class="form-label">Programa:</label>
                            <select class="form-select" name="program" id="program" required alt="gandalf">
                                <option value="">Choose...</option>
                                @foreach ($program as $sem)
                                    <option value="{{ $sem->id }}">{{ $sem->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid Genero
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="modality" class="form-label">Modalidad:</label>
                            <select class="form-select" name="modality" id="modality" required alt="gandalf">
                                <option value="">Choose...</option>
                                @foreach ($modality as $item)
                                    <option value="{{ $item->id }}">{{ $item->description }}
                                    </option>
                                @endforeach
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



        </div>
    </div>

    <script src="{{ asset('admin/js/offerProgram.js') }}"></script>
@endsection
