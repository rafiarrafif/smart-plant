@extends('settings.layouts.about')

@section('content')
    <button onclick="backPage()" class="back-container">
        <i data-feather="arrow-left" style="stroke: #b0a1fe"></i>
    </button>
    <div class="main-container">
        <div class="header-content">
            <div class="image-logo">
                <img src="{{ asset('img/logo_large.png') }}" alt="sutarno-tech">
            </div>
            <div class="header-text">
                <h3>Sekilas Tentang Kami</h3>
            </div>
            <div class="main-text">
                <p>Sutarno Technology atau di kenal sebagai SWTR
                    Technology adalah kelompok peserta ABBS ICT Fest 2024
                    yang berfokus pada pengembangan
                    solusi teknologi Internet of Things (IoT) untuk mempermudah kehidupan manusia dan menjaga konektivitas
                    antar perangkat rumah, meskipun
                    pengguna berada jauh. Kami bekerja sama secara erat untuk menghadirkan inovasi yang membawa kenyamanan
                    dan efisiensi.
                </p>
                <p>Proyek ini dirancang untuk membantu pemilik tanaman merawat tanaman mereka secara efisien dan teratur,
                    bahkan saat mereka tidak berada di rumah. Sistem ini menggunakan sensor dan teknologi cerdas untuk
                    memonitor kebutuhan air tanaman dan menyiramnya secara otomatis sesuai kebutuhan.</p>
                <p>Komitmen kami adalah untuk tetap terhubung dan terus membawa manfaat nyata bagi masyarakat melalui
                    teknologi IoT yang cerdas dan efektif yang bersifat sumber terbuka. Terima kasih telah mengunjungi kami
                    dalam mengembangkan solusi teknologi yang inovatif!</p>
            </div>
            <div class="footer-text">
                <div class="icon">
                    <img src="{{ asset('img/github-logo.png') }}">
                </div>
                <div class="text">
                    <a href="">Made with ❤️ by <span>Sutarno Team</span></a>
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
