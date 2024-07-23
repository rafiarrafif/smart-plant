<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('meta.main')
    <title>Silahkan Verifikasi</title>


    @include('lib.main')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>
    <main>
        <div class="main-container">
            <div class="title-container">
                <h1>Tunggu Sebentar</h1>
                <p>Silahkan hubungi Admin untuk mengaktifkan akun kamu</p>
            </div>
            <div class="button-container">
                <div class="logout-btn">
                    <a href="{{ route('logout') }}">Keluar</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
