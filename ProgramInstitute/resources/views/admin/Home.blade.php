@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/home.css') }}">
@endsection

@section('title')
    Home
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <img src="{{ asset('image/icon/v1_28.png') }}" alt="">

            <div class="text">
                <div class="wlc">Bienvenido</div>
                <div class="name">{{ session('first_name').' '.session('last_name') }}</div>
            </div>

        </div>
    </div>

@endsection
