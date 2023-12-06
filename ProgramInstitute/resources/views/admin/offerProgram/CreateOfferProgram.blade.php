@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/form.css') }}">
@endsection

@section('title')
    Ofertas de Programas
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title my-3">
                <div class="tit">Crear oferta de programa</div>
            </div>

            <form action="{{ route('offer-program.store') }}" method="POST">
                @csrf
               

                @include('admin.offerProgram.FormOfferProgram')

                <button class="w-50 my-3 btn btn-primary btn-sm offset-md-3" type="submit">Enviar</button>
                <br><br>
            </form>

        </div>
    </div>
@endsection
