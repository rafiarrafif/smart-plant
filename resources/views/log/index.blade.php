@php
    use Carbon\Carbon;
@endphp

@extends('log.layouts.header')

@section('content')
    <div class="container">
        <div class="title-content">
            <h1>Jejak Aktifitas</h1>
        </div>
    </div>
    <div class="main-content">
        <div class="card-container">
            @foreach ($logs as $log)
                <a href="{{ route('log.show', ['log' => $log->id]) }}" class="card-log">
                    <div class="title">{{ $log->title }}</div>
                    <div class="date">{{ Carbon::parse($log->created_at)->diffForHumans() }}</div>
                </a>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
@endsection
