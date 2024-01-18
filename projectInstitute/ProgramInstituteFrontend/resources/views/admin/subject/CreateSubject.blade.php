@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/form.css') }}">
@endsection

@section('title')
    Asignatura
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title">
                <div class="tit">Crear Asignatura</div>
            </div>

            <div class="form">
                <div class="row">
                    <div class="col-lg-12 col-lg-offset-2">

                        <form action="{{ route('subject.store') }}" method="POST">
                            @csrf

                            @include('admin.subject.FormSubject')

                            <button class="w-50 my-3 btn btn-primary btn-sm offset-md-3" type="submit">Enviar</button>
                            <br><br>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
