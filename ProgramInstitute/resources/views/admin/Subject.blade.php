@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/program.css') }}">
@endsection

@section('title')
    Programas
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title">
                <div class="tit">Asignaturas</div>
            </div>

            <form action="{{ route('admin.subject.program') }}" method="POST">
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

                    <tbody>
                        @isset($subject)
                            @foreach ($subject as $i => $item)
                                <tr>
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td class="text-center">{{ $item->semester_id }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.program.update', $item->id) }}" title="Editar"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.program.delete', $item->id) }}" title="Eliminar"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>



        </div>
    </div>
@endsection
