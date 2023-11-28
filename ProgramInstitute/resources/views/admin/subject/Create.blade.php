@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/programRegister.css') }}">
@endsection

@section('title')
    Asignatura
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

                        <form action="{{ route('admin.subject.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <label for="subject" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder=""
                                        value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-10">
                                    <label for="program" class="form-label">Programa:</label>
                                    <select class="form-select" name="program" id="program" required alt="gandalf">
                                        <option value="">Elejir...</option>
                                        @foreach ($program as $sem)
                                            <option value="{{ $sem->id }}">{{ $sem->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <label for="program" class="form-label">Semestre:</label>
                                    <select class="form-select" name="semester" id="semester" required alt="gandalf">
                                        <option value="">Elejir...</option>
                                        @foreach ($semester as $sem)
                                            <option value="{{ $sem->id }}">{{ $sem->description }}
                                            </option>
                                        @endforeach
                                    </select>
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
