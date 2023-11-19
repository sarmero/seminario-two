@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('start/css/content.css') }}">
@endsection

@section('title')
    Contenido
@endsection

@section('content')
    <div class="container">
        <div class="cont">
            <div class="covers">
                <img src="{{ asset('image/covers/covers1.png') }}" alt="">
                <div class="tex">
                    <div class="text">
                        {{ $program->name }}
                    </div>
                </div>
                <div class="icon"></div>
            </div>
        </div>

        <div class="cont2">
            <div class="description">
                <p>{{ $program->description }}</p>
            </div>


            <div class="mod">
                <div class="mod1">
                    <img src="{{ asset('image/item/item2.png') }}" alt="">
                    <h5>Duracion: <span> {{ count($duration) }} semestre</span></h5>
                </div>
                <div class="mod1">
                    <img src="{{ asset('image/item/item2.png') }}" alt="">
                    <h5>Modalidad: <span>{{ $program->modality }}</span> </h5>
                </div>
                <div class="mod1">
                    <img src="{{ asset('image/item/item2.png') }}" alt="">
                    <h5>Cupos: <span>{{ $program->quotas }}</span></h5>
                </div>
                <div class="mod1">
                    <img src="{{ asset('image/item/item2.png') }}" alt="">
                    <h5>Asignaturas: <span>{{ count($subject) }}</span></h5>
                </div>
            </div>

            <div class="subject">
                <div class="title">
                    <h4>Asignaturas</h4>
                </div>

                <div class="sub">
                    @foreach ($subject as $sub)
                        <div class="item">
                            <img src="{{ asset('image/item/item2.png') }}" alt="">
                            <h5>{{ $sub->description }}</h5>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="description">
               <p class="text-center">
                Estas asignaturas proporcionan una base sólida para que los estudiantes desarrollen sus habilidadescomprendan la importancia cultural y estética del arte y la cultura, y exploren su creatividad
                en diversas disciplinas artísticas.
               </p>
            </div>
        </div>
    </div>
@endsection
