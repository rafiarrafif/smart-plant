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
    <link rel="stylesheet" href="{{ asset('css/plant.settings.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/main.css') }}">
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
    @yield('scripts')
</body>

</html>
