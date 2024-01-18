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
            <div class="title">
                <div class="tit">Editar Oferta</div>
            </div>

            <form action="{{ route('offer-program.update',$offer->id) }}"  method="POST">
                @csrf
                @method('PUT')

                @include('admin.offerProgram.FormOfferProgram')

                <button class="w-50 my-3 btn btn-primary btn-sm offset-md-3" type="submit">Enviar</button>
                <br><br>
            </form>

        </div>
    </div>
@endsection
