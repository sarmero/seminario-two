@extends('start.BaseStart')

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

                            <fieldset class="border rounded-3 p-3">
                                <legend class="float-none w-auto px-3">information</legend>
                                <article class=" blog-post">

                                    <div class="row g-3">
                                        <div class="col-sm-12">
                                            <label for="program" class="form-label">Program:</label>
                                            <select class="form-select" name="program" id="program" required
                                                alt="gandalf">
                                                <option value="">Elejir...</option>
                                                @foreach ($program as $pro)
                                                    <option value="{{ $pro->id }}"
                                                        {{ old('program') == $pro->id ? 'selected' : '' }}>
                                                        {{ $pro->program->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="col-sm-6">
                                            <label for="firstName" class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" name="firstName" id="firstName"
                                                placeholder="" value="{{ old('firstName') }}">
                                            @error('firstName')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="lastName" class="form-label">Apellido:</label>
                                            <input type="text" class="form-control" name="lastName" id="lastName"
                                                placeholder="" value="{{ old('lastName') }}">
                                            @error('lastName')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="mail" class="form-label">Email:</label>
                                            <input type="mail" class="form-control" name="mail" id="mail"
                                                placeholder="" value="{{ old('mail') }}" required>
                                            @error('mail')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="gender" class="form-label">Genero:</label>
                                            <select class="form-select" name="gender" id="gender" alt="gandalf">
                                                <option value="">Elejir...</option>
                                                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>
                                                    Masculino</option>
                                                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>
                                                    Femenino</option>
                                            </select>

                                        </div>

                                        <div class="col-sm-4">
                                            <label for="phone" class="form-label">Celular:</label>
                                            <input type="number" class="form-control" name="phone" id="phone"
                                                placeholder="" value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="district" class="form-label">Barrio:</label>
                                            <select class="form-select" name="district" id="district" alt="gandalf">
                                                <option value="">Elejir...</option>
                                                @foreach ($district as $dis)
                                                    <option value="{{ $dis->id }}"
                                                        {{ old('district') == $dis->id ? 'selected' : '' }}>
                                                        {{ $dis->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="document" class="form-label">N. de Identificacion:</label>
                                            <input type="text" class="form-control" name="document" id="document"
                                                placeholder="" value="{{ old('document') }}">
                                            @error('document')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="photo" class="form-label">Foto:</label>
                                            <input type="file" class="form-control" name="photo" id="customFile">

                                            @error('photo')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-12 imageFile">
                                            <div class="mb-3 d-flex justify-content-center">
                                                <img name="image" id="preview-image-before-upload"
                                                    src="{{ asset('image/upload-image.png') }}"
                                                    alt="Previsualizar imagen" class="image-preview">
                                            </div>
                                        </div>

                                    </div>

                                </article>
                            </fieldset>

                            <hr class="my-4">

                            <button class="w-50 btn btn-primary btn-sm offset-md-3" type="submit">Enviar</button>
                            <br><br>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(e) {
            $('#customFile').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
