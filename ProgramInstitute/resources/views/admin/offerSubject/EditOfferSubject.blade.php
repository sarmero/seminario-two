@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/form.css') }}">
@endsection

@section('title')
    Ofertas de Asignatura
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title my-3">
                <div class="tit">Editar Asignatura</div>
            </div>

            <form action="{{ route('offer-subject.update',$offer->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.offerSubject.FormOfferSubject')

                <button class="w-50 my-4 btn btn-primary btn-sm offset-md-3" type="submit">Enviar</button>
                <br><br>
            </form>

        </div>
    </div>
@endsection
