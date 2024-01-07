@extends('auth.BaseAuth')

@section('style')
    <link rel="stylesheet" href="{{ asset('auth/auth.css') }}">
@endsection

@section('title')
    login
@endsection

@section('content')
    <div class="create my-3 mx-3 mb-3 d-flex justify-content-start">
        <a href="{{ route('program.create') }}" class="btn btn-primary btn-sm" role="button">
            Atras
        </a>
    </div>

    <div class="container">
        {{-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Acceso</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('session') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="user" class="col-md-4 col-form-label text-md-end">Usuario</label>

                                <div class="col-md-6">
                                    <input id="user" type="user" class="form-control" name="username" value=""
                                        required>
                                </div>
                            </div>
                            @error('username')
                                <div class="text-small text-danger">{{ $message }}</div>
                            @enderror

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"
                                        value="" required>
                                </div>
                            </div>
                            @error('password')
                                <div class="text-small text-danger">{{ $message }}</div>
                            @enderror

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
        </div> --}}

        <div class="login-reg-panel">

            <div class="register-info-box">
                <img src="{{ asset('image/icon/icon.png') }}" class="logo">
                <p class="text-center">Instituto Tecnico <br> Visionarios del Mañana</p>
            </div>

            <div class="white-panel">
                <div class="login-show">
                    <form method="POST" action="{{ route('session') }}">
                        @csrf
                        <h2>Acceso</h2>

                        <input type="text" name="username" class="form-control" placeholder="Username">
                        @error('username')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror

                        <input type="password" name="password" class="form-control" placeholder="Password">

                        @error('password')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-success btn-sm">Aceder</button>
                        <br><br>
                        <a href="">¿Has olvidado tu contraseña?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
