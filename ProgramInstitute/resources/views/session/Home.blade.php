@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('session/css/home.css') }}">
@endsection

@section('title')
    Session
@endsection

@section('content')
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-sm-3">
                    <div class="session-1">
                        <div class="profile">

                            <img src="{{ asset('image/profile/cover.jpg') }}" alt="">

                            <div class="photo">
                                @if (session('photo'))
                                    <img src="data:image/jpeg;base64,{{ base64_encode(session('photo')) }}" alt="user">
                                @else
                                    <img src="{{ asset('image/profile/profile.png') }}" alt="">
                                @endif
                            </div>

                            <div class="text">
                                {{ session('first_name') . ' ' . session('last_name') }} <br>
                                <span>{{ session('program') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('ratings') }}">
                            <div class="item">
                                <img src="{{ asset('image/profile/subject.jpg') }}" alt="">

                                <div class="icon">
                                    <img src="{{ asset('image/profile/subject-icon.png') }}" alt="">
                                </div>

                                <div class="text">
                                    Calficaciones
                                </div>
                            </div>
                        </a>


                        <a href="{{ route('session.offer') }}">
                            <div class="item">
                                <img src="{{ asset('image/profile/ratings.png') }}" alt="">

                                <div class="icon">
                                    <img src="{{ asset('image/profile/ratings-icon.png') }}" alt="">
                                </div>

                                <div class="text">
                                    Ofertas
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('plan') }}">
                            <div class="item">
                                <img src="{{ asset('image/profile/plan-study.png') }}" alt="">

                                <div class="icon">
                                    <img src="{{ asset('image/profile/plan-study-icon.png') }}" alt="">
                                </div>

                                <div class="text">
                                    Plan de estudio
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('logout') }}">
                            <div class="item">
                                <img src="{{ asset('image/profile/close.png') }}" alt="">

                                <div class="icon">
                                    <img src="{{ asset('image/profile/close-icon.png') }}" alt="">
                                </div>

                                <div class="text">
                                    Cerrar Sesión
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="session-2">

                        <div class="title">Noticias</div>
                        <hr>

                        <div class="scroller">
                            @foreach (session('news') as $news)
                                <div class="post" id="">

                                    <div class="head">

                                        <img src="{{ asset('image/icon/v1_121.png') }}">

                                        <div class="cont">
                                            <div class="inst">
                                                Vicionarios del mañana
                                            </div>
                                            <div class="cls">
                                                Institucional
                                            </div>
                                        </div>

                                    </div>

                                    <div class="description">
                                        <div class="title">
                                            {{ $news->title }}
                                        </div>

                                        @if ($news->image)
                                            <img src="data:image/jpeg;base64,{{ base64_encode($news->image) }}"
                                                alt="user">
                                        @endif
                                        
                                        <p>{{ $news->description }}</p>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="session-3">
                        <div class="icon">
                            <img src="{{ asset('image/icon/v1_121.png') }}">
                        </div>

                        <div class="academic">
                            <div class="title text-center">
                                Informacion Academica
                            </div>
                            <hr>
                            <div class="cont">
                                <div class="item">
                                    <div class="theme">Codigo</div>
                                    <div class="desc">{{ session('code') }}</div>
                                </div>

                                <div class="item">
                                    <div class="theme">Semestre</div>
                                    <div class="desc">{{ session('semester') }}</div>
                                </div>

                                <div class="item">
                                    <div class="theme">Asignaturas</div>
                                    <div class="desc">{{ session('subjects') }}/{{ session('subject_tt') }}</div>
                                </div>

                                <div class="item">
                                    <div class="theme">Promedio</div>
                                    <div class="desc">{{ session('average') }}</div>
                                </div>

                                <div class="item">
                                    <div class="theme">Estatus</div>
                                    <div class="desc">{{ session('position') }}</div>
                                </div>

                            </div>
                        </div>

                        <div class="activity">
                            <div class="title text-center">
                                Actividades
                            </div>
                            <hr>
                            <div class="scroller-x">
                                <div class="cont">
                                    @foreach (session('activity') as $act)
                                        <div class="item">
                                            <div class="theme">{{ $act->description }}</div>
                                            <div class="desc">{{ $act->deadline }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
