@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('start/css/preinscription.css') }}">
@endsection

@section('title')
    Preincripcion
@endsection

@section('content')
    <div class="container">
        <div class="cont">
            <div class="title">
                <h4>Preincripcion</h4>
            </div>

            <div class="form">
                <div class="row">
                    <div class="col-lg-12 col-lg-offset-2">

                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <form class="needs-validation" novalidate>

                                <fieldset class="border rounded-3 p-3">
                                    <legend class="float-none w-auto px-3">information</legend>
                                    <article class=" blog-post">

                                        <div class="row g-3">
                                            <div class="col-sm-12">
                                                <label for="program" class="form-label">Program:</label>
                                                <select class="form-select" name="program" id="program" required
                                                    alt="gandalf">
                                                    <option value="">Choose...</option>
                                                    @foreach ($program as $pro)
                                                        <option value="{{ $pro->id }}">{{ $pro->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid program.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="firstName" class="form-label">Nombre:</label>
                                                <input type="text" class="form-control" name="firstName" id="firstName" placeholder=""
                                                    value="" required>
                                                <div class="invalid-feedback">
                                                    Valid Name is required.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="lastName" class="form-label">Apellido:</label>
                                                <input type="text" class="form-control" name="lastName" id="lastName" placeholder=""
                                                    value="" required>
                                                <div class="invalid-feedback">
                                                    Valid last name is required.
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="mail" class="form-label">Email:</label>
                                                <input type="mail" class="form-control" name="mail" id="mail"
                                                    placeholder="" value="" required>
                                                <div class="invalid-feedback">
                                                    Valid last name is required.
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="gender" class="form-label">Genero:</label>
                                                <select class="form-select" name="gender" id="gender" required
                                                    alt="gandalf">
                                                    <option value="">Choose...</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid Genero
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="phone" class="form-label">Celular:</label>
                                                <input type="text" class="form-control" name="phone" id="phone" placeholder=""
                                                    value="" required>
                                                <div class="invalid-feedback">
                                                    Valid last name is required.
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="district" class="form-label">Barrio:</label>
                                                <select class="form-select" name="district" id="district" required
                                                    alt="gandalf">
                                                    <option value="">Choose...</option>
                                                    @foreach ($district as $dis)
                                                        <option value="{{ $dis->id }}">{{ $dis->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid Tipo de Identificacion
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="document" class="form-label">N° de Identificacion:</label>
                                                <input type="text" class="form-control" name="document" id="document" placeholder=""
                                                    value="" required>
                                                <div class="invalid-feedback">
                                                    Valid last Identificacion is required.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="photo" class="form-label">Foto:</label>
                                                <input type="file" class="form-control" name="photo" id="photo"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Valid last photo is required.
                                                </div>

                                            </div>

                                        </div>

                                    </article>
                                </fieldset>

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
    <script src="{{ asset('js/checkout.js') }}"></script>
@endsection
