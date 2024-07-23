<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('meta.main')
    <title>{{ $title }}</title>

    @include('lib.main')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('dist/flasher/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/flasher/flash.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/settings.about.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/main.css') }}">

</head>

<body>
    <nav>
        @include('partials.navbar')
    </nav>
    <div class="flash-container">
        @yield('flasher')
    </div>
    <main>
        @yield('content')
    </main>

    <script>
        feather.replace();
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/flasher/flash.min.js') }}"></script>
    <script src="{{ asset('dist/flasher/flash.jquery.min.js') }}"></script>
    <script src="{{ asset('dist/flasher/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
