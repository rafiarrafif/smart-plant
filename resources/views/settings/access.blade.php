@extends('settings.layouts.access')

@section('content')
    <div class="header-content">
        <div class="logo-section">
            <img src="{{ asset('img/logo_large.png') }}">
        </div>
        <div class="title-section">
            <h1>Akses Login</h1>
            <p>Berikan akses istimewa kepada user yang mendaftarkan email menggunakan domain tertentu</p>
        </div>
    </div>
    <div class="main-content">
        <div class="form-container">
            <form action="{{ route('settings.access.action') }}" method="POST">
                @csrf
                <div class="input-row">
                    <div class="input-section">
                        <label for="domain_spesial">Domain Spesial</label>
                        <input class="input-box" type="text" name="domain_spesial" id="domain_spesial" required>
                    </div>
                    <div class="input-section">
                        <label for="role_spesial">Peran Spesial</label>
                        <select name="role_special" id="role_special" class="input-box">
                            <option value="admin">Admin</option>
                            <option value="moderator">Moderator</option>
                            <option value="viewer">Viewer</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-section">
                        <label for="role_default">Peran Default</label>
                        <select name="role_default" id="role_default" class="input-box">
                            <option value="admin">Admin</option>
                            <option value="moderator">Moderator</option>
                            <option value="viewer">Viewer</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="dump"></div>
                </div>
                <div class="submit-btn">
                    <button type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
