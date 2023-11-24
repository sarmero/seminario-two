@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/programRegister.css') }}">
@endsection

@section('title')
    Programas
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title">
                <div class="tit">Programas</div>
            </div>

            <div class="form">
                <div class="row">
                    <div class="col-lg-12 col-lg-offset-2">

                        <form action="{{ route('admin.program.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <label for="program" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" name="program" id="program" placeholder=""
                                        value="{{ old('program') }}" required>
                                    @error('program')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-12">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea type="text" class="form-control" name="description" id="description" placeholder="" value=""
                                        required></textarea>
                                </div>

                                <div class="col-sm-12">
                                    <label for="imag" class="form-label">Imagen:</label>
                                    <input type="file" class="form-control" name="imag" id="imag" required>
                                </div>

                            </div>


                            <hr class="my-4">

                            <button class="w-50 btn btn-primary btn-sm offset-md-3" type="submit">Enviar</button>
                            <br><br>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
