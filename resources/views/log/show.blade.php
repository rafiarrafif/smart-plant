@php
    use Carbon\Carbon;
@endphp

@extends('log.layouts.header')

@section('content')
    <div class="container">
        <div class="fixed-content">
            <div class="back-btn" onclick="backPage()">
                <i data-feather="chevron-left" style="stroke: #b0a1fe"></i>
            </div>
            <div class="title-fixed">
                <span>Detail Jejak</span>
            </div>
        </div>
        <div class="main-show-content">
            <div class="title">{{ $loging->title }}</div>
            <div class="date">
                {{ Carbon::parse($loging->created_at)->isoFormat('D MMMM YYYY') }}&nbsp;&nbsp;&nbsp;{{ Carbon::parse($loging->created_at)->isoFormat('HH:mm:ss') }}
            </div>
            <hr class="separator">
            <div class="description">{{ $loging->description }}</div>
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
