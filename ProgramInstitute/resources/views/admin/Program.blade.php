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
                <div class="tit">Programas</div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table table-bordered align-middle">
                    <thead class="">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">Programa</th>
                            {{-- <th class="text-center" scope="col">Cupos</th> --}}
                            <th class="text-center" scope="col">Asignaturas</th>
                            <th class="text-center" scope="col">Opcion</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($program as $i => $item)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>

                                <td>{{ $item->name }}</td>

                                {{-- <td class="text-center">{{ $item->quotas }}</td> --}}

                                <td class="text-center">{{ $item->subject }}</td>

                                <td class="text-center">
                                    <a href="{{ route('content', $item->id) }}" title="contenido"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.program.update', $item->id) }}" title="Editar"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.program.delete', $item->id) }}" title="Eliminar"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



        </div>
    </div>
@endsection
