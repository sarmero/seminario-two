@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/teacher.css') }}">
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

            <form action="{{ route('admin.teacher.program') }}" method="POST">
                @csrf
                <div class="semester">
                    <label for="program" class="form-label">Programa:</label>
                    <select class="form-select" name="program" id="program" required alt="gandalf">
                        <option value="">Choose...</option>
                        @foreach ($program as $sem)
                            <option value="{{ $sem->id }}">{{ $sem->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <script>
                document.getElementById('program').addEventListener('change', function() {
                    this.form.submit();
                });
            </script>

            @isset($name)
                <div class="program my-4 text-center">
                    <h3>{{ $name->name }}</h3>
                </div>
            @endisset

            @isset($teacher)
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

                        <tbody>
                            @foreach ($teacher as $i => $item)
                                <tr>
                                    <td class="text-center">{{ $i + 1 }}</td>

                                    <td>{{ $item->first_name }}</td>

                                    <td> {{ $item->last_name }}</td>

                                    <td class="text-center">
                                        <div class="icon">
                                            <a href="{{ route('admin.teacher.person', $item->id) }}" title="visualizar"
                                                target="_blank"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.teacher.delete', $item->teacher) }}" title="Eliminar"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endisset
        </div>
    </div>
@endsection
