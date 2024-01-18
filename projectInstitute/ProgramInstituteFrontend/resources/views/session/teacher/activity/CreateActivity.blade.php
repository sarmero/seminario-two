@extends('session.BaseSession')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/form.css') }}">
@endsection

@section('title')
    Programas
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title">
                <div class="tit">Crear Actividad</div>
            </div>

            <div class="form">
                <div class="row">
                    <div class="col-lg-12 col-lg-offset-2">

                        <form action="{{ route('activity.store') }}" method="POST">
                            @csrf
                            @include('session.teacher.activity.FormActivity')

                            <button class="w-50 my-3 btn btn-primary btn-sm offset-md-3" type="submit">Guardar</button>
                            <br><br>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
