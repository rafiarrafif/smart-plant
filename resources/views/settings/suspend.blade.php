@extends('settings.layouts.suspend')

@section('content')
    <button onclick="backPage()" class="back-container">
        <i data-feather="arrow-left" style="stroke: #b0a1fe"></i>
    </button>
    <div class="header-content">
        <div class="icon-content">
            <img src="{{ asset('img/logo_large.png') }}" alt="sutarno-technology-logo">
        </div>
        <div class="title-content">
            <h1>Bekukan Aplikasi</h1>
            <p>Gunakan untuk menyegarkan server dari beban berlebih</p>
        </div>
    </div>
    <div class="main-content">
        @if (AppSettings('app_state') == 'active')
            <div class="action-section">
                <div class="action-container">
                    <div class="action-btn turn-on-button">
                        <button onclick="turnOffSystem()">
                            MATIKAN
                        </button>
                    </div>
                </div>
                <div class="action-status">
                    <div class="status-container on-state">
                        <p>Status Sistem</p>
                        <h1>BERJALAN</h1>
                    </div>
                </div>
            </div>
        @elseif(AppSettings('app_state') == 'frezee')
            <div class="action-section">
                <div class="action-container">
                    <div class="action-btn turn-off-button">
                        <button onclick="turnOnSystem()">
                            HIDUPKAN
                        </button>
                    </div>
                </div>
                <div class="action-status">
                    <div class="status-container off-state">
                        <p>Status Sistem</p>
                        <h1>BERHENTI</h1>
                    </div>
                </div>
            </div>
        @endif
        <div class="alert-section">
            <div class="alert-content">
                <div class="icon">
                    <i data-feather="alert-triangle" style="width: 16px; stroke: #b80f0a;"></i>
                </div>
                <div class="text">
                    <p>Semua sistem yang terhubung ke Aplikasi ini akan di berhentikan sepenuhnya. Pemahaman lebih
                        lanjut diperlukan, Segera kembali jika anda tidak tahu apa yang harus dilakukan
                        disini</p>
                </div>
            </div>
        </div>
    </div>
    <div class="alert">
        <div id="turn-on-popup" class="popup-container" style="display: none">
            <div class="popup-card">
                <div class="title">
                    <h1>Yakin?</h1>
                </div>
                <div class="sub-title">
                    <p>Ini mengakibatkan koneksi semua perangkat ke aplikasi terputus termasuk ESP. Pastikan tidak ada
                        penyiraman yang masih berlangsung</p>
                </div>
                <form action="{{ route('settings.suspend.action') }}" method="POST">
                    <div class="popup-action-btn">
                        @csrf
                        <input type="hidden" name="state" value="frezee">
                        <div class="popup-btn cancel-btn">
                            <button type="button" onclick="cancelPopup()">
                                Batal
                            </button>
                        </div>
                        <div class="popup-btn continue-btn">
                            <button type="submit">
                                Bekukan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="turn-off-popup" class="popup-container" style="display: none">
            <div class="popup-card">
                <div class="title">
                    <h1>Yakin?</h1>
                </div>
                <div class="sub-title">
                    <p>Koneksi semua perangkat ke Aplikasi akan dibuka. Pastikan kondisi server keadaan prima saat
                        mengaktifkan ini</p>
                </div>
                <form action="{{ route('settings.suspend.action') }}" method="POST">
                    <div class="popup-action-btn">
                        @csrf
                        <input type="hidden" name="state" value="active">
                        <div class="popup-btn cancel-btn">
                            <button type="button" onclick="cancelPopup()">
                                Batal
                            </button>
                        </div>
                        <div class="popup-btn continue-btn">
                            <button type="submit">
                                Aktifkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function turnOffSystem() {
            $('#turn-on-popup').fadeIn().css('display', 'flex');
        }

        function turnOnSystem() {
            $('#turn-off-popup').fadeIn().css('display', 'flex');
        }

        function cancelPopup() {
            $('.popup-container').fadeOut();
        }
    </script>
    <script>
        function backPage() {
            window.history.back();
        }
    </script>
@endsection
