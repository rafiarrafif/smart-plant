@extends('frezee.layouts.index')
@section('content')
    <div class="main-content">
        <div class="icon-content">
            <img src="{{ asset('img/logo_large.png') }}">
        </div>
        <div class="header-content">
            <h1>Sistem Dibekukan</h1>
            <p>Sistem dibekukan oleh admin. Semua layanan yang berkaitan dengan aplikasi ini dihentikan dan semua akses
                ditutup</p>
        </div>
        <div class="action-btn">
            <a href="{{ route('home') }}">Segarkan</a>
            @can('admin')
                <a href="{{ route('settings.suspend') }}">Buka Akses</a>
            @endcan
        </div>
    </div>
@endsection
@section('scripts')
@endsection
