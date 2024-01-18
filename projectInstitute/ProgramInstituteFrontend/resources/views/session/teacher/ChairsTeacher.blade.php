@extends('session.BaseSession')

@section('style')
<link rel="stylesheet" href="{{ asset('session/css/body.css') }}">
    <link rel="stylesheet" href="{{ asset('session/css/offer.css') }}">
@endsection

@section('title')
    Catedras
@endsection

@section('content')
    <div class="container">
        <div class="content">

            <div class="table-responsive">
                <table class="table table-striped table table-bordered align-middle">
                    <thead class="">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">Catedra</th>
                            <th class="text-center" scope="col">Semestre</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($chairs as $i => $item)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $item['description'] }}</td>
                                <td class="text-center">{{ $item['semester'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
