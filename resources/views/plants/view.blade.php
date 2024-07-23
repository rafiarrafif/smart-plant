@extends('plants.layouts.header')

@section('content')
    @can('control')
        <div class="container-popup" id="turn-on-popup">
            <div class="popup-content">
                <div class="popup-title">
                    <h1>Yakin?</h1>
                </div>
                <div class="popup-description">
                    <p>Pastikan sekitar area penyiraman aman</p>
                </div>
                <div class="popup-action">
                    <div class="cancel-shower-btn popup-btn">
                        <button onclick="cancelTurnOnShower()">Batal</button>
                    </div>
                    <div class="continue-shower-btn popup-btn">
                        <button onclick="confirmTurnOnShower('{{ $plant->slug }}')">Siram</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-popup" id="turn-off-popup">
            <div class="popup-content">
                <div class="popup-title">
                    <h1>Yakin?</h1>
                </div>
                <div class="popup-description">
                    <p>Konfirmasi untuk menlanjutkan</p>
                </div>
                <div class="popup-action">
                    <div class="cancel-shower-btn popup-btn">
                        <button onclick="cancelTurnOffShower()">Batal</button>
                    </div>
                    <div class="continue-shower-btn popup-btn">
                        <button onclick="confirmTurnOffShower('{{ $plant->slug }}')">Hentikan</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    <div class="bg-header" style="display: none"></div>
    <div class="fixed-header">
        <div class="back-btn" onclick="RedirectPage('{{ route('home') }}')">
            <i data-feather="chevron-left" style="stroke: #b0a1fe"></i>
        </div>
        <div class="title-plant">
            <span>{{ $plant->name }}</span>
        </div>
        @can('admin')
            <div class="del-btn" onclick="RedirectPage('{{ route('plant.edit', ['plant' => $plant->slug]) }}')">
                <i data-feather="sliders" style="stroke: #b0a1fe"></i>
            </div>
        @endcan
    </div>
    <div class="main-content">
        <div id="metadata" data-trigger="{{ route('shower.trigger') }}"
            data-shower-history="{{ route('shower.history', ['plant' => $plant->slug]) }}"
            data-url="{{ route('plant.api', ['plant' => $plant->slug]) }}" data-csrf="{{ csrf_token() }}">
        </div>
        <div class="left-content">
            <div class="main-spot">
                <div class="top-spot">
                    <div class="content-main-spot">
                        <h1 id="mainHighlight">--</h1>
                        <span>Celcius</span>
                    </div>
                    <div class="img-main-spot">
                        <img src="{{ asset('img/plant_icon_2.png') }}">
                    </div>
                </div>
            </div>
            <div class="main-card">
                <div class="top">

                </div>
                <hr class="lineup-plant" id="lineup-1">
                <div class="bottom">
                    <div class="air content-bottom">
                        <div class="icon">
                            <i data-feather="wind" style="stroke: #d2d2d2; width: 18px"></i>
                        </div>
                        <div class="title">
                            <span id="airHighlight">--</span>
                        </div>
                    </div>
                    <hr class="lineup-plant lineup-2">
                    <div class="temp content-bottom">
                        <div class="icon">
                            <i data-feather="thermometer" style="stroke: #d2d2d2; width: 18px"></i>
                        </div>
                        <div class="title">
                            <span id="tempHighlight">--</span>
                        </div>
                    </div>
                    <hr class="lineup-plant lineup-2">
                    <div class="soil content-bottom">
                        <div class="icon">
                            <i data-feather="archive" style="stroke: #d2d2d2; width: 18px"></i>
                        </div>
                        <div class="title">
                            <span id="soilHighlight">--</span>
                        </div>
                    </div>
                </div>
                <div class="show-more-content" style="display: none">
                    <div class="heading">Rincian</div>
                    <table class="show-more-table">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td id="connection">Terhubung</td>
                            </tr>
                            <tr>
                                <td>Kelembaban Udara</td>
                                <td id="airMeasure">-</td>
                            </tr>
                            <tr>
                                <td>Kelembaban Tanah (%)</td>
                                <td id="soilMeasurePercent">-</td>
                            </tr>
                            <tr>
                                <td>Kelembaban Tanah</td>
                                <td id="soilMeasure">-</td>
                            </tr>
                            <tr>
                                <td>Suhu Celcius</td>
                                <td id="tempCelcius">-</td>
                            </tr>
                            <tr>
                                <td>Suhu Fahrenheit</td>
                                <td id="tempFahrenheit">-</td>
                            </tr>
                            <tr>
                                <td>Suhu Reamur</td>
                                <td id="tempReamur">-</td>
                            </tr>
                            <tr>
                                <td>Suhu Kelvin</td>
                                <td id="tempKelvin">-</td>
                            </tr>
                            <tr>
                                <td>Terahir Diperbarui</td>
                                <td id="lastUpdated">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="show-more-btn">
                    <span id="show-more-trigger" onclick="openShowMore()">Lihat Selengkapnya</span>
                    <span id="show-less-trigger" onclick="closeShowMore()">Sembuyikan</span>
                    <div class="icon">◢</div>
                </div>
            </div>
        </div>
        <div class="right-content">
            @can('control')
                <div class="shower-container">
                    <div class="title">Status Penyiraman</div>
                    <div class="shower-card turn-on">
                        <div class="stats">Bersiaga</div>
                        {{-- <div class="stats">{{ $plant->created_at->diff($plant->updated_at) }}</div> --}}
                        <div class="shower-btn">
                            <button onclick="turnOnShower()">Hidupkan</button>
                        </div>
                    </div>
                    <div class="shower-card turn-off">
                        <div class="stats">Menyiram</div>
                        <div class="shower-btn">
                            <button onclick="turnOffShower()">Matikan</button>
                        </div>
                    </div>
                    <div class="shower-card loading">
                        <div class="stats">Menghubungkan...</div>
                        <div class="shower-btn">
                            <button>
                                <div class="loader"></div>
                            </button>
                        </div>
                    </div>
                    <div class="shower-card disconnect">
                        <div class="stats">Terputus...</div>
                        <div class="shower-btn">
                            <button>
                                <div class="loader"></div>
                            </button>
                        </div>
                    </div>
                </div>
            @endcan
            <div class="history-container">
                <div class="head">
                    <div class="title">Riwayat Penyiraman</div>
                    <button class="refresh active" onclick="refreshShowerHistory()">
                        <i data-feather="refresh-ccw" style="stroke: #d9d9d9; width: 16px"></i>
                    </button>
                </div>
                <div class="card-history-container" id="card-history">

                </div>
            </div>
            <div class="just-dump" style="height: 1200px"></div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
