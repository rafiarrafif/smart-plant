<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('meta.main')
    <title>{{ $title }}</title>

    @include('lib.main')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plant.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/main.css') }}">
    @yield('styles')

</head>

<body>
    <nav>
        @include('partials.navbar')
    </nav>

    <main>
        @yield('content')
    </main>

    <script>
        feather.replace();
    </script>
    <script src="{{ asset('js/showMore.plant.js') }}"></script>
    <script src="{{ asset('js/shower.plant.js') }}"></script>
    <script src="{{ asset('js/api.plant.js') }}"></script>
    <script src="{{ asset('js/showerHistory.plant.js') }}"></script>
    @yield('scripts')
</body>

</html>
