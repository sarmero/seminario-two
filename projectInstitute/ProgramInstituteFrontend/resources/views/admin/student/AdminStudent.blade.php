@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/program.css') }}">
@endsection

@section('title')
    Estudiantes
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title">
                <div class="tit">Estudiantes</div>
            </div>

            <div class="row my-3">
                <div class="col-sm-3">
                    <label for="calendar" class="form-label">Calendario:</label>
                    <select class="form-select" name="calendar" id="calendar" alt="gandalf">
                        <option value="">Elejir...</option>
                        @foreach ($calendar as $item)
                            <option value="{{ $item->id }}">{{ $item->description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-9">
                    <label for="program" class="form-label">Programa:</label>
                    <select class="form-select" name="program" id="program" alt="gandalf">
                        <option value="">Elejir...</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table table-bordered align-middle">
                    <thead class="">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">code</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
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

    <script src="{{ asset('admin/js/student.js') }}"></script>
@endsection
