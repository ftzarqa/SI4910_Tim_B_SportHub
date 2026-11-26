@extends('layouts.app')
@section('title', 'Edit Lapangan - SportHub')
@section('content')
<style>
    .form-wrapper {
        max-width: 750px;
        margin: 10px auto;
    }
    .form-header {
        margin-bottom: 25px;
    }
    .form-header h1 {
        color: #1E293B;
        font-size: 26px;
        font-weight: 800;
        margin: 0 0 8px;
    }
    .form-header p {
        color: #475569;
        font-size: 14px;
        margin: 0;
    }
    .form-card {
        background: white;
        padding: 30px;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(12, 35, 64, 0.05);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #1E293B;
        font-size: 13px;
        font-weight: 700;
    }
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        background: white;
        color: #1E293B;
        font-family: inherit;
        font-size: 13px;
        box-sizing: border-box;
    }
    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #009B5D;
        box-shadow: 0 0 0 3px rgba(0, 155, 93, 0.1);
    }
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #E2E8F0;
    }
    .btn-save {
        background: #009B5D;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-family: inherit;
        font-weight: 700;
        cursor: pointer;
        font-size: 13px;
    }
    .btn-save:hover {
        background: #007F4B;
    }
    .btn-back {
        background: #E6F2F8;
        color: #0C2340;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
    }
    @media (max-width: 600px) {
        .form-card { padding: 20px; }
        .form-actions { flex-direction: column; }
        .form-actions a, .form-actions button { text-align: center; }
    }
</style>
<div class="form-wrapper">
    <div class="form-header">
        <h1>Edit Data Lapangan</h1>
        <p>Perbarui informasi lapangan olahraga yang sudah terdaftar.</p>
    </div>
    <div class="form-card">
        <form action="{{ route('lapangan.update', $lapangan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Lapangan</label>
                <input type="text" name="nama_lapangan"
                    value="{{ $lapangan->nama_lapangan }}" required>
            </div>
            <div class="form-group">
                <label>Jenis Olahraga</label>
                <select name="jenis_olahraga" required>
                    <option value="Futsal" {{ $lapangan->jenis_olahraga == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                    <option value="Basket" {{ $lapangan->jenis_olahraga == 'Basket' ? 'selected' : '' }}>Basket</option>
                    <option value="Badminton" {{ $lapangan->jenis_olahraga == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                    <option value="Voli" {{ $lapangan->jenis_olahraga == 'Voli' ? 'selected' : '' }}>Voli</option>
                </select>
            </div>
            <div class="form-group">
                <label>Jenis Lantai</label>
                <select name="jenis_lantai" required>
                    <option value="Vinyl" {{ $lapangan->jenis_lantai == 'Vinyl' ? 'selected' : '' }}>Vinyl</option>
                    <option value="Rumput Sintetis" {{ $lapangan->jenis_lantai == 'Rumput Sintetis' ? 'selected' : '' }}>Rumput Sintetis</option>
                    <option value="Semen" {{ $lapangan->jenis_lantai == 'Semen' ? 'selected' : '' }}>Semen</option>
                    <option value="Kayu" {{ $lapangan->jenis_lantai == 'Kayu' ? 'selected' : '' }}>Kayu</option>
                </select>
            </div>
            <div class="form-group">
                <label>Ukuran</label>
                <input type="text" name="ukuran"
                    value="{{ $lapangan->ukuran }}" required>
            </div>
            <div class="form-group">
                <label>Status Fisik</label>
                <select name="status_fisik" required>
                    <option value="Baik" {{ $lapangan->status_fisik == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Perlu Perbaikan" {{ $lapangan->status_fisik == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                    <option value="Rusak" {{ $lapangan->status_fisik == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-save">Simpan Perubahan</button>
                <a href="{{ route('lapangan.index') }}" class="btn-back">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
