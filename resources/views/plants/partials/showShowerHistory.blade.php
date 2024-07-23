@php
    use Carbon\Carbon;
@endphp

<div class="main-description">
    @if ($history->is_actived_by_system == false && $history->is_deactived_by_system == false)
        <p>Pada tanggal {{ Carbon::parse($history->shower_on)->isoFormat('D MMMM YYYY') }} disaat pukul
            {{ Carbon::parse($history->shower_on)->isoFormat('HH:mm:ss') }} WIB, pengguna dengan nama
            <span>{{ ucfirst($history->activatedBy->name) }}</span> melakukan penyiraman pada tanaman
            {{ $history->plant->name }}. Penyiraman berlangsung selama {{ $history->shower_diff }}, lalu dimatikan pada
            pukul {{ Carbon::parse($history->shower_off)->isoFormat('HH:mm:ss') }} WIB oleh pengguna dengan nama
            <span>{{ ucfirst($history->deactivatedBy->name) }}</span>. Berikut perbedaan data statistik tanaman
            {{ $history->plant->name }} sebelum dan sesudah penyiraman:
        </p>
    @elseif($history->is_actived_by_system == true && $history->is_deactived_by_system == true)
        <p>Pada tanggal {{ Carbon::parse($history->shower_on)->isoFormat('D MMMM YYYY') }} disaat pukul
            {{ Carbon::parse($history->shower_on)->isoFormat('HH:mm:ss') }} WIB,
            <span style="color: #b1a0fd">SISTEM</span> melakukan penyiraman pada
            tanaman
            {{ $history->plant->name }}. Penyiraman berlangsung selama {{ $history->shower_diff }}, lalu dimatikan
            pada
            pukul {{ Carbon::parse($history->shower_off)->isoFormat('HH:mm:ss') }} WIB oleh
            <span style="color: #b1a0fd">SISTEM</span>. Berikut perbedaan data
            statistik tanaman
            {{ $history->plant->name }} sebelum dan sesudah penyiraman:
        </p>
    @elseif($history->is_actived_by_system == false && $history->is_deactived_by_system == true)
        <p>Pada tanggal {{ Carbon::parse($history->shower_on)->isoFormat('D MMMM YYYY') }} disaat pukul
            {{ Carbon::parse($history->shower_on)->isoFormat('HH:mm:ss') }} WIB, pengguna dengan nama
            <span>{{ ucfirst($history->activatedBy->name) }}</span> melakukan penyiraman pada tanaman
            {{ $history->plant->name }}. Penyiraman berlangsung selama {{ $history->shower_diff }}, lalu dimatikan
            pada
            pukul {{ Carbon::parse($history->shower_off)->isoFormat('HH:mm:ss') }} WIB oleh <span
                style="color: #b1a0fd">SISTEM</span>.
            Berikut perbedaan data statistik tanaman
            {{ $history->plant->name }} sebelum dan sesudah penyiraman:
        </p>
    @elseif($history->is_actived_by_system == true && $history->is_deactived_by_system == false)
        <p>Pada tanggal {{ Carbon::parse($history->shower_on)->isoFormat('D MMMM YYYY') }} disaat pukul
            {{ Carbon::parse($history->shower_on)->isoFormat('HH:mm:ss') }} WIB, pengguna dengan nama
            <span style="color: #b1a0fd">SISTEM</span> melakukan penyiraman pada tanaman
            {{ $history->plant->name }}. Penyiraman berlangsung selama {{ $history->shower_diff }}, lalu dimatikan
            pada
            pukul {{ Carbon::parse($history->shower_off)->isoFormat('HH:mm:ss') }} WIB oleh pengguna dengan nama
            <span>{{ ucfirst($history->deactivatedBy->name) }}</span>. Berikut perbedaan data statistik tanaman
            {{ $history->plant->name }} sebelum dan sesudah penyiraman:
        </p>
    @endif
    <div class="table-compare">
        <table>
            <thead>
                <th>Parameter</th>
                <th>Sebelum</th>
                <th>Sesudah</th>
            </thead>
            <tbody>
                <tr>
                    <td>Kelembapan Udara</td>
                    <td>{{ $history->air_before }}%</td>
                    <td>{{ $history->air_after }}%</td>
                </tr>
                <tr>
                    <td>Kelembapan Tanah (%)</td>
                    <td>{{ $history->soil_before_percent }}%</td>
                    <td>{{ $history->soil_after_percent }}%</td>
                </tr>
                <tr>
                    <td>Kelembapan Tanah</td>
                    <td>{{ $history->soil_before }}</td>
                    <td>{{ $history->soil_after }}</td>
                </tr>
                <tr>
                    <td>Suhu Ruangan (°C)</td>
                    <td>{{ $history->temp_before }}</td>
                    <td>{{ $history->temp_after }}</td>
                </tr>
                <tr>
                    <td>Suhu Ruangan (°F)</td>
                    <td>{{ $history->fahrenheit_before }}</td>
                    <td>{{ $history->fahrenheit_after }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p style="margin-top: 22px">Detail singkat tentang penyiraman ini:</p>
    <div class="table-compare table-description">
        <table>
            <tbody>
                <tr>
                    <td>Nama Tanaman</td>
                    <td>{{ $history->plant->name }}</td>
                </tr>
                <tr>
                    <td>Dinyalakan oleh</td>
                    <td>{{ $history->is_actived_by_system == true ? 'SISTEM' : $history->activatedBy->name }}</td>
                </tr>
                <tr>
                    <td>Dimatikan oleh</td>
                    <td>{{ $history->is_deactived_by_system == true ? 'SISTEM' : $history->deactivatedBy->name }}</td>
                </tr>
                <tr>
                    <td>Durasi Penyiraman</td>
                    <td>{{ $history->shower_diff }}</td>
                </tr>
                <tr>
                    <td>Dinyalakan pada</td>
                    <td>{{ Carbon::parse($history->shower_on)->isoFormat('D MMMM YYYY HH:mm:ss') }}</td>
                </tr>
                <tr>
                    <td>Dimatikan pada</td>
                    <td>{{ Carbon::parse($history->shower_on)->isoFormat('D MMMM YYYY HH:mm:ss') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
