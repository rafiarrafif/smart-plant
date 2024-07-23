@extends('welcome.layouts.header')

@section('content')
    <div class="main-container">
        <div class="image-container">
            <img src="{{ asset('img/logo_large.png') }}" alt="sutarman-technology-logo" loading="lazy">
        </div>
        <div class="title-container">
            <div class="main-title">
                <span>Selamat Datang</span>
            </div>
            <div class="sub-title">
                <span>Yuk masuk dulu, Lalu nikmatin semua fiturnya</span>
            </div>
        </div>
        <div class="login-container">
            <div class="google-login">
                <a href="{{ route('google.redirect') }}" class="google-card login-card">
                    <div class="google-img login-img">
                        <img src="{{ asset('img/google_logo.png') }}" loading="lazy">
                    </div>
                    <div class="google-desc login-desc">
                        <span>Masuk dengan Google</span>
                    </div>
                </a>
            </div>
            {{-- <div class="facebook-login">
                <a href="" class="facebook-card login-card">
                    <div class="facebook-img login-img">
                        <img src="{{ asset('img/facebook_logo.png') }}" loading="lazy">
                    </div>
                    <div class="facebook-desc login-desc">
                        <span>Masuk dengan Facebook</span>
                    </div>
                </a>
            </div> --}}
            <div class="discord-login">
                <a href="{{ route('discord.redirect') }}" class="discord-card login-card">
                    <div class="discord-img login-img">
                        <img src="{{ asset('img/discord_logo.png') }}" loading="lazy">
                    </div>
                    <div class="discord-desc login-desc">
                        <span>Masuk dengan Discord</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
@endsection
