<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/icon/v1_28.png') }}" />
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Inter&display=swap') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('start/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('start/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('session/css/navigation.css') }}">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @yield('style')
</head>

<body>
    @if (!Auth::check())
        @include('common.navigation')
    @else
        @if (session('role')==2)
            @include('admin/common.navigation')
        @else
            @include('session/common.navigation')
        @endif

    @endif


    @yield('content')
    @include('common.footer')

    {{-- Script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
</body>

</html>
