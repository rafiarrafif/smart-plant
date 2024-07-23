@extends('settings.layouts.main')

@section('content')
    <div class="main-container">
        <div class="header-content">
            <h1>Pusat Pengaturan</h1>
        </div>
        <div class="main-content">
            <div class="settings-section personal-section">
                <div class="title">
                    <h1>Personal</h1>
                </div>
                <div class="settings-card-container">
                    <a href="{{ route('settings.account') }}" class="settings-card">
                        <div class="name">
                            <span>Akun Saya</span>
                        </div>
                        <div class="icon">
                            <i data-feather="chevron-right" style="width: 20px"></i>
                        </div>
                    </a>
                    <a href="{{ route('logout') }}" class="settings-card">
                        <div class="name">
                            <span>Keluar</span>
                        </div>
                        <div class="icon">
                            <i data-feather="log-out" style="width: 18px"></i>
                        </div>
                    </a>
                </div>
            </div>

            {{-- <div class="settings-section dev-section">
                <div class="title">
                    <h1>Aplikasi</h1>
                </div>
                <div class="settings-card-container">
                    <a class="settings-card">
                        <div class="name">
                            <span>Kelola Pengguna</span>
                        </div>
                        <div class="icon">
                            <i data-feather="chevron-right" style="width: 20px"></i>
                        </div>
                    </a>
                    <a href="{{ route('settings.access') }}" class="settings-card">
                        <div class="name">
                            <span>Kelola Hak Akses</span>
                        </div>
                        <div class="icon">
                            <i data-feather="chevron-right" style="width: 20px"></i>
                        </div>
                    </a>
                    <a href="{{ route('settings.suspend') }}" class="settings-card">
                        <div class="name">
                            <span>Bekukan Aplikasi</span>
                        </div>
                        <div class="icon">
                            <i data-feather="chevron-right" style="width: 20px"></i>
                        </div>
                    </a>
                </div>
            </div> --}}

            <div class="settings-section dev-section">
                <div class="title">
                    <h1>Tentang Pengembang</h1>
                </div>
                <div class="settings-card-container">
                    <a href="{{ route('settings.about') }}" class="settings-card">
                        <div class="name">
                            <span>Tentang Kami</span>
                        </div>
                        <div class="icon">
                            <i data-feather="chevron-right" style="width: 20px"></i>
                        </div>
                    </a>
                    <a href="{{ route('settings.follow') }}" class="settings-card">
                        <div class="name">
                            <span>Ikuti Kami</span>
                        </div>
                        <div class="icon">
                            <i data-feather="chevron-right" style="width: 20px"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
