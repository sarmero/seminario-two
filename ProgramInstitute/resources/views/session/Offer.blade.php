@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('session/css/offer.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <a href="#" role="button" class="btn btn-primary btn-sm" onclick="inscription('{{ $of->id }}')" >Inscribir</a>
                    </div>
                </div>
            @endforeach


        </div>
    </div>

    <script>
        function inscription(id) {
            if (confirm('¿Estás seguro de que quieres inscribir esta Asignatura?')) {
                $.ajax({
                    type: 'GET',
                    url: '/users/offer/inscription',
                    data: { id: id },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.href = '/users/offer';
                    },
                    error: function(error) {
                        console.error('Error en la solicitud Ajax:', error);
                    }
                });
            }
        }
    </script>

@endsection
