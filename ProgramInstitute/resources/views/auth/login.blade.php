@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('start/css/login.css') }}">
@endsection

@section('title')
    login
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Acceso</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('session') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="user" class="col-md-4 col-form-label text-md-end">Usuario</label>

                                <div class="col-md-6">
                                    <input id="user" type="user" class="form-control"  name="user" value=""
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control"  name="password" value="" required>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Aceder
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
