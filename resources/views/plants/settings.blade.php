@php
    use Carbon\Carbon;
@endphp

@extends('plants.layouts.settings')

@section('content')
    <div class="fixed-header">
        <div class="back-btn" onclick="backPage()">
            <i data-feather="chevron-left" style="stroke: #b0a1fe"></i>
        </div>
        <div class="title-plant">
            <span>Pengaturan {{ $plant->name }}</span>
        </div>
        <div class="del-btn" onclick="deletePlant()">
            <i data-feather="trash-2" style="stroke: #b0a1fe;"></i>
        </div>
    </div>
    <form action="{{ route('plant.destroy', ['plant' => $plant->slug]) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="popup-container">
            <div class="popup-content">
                <div class="title">
                    <h1>Yakin?</h1>
                </div>
                <div class="sub-title">
                    <p>Riwayat penyiraman dan semua data terkait akan ikut dihapus</p>
                </div>
                <div class="action-btn">
                    <div class="cancel-btn popup-btn">
                        <button type="button" onclick="cancelDeletePlant()">Batal</button>
                    </div>
                    <div class="confirm-btn popup-btn">
                        <button type="submit">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="main-content">
        <form action="{{ route('plant.update', ['plant' => $plant->slug]) }}" method="post" id="settings-form">
            @csrf
            @method('PUT')
            {{-- <div class="settings-item-container">
                <div class="setting-input-area">
                    <div class="settings-name">
                        <label for="timer">Max Durasi Siram</label>
                    </div>
                    <div class="settings-value">
                        <input name="timer" id="timer" type="number" min="1" max="60">
                        <div class="satuan">&nbsp;&nbsp;dtk</div>
                    </div>
                </div>
                <div class="setting-input-area">
                    <div class="settings-name">
                        <label for="limit_type">Tipe Limit Penyiraman</label>
                    </div>
                    <div class="settings-value">
                        <input name="limit_type" id="limit_type" type="number" min="1" max="60"
                            style="margin: 0 34px 0 0;">
                    </div>
                </div>
                <div class="setting-input-area">
                    <div class="settings-name">
                        <label for="limit_value">Value Limit Penyiraman</label>
                    </div>
                    <div class="settings-value">
                        <input name="limit_value" id="limit_value" type="number" min="1" max="60">
                        <div class="satuan" style="margin: 0 13px 0 0;">&nbsp;&nbsp;%</div>
                    </div>
                </div>
            </div> --}}
            <div class="automatic-shower-container" id="basic_info">
                @foreach ($errors->all() as $message)
                    {{ $message }}
                @endforeach
                <div class="head">
                    <div class="title">Informasi Identitas</div>
                    <div class="switch"></div>
                </div>
                <div class="control-content basic-info" style="margin: 10px 0 0; display: none;">
                    <div class="label">
                        <label for="plant_name">Nama Tanaman</label>
                    </div>
                    <div class="value">
                        <input type="text" name="plant_name" id="plant_name" value="{{ $plant->name }}">
                    </div>
                </div>
                <div class="control-content basic-info" style="margin: 10px 0 0; display: none;">
                    <div class="label">
                        <label for="keystream">API Key</label>
                    </div>
                    <div class="keystream">
                        <div class="value">
                            <input type="text" name="keystream" id="keystream" value="{{ $plant->keystream }}">
                        </div>
                        <button class="icon" onclick="generateToken(12)" type="button">
                            <i data-feather="refresh-cw" style="stroke: #c8c8c8;width: 18px"></i>
                        </button>
                    </div>
                </div>
                <div class="control-content basic-info desc-info" style="display: none;">
                    <div class="label">
                        <label for="description">Deskripsi</label>
                    </div>
                    <div class="value">
                        <textarea name="description" id="description" cols="30" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="automatic-shower-container" id="settings_container">
                <div class="head">
                    <div class="title">Limitasi Penyiraman</div>
                    <div class="switch">
                        <input type="checkbox" name="settings_prefered" id="settings_prefered"
                            {{ $plant->is_settings_prefer > 0 ? 'checked' : '' }} />
                        <label for="settings_prefered">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="control-content settings-content" style="margin: 10px 0 0; display: none;">
                    <div class="label">
                        <label for="settings_type">Titik Batasan Penyiraman</label>
                    </div>
                    <div class="value select-container">
                        <select name="settings_type" id="settings_type">
                            <option value="soil" {{ $plant->settings_type_off == 'soil' ? 'selected' : '' }}>Kelembapan
                                Tanah</option>
                            <option value="air" {{ $plant->settings_type_off == 'air' ? 'selected' : '' }}>Kelembapan
                                Udara</option>
                            <option value="temp" {{ $plant->settings_type_off == 'temp' ? 'selected' : '' }}>Suhu Sekitar
                            </option>
                        </select>
                        <i data-feather="chevron-down" class="icc" style="width: 16px"></i>
                    </div>
                </div>
                <div class="control-content settings-content" style="margin: 10px 0 0; display: none;">
                    <div class="label">
                        <label for="settings_value">Value Batasan Penyiraman <span>(Celcius)</span></label>
                    </div>
                    <div class="value">
                        <input type="number" name="settings_value" id="settings_value"
                            value="{{ $plant->settings_value_off }}">
                    </div>
                </div>
                <div class="control-content settings-content" style="margin: 10px 0 12px; display: none;">
                    <div class="label">
                        <label for="settings_max_shower">Durasi max penyiraman (detik)</label>
                    </div>
                    <div class="value">
                        <input type="number" name="settings_max_shower" id="settings_max_shower"
                            value="{{ $plant->settings_timer_max }}">
                    </div>
                </div>
            </div>
            <div class="automatic-shower-container" id="shower_container">
                <div class="head">
                    <div class="title">Siram Otomatis</div>
                    <div class="switch">
                        <input type="checkbox" name="auto_shower" id="auto_shower"
                            {{ $plant->auto_shower_status > 0 ? 'checked' : '' }} />
                        <label for="auto_shower">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="control-content shower-content" style="margin: 10px 0 0; display: none;">
                    <div class="label">
                        <label for="start_auto">Penyiraman dimulai pada</label>
                    </div>
                    <div class="value">
                        <input type="time" name="start_auto" id="start_auto"
                            value="{{ Carbon::parse($plant->auto_shower_time)->format('H:i') }}" required>
                    </div>
                </div>
                <div class="control-content shower-content" style="margin: 10px 0 12px; display: none;">
                    <div class="label">
                        <label for="stop_auto">Durasi penyiraman (detik)</label>
                    </div>
                    <div class="value">
                        <input type="number" name="stop_auto" id="stop_auto" value="{{ $plant->auto_shower_timer }}"
                            required>
                    </div>
                </div>
            </div>
            <div class="alert-shower-impact" style="display: none">
                <div class="alert-impact-container">
                    <div class="icon">
                        <i data-feather="alert-triangle" style="width: 16px; stroke: #b80f0a"></i>
                    </div>
                    <div class="text">
                        <p>Penyiraman otomatis tidak akan dijalankan jika kondisi tanaman telah melebihi value dari
                            limitasi penyiraman</p>
                    </div>
                </div>
            </div>
            <div class="submit-btn">
                <button type="submit" id="submit-btn">Simpan</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function generateToken(length) {
            var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            var result = "";
            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * charset.length);
                result += charset[randomIndex];
            }

            $('#keystream').val(result);
        }


        function deletePlant() {
            $('.popup-container').fadeIn().css('display', 'flex');
        }

        function cancelDeletePlant() {
            $('.popup-container').fadeOut();
        }

        function backPage() {
            window.history.back();
        }

        function selectOption() {
            var selectedValue = $('#settings_type').val();
            switch (selectedValue) {
                case 'soil':
                    $('.label label span').text('(Max. 4095)');
                    break;
                case 'air':
                    $('.label label span').text('(%)');
                    break;
                case 'temp':
                    $('.label label span').text('(℃)');
                    break;
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#description').val('{{ $plant->notes }}')

            selectOption();
            checkImpact();
            showerAutoScreen();
            settingsPreferedScreen();
            $('#settings_type').change(function() {
                selectOption();
            });
            $('#settings_prefered').change(function() {
                settingsPreferedScreen();
                checkImpact();
            });
            $('#auto_shower').change(function() {
                showerAutoScreen();
                checkImpact();
            });

        });
        $(document).ready(function() {
            $('#settings-form').on('submit', function() {
                var $submitBtn = $('#submit-btn');

                $submitBtn.prop('disabled', true);
                $submitBtn.text('Submitting...');
            });
        });

        function settingsPreferedScreen() {
            if ($('#settings_prefered').is(':checked')) {
                $('#settings_value').attr('required', 'required');
                $('#settings_max_shower').attr('required', 'required').attr('min', '10').attr('max', '120');

                $('#settings_prefered').prop('disabled', true);
                $('#settings_container').addClass('shown');
                setTimeout(() => {
                    $('#settings_prefered').prop('disabled', false);
                    $('.settings-content').fadeIn();

                }, 200);
            } else {
                $('#settings_value').removeAttr('required');
                $('#settings_max_shower').removeAttr('required').removeAttr('max').removeAttr('min');

                $('#settings_prefered').prop('disabled', true);
                $('.settings-content').fadeOut();
                setTimeout(() => {
                    $('#settings_prefered').prop('disabled', false);
                    $('#settings_container').removeClass('shown');
                }, 300);
            }
        }

        function showerAutoScreen() {
            if ($('#auto_shower').is(':checked')) {
                $('#start_auto').attr('required', 'required');
                $('#stop_auto').attr('required', 'required').attr('min', '10').attr('max', '120');

                $('#auto_shower').prop('disabled', true);
                $('#shower_container').addClass('shown');
                setTimeout(() => {
                    $('#auto_shower').prop('disabled', false);
                    $('.shower-content').fadeIn();

                }, 200);
            } else {
                $('#start_auto').removeAttr('required');
                $('#stop_auto').removeAttr('required').removeAttr('max').removeAttr('min');

                $('#auto_shower').prop('disabled', true);
                $('.shower-content').fadeOut();
                setTimeout(() => {
                    $('#auto_shower').prop('disabled', false);
                    $('#shower_container').removeClass('shown');
                }, 300);
            }
        }

        function checkImpact() {
            if ($('#settings_prefered').is(':checked') && $('#auto_shower').is(':checked')) {
                $('.alert-shower-impact').fadeIn();
            } else {
                $('.alert-shower-impact').fadeOut();
            }
        }
    </script>
@endsection
