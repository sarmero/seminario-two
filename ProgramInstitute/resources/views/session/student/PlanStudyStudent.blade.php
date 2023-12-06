@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('session/css/plan.css') }}">
@endsection

@section('title')
    Plan de Estudio
@endsection

@section('content')
    <div class="container">
        <div class="content">

            @foreach ($subject as $sem => $sub)
                <div class="item">
                    <div class="cont">

                        <div class="title">
                            <div>Semestre: {{ $sem }}</div>
                            <div>Asignaturas: {{ count($sub) }}</div>
                        </div>

                        <hr>

                        <div class="subject">
                            @foreach ($sub as $val)
                               {{ $val->description}} <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
