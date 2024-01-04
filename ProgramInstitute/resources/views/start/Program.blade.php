@extends('start.BaseStart')

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
                            <img src="{{ asset('storage/program/' . $pro->image) }}" alt="program"
                                class="d-inline-block align-text-center">

                            <div class="tex">
                                <div class="text">{{ $pro->name }}</div>
                            </div>
                        </div>

                        <div class="content">
                            <div class="subtheme">
                                <a class="plain theme" href="{{ route('content', $pro->id) }}">Contenido</a>
                                <a class="theme" href="{{ route('preinscription') }}">Preinscripcion</a>
                                <div class="theme">
                                    @if (count($pro->offer) > 0)
                                        Ofertado
                                    @else
                                        Pendiente
                                    @endif
                                </div>
                            </div>
                            <div class="description">
                                <p class="text-break">
                                    @if (strlen($pro->description) > 300)
                                        {{ substr($pro->description, 0, 300) . '...' }}
                                    @else
                                        {{ $pro->description }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
