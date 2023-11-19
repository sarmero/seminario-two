@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('session/css/offer.css') }}">
@endsection

@section('title')
    Ofertas
@endsection

@section('content')
    <div class="container">
        <div class="content">
            <div class="item-top">
                <div class="cont">
                    <div class="sub">Asignatura</div>

                    <div class="desc">
                        <div class="nt">Estado</div>
                        <div class="quo">Cupos</div>
                    </div>
                </div>
            </div>

            <hr>

            @foreach ($offer as $of)
                <div class="item">
                    <div class="cont">
                        <div class="subject">{{ $of->description }}</div>
                        <div class="desc">
                            <div class="state">
                                Ofertada
                            </div>
                            <div class="quota">
                                {{ $of->registered }}/{{ $of->quotas }}
                            </div>
                        </div>
                    </div>

                    <div class="action">
                        <button type="submit" class="btn btn-primary btn-sm">Inscribir</button>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
@endsection
