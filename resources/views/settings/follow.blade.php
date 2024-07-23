@extends('settings.layouts.follow')

@section('content')
    <button onclick="backPage()" class="back-container">
        <i data-feather="arrow-left" style="stroke: #b0a1fe"></i>
    </button>
    <div class="main-container">
        <div class="header-content">
            <div class="left-header">
                <div class="image-logo">
                    <img src="{{ asset('img/logo_large.png') }}" alt="sutarno-tech">
                </div>
            </div>
            <div class="right-header">
                <div class="title">
                    <h1>Siapakah Kami 🤫</h1>
                </div>
                <div class="subtitle">
                    <p>Terima kasih kepada semua Kontributor atas kontribusinya di project ini</p>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="card-container">
                <div class="left-panel">
                    <a  class="card-profile">
                        <div class="left-side">
                            <div class="profile-container">
                                <img src="{{ asset('img/profile-faisal.jpg') }}" alt="faisal-ridho-zulhilmi">
                            </div>
                        </div>
                        <div class="right-side">
                            <div class="name">
                                <p>Faisal Ridha Zulhilmi</p>
                            </div>
                            <div class="contrib">
                                <p>Hardware Engineer, Electrical Engineer, Hardware Designer, Product Designer, Wiring</p>
                            </div>
                        </div>
                    </a>
                    <a class="card-profile">
                        <div class="left-side">
                            <div class="profile-container">
                                <img src="{{ asset('img/profile-helmi.jpg') }}" alt="faisal-ridho-zulhilmi">
                            </div>
                        </div>
                        <div class="right-side">
                            <div class="name">
                                <p>Helmi Arrafif Kanahaya</p>
                            </div>
                            <div class="contrib">
                                <p>Full Stack Web Developer, Database Administrator, UI/UX Designer</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="right-panel">
                    <a class="card-profile">
                        <div class="left-side">
                            <div class="profile-container">
                                <img src="{{ asset('img/profile-anggito.jpg') }}" alt="faisal-ridho-zulhilmi">
                            </div>
                        </div>
                        <div class="right-side">
                            <div class="name">
                                <p>Anggito Abimanyu</p>
                            </div>
                            <div class="contrib">
                                <p>Finance Manager, Project Management, Guideline Designer</p>
                            </div>
                        </div>
                    </a>
                    <a href="https://www.instagram.com/dr.syaupik/" target="_blank" class="card-profile">
                        <div class="left-side">
                            <div class="profile-container">
                                <img src="{{ asset('img/profile-syauqi.jpg') }}" alt="faisal-ridho-zulhilmi">
                            </div>
                        </div>
                        <div class="right-side">
                            <div class="name">
                                <p>Syauqi Dzul Rahman</p>
                            </div>
                            <div class="contrib">
                                <p>Product Designer, Guideline Desinger, Video Editor</p>
                            </div>
                        </div>
                    </a>
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
