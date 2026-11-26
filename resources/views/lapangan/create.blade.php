@extends('layouts.app')
@section('title', 'Tambah Lapangan - SportHub')
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
        text-decoration: none;
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
        <h1>Tambah Data Lapangan</h1>
        <p>Lengkapi informasi lapangan olahraga untuk menambahkan data baru.</p>
    </div>
    <div class="form-card">
        <form action="{{ route('lapangan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lapangan</label>
                <input type="text" name="nama_lapangan" placeholder="Masukkan nama lapangan" required>
            </div>
            <div class="form-group">
                <label>Jenis Olahraga</label>
                <select name="jenis_olahraga" required>
                    <option value="">Pilih Olahraga</option>
                    <option value="Futsal">Futsal</option>
                    <option value="Basket">Basket</option>
                    <option value="Badminton">Badminton</option>
                    <option value="Voli">Voli</option>
                </select>
            </div>
            <div class="form-group">
                <label>Jenis Lantai</label>
                <select name="jenis_lantai" required>
                    <option value="">Pilih Jenis Lantai</option>
                    <option value="Vinyl">Vinyl</option>
                    <option value="Rumput Sintetis">Rumput Sintetis</option>
                    <option value="Semen">Semen</option>
                    <option value="Kayu">Kayu</option>
                </select>
            </div>
            <div class="form-group">
                <label>Ukuran</label>
                <input type="text" name="ukuran" placeholder="Contoh: 20 x 40 meter" required>
            </div>
            <div class="form-group">
                <label>Status Fisik</label>
                <select name="status_fisik" required>
                    <option value="">Pilih Status Fisik</option>
                    <option value="Baik">Baik</option>
                    <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-save">Simpan Data</button>
                <a href="{{ route('lapangan.index') }}" class="btn-back">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
