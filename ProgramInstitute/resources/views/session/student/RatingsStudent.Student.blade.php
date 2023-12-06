@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('session/css/ratings.css') }}">
@endsection

@section('title')
    Calificaciones
@endsection

@section('content')
    <div class="container">
        <div class="content">

            <form action="{{ route('ratings.semester') }}" method="POST">
                @csrf
                <div class="semester">
                    <label for="program" class="form-label">Semestre:</label>
                    <select class="form-select" name="smt" id="semester" required alt="gandalf">
                        <option value="">Choose...</option>
                        @foreach ($semester as $sem)
                            <option value="{{ $sem->id }}">{{ $sem->description }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <script>
                document.getElementById('semester').addEventListener('change', function() {
                    this.form.submit();
                });
            </script>


            <div class="item-top">
                <div class="sub">Asignatura</div>

                @isset($semt)
                    <div class="sem-x">Semestre: {{ $semt }}</div>
                @endisset





                <div class="nt">Nota</div>

            </div>

            <hr>

            @isset($subject)
                @foreach ($subject as $sub)
                    <div class="item">
                        <div class="cont">
                            <div class="subject">{{ $sub->description }}</div>
                            <hr>
                            <div class="teacher">
                                Docente: <span><strong>{{ $sub->first_name }} {{ $sub->last_name }}</strong> </span>
                            </div>
                        </div>

                        <div class="note">
                            <div class="desc">
                                {{ $sub->note }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset

        </div>
    </div>
@endsection
