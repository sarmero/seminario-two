@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/programRegister.css') }}">
@endsection

@section('title')
    Programas
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title">
                <div class="tit">Editar Programa</div>
            </div>

            <div class="form">
                <div class="row">
                    <div class="col-lg-12 col-lg-offset-2">

                        <form action="{{ route('program.update',$program) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.program.FormatProgram')

                            <button class="w-50 btn btn-primary btn-sm offset-md-3" type="submit">Guardar</button>
                            <br><br>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
