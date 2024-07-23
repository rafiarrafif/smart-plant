@extends('plants.layouts.pairing')

@section('content')
    <div class="main-content">
        <div class="fixed-header">
            <div class="back-btn" onclick="RedirectPage('{{ route('home') }}')">
                <i data-feather="chevron-left" style="stroke: #b0a1fe"></i>
            </div>
            <div class="title-plant">
                <span>Pairing {{ $plant->name }}</span>
            </div>
            <div class="del-btn" onclick="RedirectPage('{{ route('plant.edit', ['plant' => $plant->slug]) }}')">
                <i data-feather="sliders" style="stroke: #b0a1fe; opacity: 0; pointer-events: none;"></i>
            </div>
        </div>
        <div class="card-token">
            <div class="header-token">
                <h1>Pairing Token</h1>
                <p>Sebelum menggunakan ini harap sambungkan ESP dengan id "{{ $plant->id }}" dan dengan Token berikut
                    ini pada Endpoint API:</p>
            </div>
            <div class="main-highlight-token">
                <div class="main">
                    <span>{{ $plant->keystream }}</span>
                    <button onclick="copyToClipboard('{{ $plant->keystream }}')">
                        <i data-feather="clipboard" style="width: 18px; stroke: #cacaca"></i>
                    </button>
                </div>
            </div>
            <div class="action-token">
                <a href="{{ route('plant.show', ['plant' => $plant->slug]) }}">Muat Ulang</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function RedirectPage(url) {
            window.location.href = url;
        }

        function copyToClipboard(data) {
            navigator.clipboard.writeText(data);

            console.log("Copied the text: " + data);
        }
    </script>
@endsection
