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
                            <form class="needs-validation" novalidate>

                                <div class="row g-3">
                                    <div class="col-sm-12">
                                        <label for="program" class="form-label">Nombre:</label>
                                        <input type="text" class="form-control" name="program" id="program"
                                            placeholder="" value="" required>
                                        <div class="invalid-feedback">
                                            Valid Name is required.
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea type="text" class="form-control" name="description" id="description" placeholder="" value=""
                                            required></textarea>
                                        <div class="invalid-feedback">
                                            Valid Name is required.
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="quotas" class="form-label">Cupos:</label>
                                        <input type="text" class="form-control" name="quotas" id="quotas"
                                            placeholder="" value="" required>
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="modality" class="form-label">Modalidad:</label>
                                        <select class="form-select" name="modality" id="modality" required alt="gandalf">
                                            <option value="">Choose...</option>
                                            @foreach ($modality as $pro)
                                                <option value="{{ $pro->id }}">{{ $pro->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid Genero
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="imag" class="form-label">Imagen:</label>
                                        <input type="file" class="form-control" name="imag" id="imag" required>
                                        <div class="invalid-feedback">
                                            Valid last photo is required.
                                        </div>

                                    </div>

                                </div>


                                <hr class="my-4">

                                <button class="w-50 btn btn-primary btn-sm offset-md-3" type="submit">Enviar</button>
                                <br><br>

                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
