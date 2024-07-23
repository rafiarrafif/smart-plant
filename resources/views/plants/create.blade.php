@extends('plants.layouts.header')

@section('styles')
    <style>
        .main-content {
            margin: 40px 20px 30px;
        }

        .content-form form {
            gap: 12px;
        }

        .form-group {
            gap: 6px;
        }

        @media screen and (max-width: 768px) {
            .submit-btn {
                padding: 12px;
            }
        }

        @media screen and (min-width: 768px) {
            .main-content {
                flex-direction: column;
                margin: 100px 20px 0;
            }

            .content-form {
                display: flex;
                justify-content: center;
            }

            .content-form form {
                width: 400px;
                gap: 12px;
            }

            .header-title h1 {
                font-size: 24px;
            }

            .form-group label {
                font-size: 16px;
            }
        }

        @media screen and (min-width: 968px) {
            .main-content {
                display: flex;
                gap: 0;
            }
        }
    </style>
@endsection

@section('content')
    <div class="main-content">
        <div class="header-title">
            <h1>Tambahkan Tanaman</h1>
        </div>
        <div class="content-form">
            <form action="{{ route('plant.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Tanaman</label>
                    <input type="text" class="form-input" id="name" name="name" maxlength="100" required
                        placeholder="Masukkan nama tanaman">
                </div>
                <div class="form-group">
                    <label for="description">Catatan Tanaman</label>
                    <textarea class="form-input" id="description" name="notes" rows="4" maxlength="255"
                        placeholder="Masukkan deskripsi tanaman"></textarea>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
                <a href="{{ route('home') }}" class="cancel-btn">Batalkan</a>
            </form>
        </div>
    </div>
@endsection
