@extends('layouts.app')

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

            <form action="{{ route('teacher.subject') }}" method="POST">
                @csrf
                <div class="semester">
                    <label for="subject" class="form-label">Asignatura:</label>
                    <select class="form-select" name="subject" id="subject" required alt="gandalf">
                        <option value="">Choose...</option>
                        @foreach ($subject as $item)
                            <option value="{{ $item->id }}">{{ $item->subject }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
            <br><br>
            @isset($activity)
                @if (count($activity) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table table-bordered align-middle">
                            <thead class="">
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th scope="col">Actividades</th>
                                    <th class="text-center" scope="col">Fecha</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($activity as $i => $item)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td class="text-center">{{ $item->deadline }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @else
                    <br><br>
                    <div class="text-center">
                        <span>
                            No hay Actividades Pendientes
                        </span>
                    </div>
                @endif
            @endisset

            <div class="modal fade" id="actualizarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Crear Actividad</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form id="activity" method="POST">
                                @csrf
                                {{-- @method('PUT') --}}

                                <form class="needs-validation" novalidate>

                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="name" id="nameSubject"></div>
                                        </div>

                                        <div class="col-sm-12">
                                            <label for="subject" class="form-label">Asignatura:</label>
                                            <select class="form-select" name="subject" id="subject" required
                                                alt="gandalf">
                                                <option value="">Choose...</option>
                                                @foreach ($subject as $item)
                                                    <option value="{{ $item->id }}">{{ $item->subject }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                            <label for="imag" class="form-label">Fecha de entrega:</label>
                                            <input type="date" class="form-control" name="deadline" id="deadline"
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

            <br><br>
            <div class="text-center">

                <a href="#" onclick="createActivity();" class="btn btn-primary" role="button">
                    Crear Actividad
                </a>

            </div>

        </div>

    </div>
    <script>
        document.getElementById('subject').addEventListener('change', function() {
            this.form.submit();
        });

        function createActivity() {
            form = document.querySelector('#activity');
            form.setAttribute('action', '/users/teacher/activity/create');

            $('#actualizarModal').modal('show');
        }
    </script>
@endsection
