@php
    use Carbon\Carbon;
@endphp

@extends('home.layouts.header')

@section('flasher')
    @if (session('success'))
        <div class="flash-message flash-success jq-msg" data-type="success" data-theme="dark" data-timeout="4000"
            data-progress="true">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="flash-message flash-error jq-msg" data-type="error" data-theme="dark" data-timeout="4000"
            data-progress="true">
            {{ session('error') }}</div>
    @endif
@endsection

@section('content')
    <div id="dataset" data-csrf="{{ csrf_token() }}" data-url="{{ route('getDataApi') }}"></div>
    <div class="main-container">
        <div class="grettings">
            <div class="left-content">
                <span>Selamat Datang</span>
                <h3>{{ auth()->user()->name }}</h3>
            </div>
            <div class="right-content">
                <div class="avatar">
                    <img src="{{ auth()->user()->avatar }}">
                </div>
            </div>
        </div>
        <div class="content">
            <div class="plant-container">
                @foreach ($plants as $i => $plant)
                    <a href="{{ route('plant.show', ['plant' => $plant->slug]) }}" class="plant-card"
                        id="plant-{{ $i }}">
                        <div class="title-plant-card">
                            <span>Tanaman {{ $plant->id }}</span>
                            <h3>{{ $plant->name }}</h3>
                        </div>
                        <div class="headlight-plant-card">
                            <div class="air headlight-content">
                                <span class="contain">{{ $plant->air }}</span>
                                <span class="tag">Udara</span>
                            </div>
                            <hr class="scater">
                            <div class="ground headlight-content">
                                <span class="contain">{{ $plant->soil }}</span>
                                <span class="tag">Tanah</span>
                            </div>
                            <hr class="scater">
                            <div class="temperature headlight-content">
                                <span class="contain">{{ intval($plant->temp) }}</span>
                                <span class="tag">Suhu</span>
                            </div>
                        </div>
                        <div class="desc-update">
                            <span
                                class="update-content">{{ $plant->status == 'active' ? 'Terakhir diperbarui ' . Carbon::parse($plant->updated_at)->diffForHumans() : 'Belum pernah terhubung dengan perangkat ESP' }}</span>
                        </div>
                        <div class="plant-status">
                            <div
                                class="status-content success-status {{ $statuses[$i] == 'active' ? 'status-display' : '' }}">
                                <div class="dot"></div>
                                <div class="desc-status">Tersambung</div>
                            </div>
                            <div
                                class="status-content warning-status {{ $statuses[$i] == 'inactive' ? 'status-display' : '' }}">
                                <div class="dot"></div>
                                <div class="desc-status">Terputus</div>
                            </div>
                            <div
                                class="status-content danger-status {{ $statuses[$i] == 'pending' ? 'status-display' : '' }}">
                                <div class="dot"></div>
                                <div class="desc-status">Belum Sinkron</div>
                            </div>
                        </div>
                        <div class="plant-icon">
                            <img src="{{ asset('img/plant_icon.png') }}">
                        </div>
                    </a>
                @endforeach
                @can('admin')
                    <a href="{{ route('plant.create') }}" class="new-plant plant-card">
                        <div class="content-new-plant">
                            <div class="icon-content-new-plant">
                                <img src="{{ asset('img/add_icon.png') }}" loading="lazy">
                            </div>
                            <div class="desc-content-new-plant">
                                <span>Tambahkan Tanaman</span>
                            </div>
                        </div>
                    </a>
                @endcan
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let csrf = $('#dataset').data('csrf');
            let url = $('#dataset').data('url');

            setInterval(() => {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: csrf
                    },
                    success: function(data) {
                        for (var i = 0; i < data.plants.length; i++) {
                            var plantElement = $('#plant-' + i);
                            plantElement.find('.headlight-plant-card').find('.air').find(
                                '.contain').text(data.plants[i].air);
                            plantElement.find('.headlight-plant-card').find('.ground').find(
                                '.contain').text(data.plants[i].soil);
                            plantElement.find('.headlight-plant-card').find('.temperature')
                                .find('.contain').text(data.plants[i].temp);
                            plantElement.find('.desc-update').find('.update-content').text(data
                                .plants[i].updated_at_carbon);
                            plantElement.find(".status-content").removeClass('status-display');

                            switch (data.statuses[i]) {
                                case "active":
                                    plantElement.find(".plant-status").find(".success-status")
                                        .addClass('status-display');
                                    break;
                                case "inactive":
                                    plantElement.find(".plant-status").find(".warning-status")
                                        .addClass('status-display');
                                    break;
                                case "pending":
                                    plantElement.find(".plant-status").find(".danger-status")
                                        .addClass('status-display');
                                    break;
                            }
                        }
                    }
                })
            }, 3000);
        })
    </script>
@endsection
