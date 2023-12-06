@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/userDetail.css') }}">
@endsection

@section('title')
    Detalle
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title">
                <div class="tit">Detalle usuario</div>
            </div>

            <div class="detail">

                <div class="row">
                    <div class="col-3">
                        <div class="image">
                            @if ($person->photo != '')
                                <img src="{{ asset('storage/profile/'.$person->photo) }}" alt="user" width="200"
                                    height="230" class="d-inline-block align-text-center">
                            @else
                                <img src="{{ asset('image/profile/profilex.jpg') }}" alt="user" width="150"
                                    height="180" class="d-inline-block align-text-center">
                            @endif
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="person">

                            <div class="inf">
                                <div class="item">Nombre</div>
                                <div class="descip">{{ $person->first_name }}</div>
                            </div>

                            <div class="inf">
                                <div class="item">Apellido</div>
                                <div class="descip">{{ $person->last_name }}</div>
                            </div>

                            <div class="inf">
                                <div class="item">Genero</div>
                                <div class="descip">
                                    @if ($person->gender === 'M')
                                        Masculino
                                    @else
                                        Femenino
                                    @endif

                                </div>
                            </div>

                            <div class="inf">
                                <div class="item">N. Identificacion</div>
                                <div class="descip">{{ $person->number_document }}</div>
                            </div>

                        </div>
                    </div>


                    <div class="col-3">
                        <div class="person">
                            <div class="inf">
                                <div class="item">Rol</div>
                                <div class="descip">{{ $person->role }}</div>
                            </div>

                            <div class="inf">
                                <div class="item">Email</div>
                                <div class="descip">{{ $person->email }}</div>
                            </div>

                            <div class="inf">
                                <div class="item">Telefono</div>
                                <div class="descip">{{ $person->phone }}</div>
                            </div>

                            <div class="inf">
                                <div class="item">Barrio</div>
                                <div class="descip">{{ $person->district }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="person">
                            <div class="inf">
                                <div class="item">Programa</div>
                                <div class="descip">{{ $person->name }}</div>
                            </div>

                            @if ($person->role_id == 1 || $person->role_id == 4)
                                <div class="inf">
                                    <div class="item">Codigo</div>
                                    <div class="descip">{{ $person->code }}</div>
                                </div>

                                @isset($person->semester)
                                    <div class="inf">
                                        <div class="item">Semestre</div>
                                        <div class="descip">{{ $person->semester }}</div>
                                    </div>
                                @else
                                    <div class="inf">
                                        <div class="item">Estado</div>
                                        <div class="descip">{{ $person->state }}</div>
                                    </div>
                                @endisset

                                <div class="inf">
                                    <div class="item">Modalidad</div>
                                    <div class="descip">{{ $person->modality }}</div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
