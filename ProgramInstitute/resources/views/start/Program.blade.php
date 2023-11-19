@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('start/css/program.css') }}">
@endsection

@section('title')
    Program
@endsection

@section('content')
    <div class="container">
        <div class="cont">
            <div class="title">
                <h3>Progrmas</h3>
            </div>

            <div class="program">

                @foreach ($program as $pro)
                    <div class="item">

                        <div class="imag">
                            <img src="{{ asset('image/covers/covers3.png') }}" alt="">
                            <div class="tex">
                                <div class="text">{{ $pro->name }}</div>
                            </div>
                        </div>

                        <div class="content">
                            <div class="subtheme">
                                <a class="plain theme" href="{{ route('content',$pro->id) }}">Contenido</a>
                                <a class="theme" href="{{ route('preinscription') }}">Preinscripcion</a>
                                <div class="theme" href="{{ route('home') }}">Modalidad</div>
                            </div>
                            <div class="description">
                                <p>{{ substr($pro->description, 0, 300) . '...' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
