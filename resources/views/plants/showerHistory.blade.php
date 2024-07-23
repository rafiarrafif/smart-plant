@php
    use Carbon\Carbon;
@endphp

@extends('plants.layouts.showerHistory')

@section('content')
    <div class="fixed-header">
        <div class="back-btn" onclick="backToPlant()">
            <i data-feather="chevron-left" style="stroke: #b0a1fe"></i>
        </div>
        <div class="title-plant">
            <span>Penyiraman {{ $plant }}</span>
        </div>
        <div class="del-btn" onclick="">
            <i data-feather="sliders" style="stroke: #b0a1fe"></i>
        </div>
    </div>
    <div class="main-content">
        <div class="loader-container">
            <div class="loader"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                getData();
            }, 200);
        });

        function backToPlant() {
            window.history.back();
        }

        function getData() {
            $.ajax({
                url: "{{ route('api.shower.history.show', ['shower' => $history->id]) }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $(".main-content").empty().append(data);
                },
                error: function(data) {
                    console.log(data);
                }
            })
        };
    </script>
@endsection
