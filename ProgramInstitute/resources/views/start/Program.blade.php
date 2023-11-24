@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('start/css/program.css') }}">
@endsection

@section('title')
    Programas
@endsection

@section('content')
    <div class="container">
        <div class="cont">
            <div class="title">
                <div div class="tit">Progrmas</div>
            </div>

            <div class="program">

                @foreach ($program as $pro)
                    <div class="item">

                        <div class="imag">

                            @if ($pro->image != null)
                                <img src="{{ asset($pro->image) }}" alt="program"
                                    class="d-inline-block align-text-center">
                            @else
                                <img src="{{ asset('image/covers/covers3.png') }}" alt="program"
                                    class="d-inline-block align-text-center">
                            @endif

                            <div class="tex">
                                <div class="text">{{ $pro->name }}</div>
                            </div>
                        </div>

                        <div class="content">
                            <div class="subtheme">
                                <a class="plain theme" href="{{ route('content', $pro->id) }}">Contenido</a>
                                <a class="theme" href="{{ route('preinscription') }}">Preinscripcion</a>
                                <div class="theme" >
                                    @if ($pro->state != 0)
                                        Ofertado
                                    @else
                                        Pendiente
                                    @endif
                                </div>
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
