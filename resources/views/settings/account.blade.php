@php
    use Carbon\Carbon;
@endphp


@extends('settings.layouts.account')

@section('content')
    <button onclick="backPage()" class="back-container">
        <i data-feather="arrow-left" style="stroke: #b0a1fe"></i>
    </button>
    <div class="main-container">
        <div class="left-container">
            <div class="profile-picture">
                <div class="image-container">
                    <img src="{{ $userData->avatar }}" alt="profile-picture">
                </div>
            </div>
        </div>
        <div class="right-container">
            <div class="tagline">
                <h3>Data Pengguna</h3>
            </div>
            <div class="info-container">
                <div class="info-card">
                    <div class="label">
                        <span>Nama</span>
                    </div>
                    <div class="value">
                        <span>{{ $userData->name }}</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="label">
                        <span>Email</span>
                    </div>
                    <div class="value">
                        <span>{{ $userData->email }}</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="label">
                        <span>Login Via</span>
                    </div>
                    <div class="value">
                        <span>{{ $userData->vendor }}</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="label">
                        <span>Bergabung Pada</span>
                    </div>
                    <div class="value">
                        <span>{{ $userData->created_at->isoFormat('D MMMM YYYY') }}</span>
                    </div>
                </div>
            </div>
            <div class="edit-container">
                <div class="edit-content">
                    <div class="left-content">
                        <div class="icon">
                            <i data-feather="alert-triangle" style="stroke: #b0a1fe; width: 22px"></i>
                        </div>
                    </div>
                    <div class="right-content">
                        <div class="header">
                            <h3>Tidak bisa mengedit data</h3>
                        </div>
                        <div class="content">
                            <p>Kamu login menggunakan authentikasi pihak ketiga ({{ $userData->vendor }} OAuth). Tenang,
                                kamu
                                masih
                                bisa merubah data kamu dengan cara melakukanya di Pusat Akun {{ $userData->vendor }} dan
                                lakukan
                                login ulang pada
                                aplikasi ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function backPage() {
            window.history.back();
        }
    </script>
@endsection
