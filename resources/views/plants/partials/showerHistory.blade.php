@php
    use Carbon\carbon;
@endphp

@foreach ($history->showerHistory as $data)
    <a href="{{ route('shower.history.show', ['shower' => $data->id]) }}" class="card-history">
        <div class="top">
            <div class="user-action-shower">
                {{ ucfirst($data->activatedBy->name ?? 'SYSTEM') }}
            </div>
            <div class="time">
                {{ Carbon::parse($data->created_at)->diffForHumans() }}
            </div>
        </div>
        <div class="bottom">
            @if ($data->is_active == true)
                <div class="shower-title">
                    Penyiraman masih berlangsung
                </div>
            @else
                <div class="shower-title">
                    Penyiraman selama {{ $data->shower_diff }}
                </div>
            @endif
        </div>
    </a>
@endforeach
