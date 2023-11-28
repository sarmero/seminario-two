@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/program.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

            <form id="calendarItems">
                @csrf
                <label for="calendar" class="form-label">Calendario:</label>
                <select class="form-select" name="calendar" id="calendar" required alt="gandalf">
                    <option value="">Choose...</option>
                    @foreach ($calendar as $item)
                        <option value="{{ $item->id }}">{{ $item->description }}
                        </option>
                    @endforeach
                </select>
            </form>

            <form id="programItems">
                @csrf
                <div class="semester">
                    <label for="program" class="form-label">Programa:</label>
                    <select class="form-select" name="program" id="program" required alt="gandalf">
                        <option value="">Choose...</option>
                    </select>
                </div>
            </form>


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

        </div>
    </div>

    <script src="{{ asset('admin/js/student.js') }}"></script>
@endsection
