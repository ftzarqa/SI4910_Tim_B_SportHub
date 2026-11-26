@extends('layouts.app')
@section('title', 'Lapangan & Area - SportHub')
@section('content')
<style>
    .welcome { background:linear-gradient(120deg,#65C14A,#39A845); color:white; padding:25px; border-radius:15px; margin-bottom:22px; }
    .welcome h1 { margin:0 0 8px; font-size:26px; }
    .welcome p { margin:0; color:#f0ffe9; }
    .stats { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin-top:22px; }
    .stat-card { background:white; color:#1E293B; padding:15px; border-radius:11px; }
    .stat-card p { margin:0 0 7px; color:#64748B; font-size:12px; }
    .stat-card h2 { margin:0; font-size:24px; }
    .filter-box,.data-box { background:white; border:1px solid #E2E8F0; border-radius:13px; padding:20px; margin-bottom:20px; }
    .filter-box { background:#E6F2F8; display:flex; gap:12px; flex-wrap:wrap; }
    .search-input,.filter-select { padding:11px 15px; border:1px solid #CBD5E1; border-radius:25px; background:white; }
    .search-input { flex:1; min-width:180px; }
    .btn-add,.btn-view { padding:11px 17px; border:0; border-radius:25px; background:#009B5D; color:white; text-decoration:none; cursor:pointer; font-weight:bold; }
    .btn-view { background:#E2E8F0; color:#334155; }
    .btn-view.active { background:#009B5D; color:white; }
    .cards { display:grid; grid-template-columns:repeat(3,1fr); gap:15px; }
    .lapangan-card { border:1px solid #E2E8F0; border-radius:12px; padding:17px; }
    .lapangan-card h3 { margin:0 0 12px; }
    .lapangan-card p { font-size:13px; color:#475569; }
    .status { display:inline-block; padding:5px 10px; border-radius:20px; font-size:11px; font-weight:bold; }
    .baik { background:#DCFCE7; color:#15803D; }
    .perbaikan { background:#FEF3C7; color:#B45309; }
    .rusak { background:#FEE2E2; color:#B91C1C; }
    .btn-edit { color:#009B5D; text-decoration:none; font-weight:bold; }
    .btn-delete { background:#DC2626; color:white; border:0; padding:6px 10px; border-radius:6px; cursor:pointer; }
    .actions { display:flex; align-items:center; gap:12px; }
    .table-scroll { overflow-x:auto; }
    table { width:100%; border-collapse:collapse; min-width:650px; }
    th,td { padding:13px; text-align:left; border-bottom:1px solid #E2E8F0; }
    th { background:#F8FAFC; color:#475569; font-size:12px; }
    td { font-size:13px; }
    @media(max-width:750px) { .stats { grid-template-columns:repeat(2,1fr); } .cards { grid-template-columns:1fr; } }
</style>
<div class="welcome">
    <h1>Manajemen Lapangan & Area</h1>
    <p>Kelola data dan kondisi fasilitas olahraga SportHub.</p>
    <div class="stats">
        <div class="stat-card"><p>Total Lapangan</p><h2>{{ $lapangans->count() }}</h2></div>
        <div class="stat-card"><p>Kondisi Baik</p><h2>{{ $lapangans->where('status_fisik','Baik')->count() }}</h2></div>
        <div class="stat-card"><p>Perlu Perbaikan</p><h2>{{ $lapangans->where('status_fisik','Perlu Perbaikan')->count() }}</h2></div>
        <div class="stat-card"><p>Kondisi Rusak</p><h2>{{ $lapangans->where('status_fisik','Rusak')->count() }}</h2></div>
    </div>
</div>
<div class="filter-box">
    <input type="text" id="searchLapangan" class="search-input" placeholder="Cari nama lapangan...">
    <select id="filterStatus" class="filter-select">
        <option value="">Semua Status</option>
        <option>Baik</option>
        <option>Perlu Perbaikan</option>
        <option>Rusak</option>
    </select>
    @if(auth()->user()->role == 'admin')
        <a href="{{ route('lapangan.create') }}" class="btn-add">+ Tambah Lapangan</a>
    @endif
</div>
<div class="data-box">
    <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <h2>Daftar Data Lapangan</h2>
        <div>
            <button class="btn-view active" id="btnGrid" onclick="ubahTampilan('grid')">Grid Kartu</button>
            <button class="btn-view" id="btnTable" onclick="ubahTampilan('table')">Tabel Modern</button>
        </div>
    </div>
    <div class="cards" id="gridLapangan">
        @forelse($lapangans as $lapangan)
            <div class="lapangan-card lapangan-item" data-status="{{ $lapangan->status_fisik }}">
                <h3>{{ $lapangan->nama_lapangan }}</h3>
                <p>Olahraga: {{ $lapangan->jenis_olahraga }}</p>
                <p>Jenis Lantai: {{ $lapangan->jenis_lantai }}</p>
                <p>Ukuran: {{ $lapangan->ukuran }}</p>
                <p>Status: <span class="status {{ $lapangan->status_fisik == 'Baik' ? 'baik' : ($lapangan->status_fisik == 'Perlu Perbaikan' ? 'perbaikan' : 'rusak') }}">{{ $lapangan->status_fisik }}</span></p>
                @if(auth()->user()->role == 'admin')
                    <div class="actions">
                        <a href="{{ route('lapangan.edit',$lapangan->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('lapangan.destroy',$lapangan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete">Hapus</button>
                        </form>
                    </div>
                @endif
            </div>
        @empty
            <p>Belum ada data lapangan.</p>
        @endforelse
    </div>
    <div class="table-scroll" id="tableLapangan" style="display:none;">
        <table>
            <thead>
                <tr>
                    <th>Nama Lapangan</th>
                    <th>Jenis Olahraga</th>
                    <th>Jenis Lantai</th>
                    <th>Ukuran</th>
                    <th>Status Fisik</th>
                    @if(auth()->user()->role == 'admin')
                    <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($lapangans as $lapangan)
                    <tr class="lapangan-item" data-status="{{ $lapangan->status_fisik }}">
                        <td>{{ $lapangan->nama_lapangan }}</td>
                        <td>{{ $lapangan->jenis_olahraga }}</td>
                        <td>{{ $lapangan->jenis_lantai }}</td>
                        <td>{{ $lapangan->ukuran }}</td>
                        <td>{{ $lapangan->status_fisik }}</td>
                @if(auth()->user()->role == 'admin')
                    <td class="actions">
                        <a href="{{ route('lapangan.edit',$lapangan->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('lapangan.destroy',$lapangan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete">Hapus</button>
                        </form>
                    </td>
                @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role == 'admin' ? 6 : 5 }}">Belum ada data lapangan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<script>
    function ubahTampilan(tampilan) {
        document.getElementById('gridLapangan').style.display = tampilan == 'grid' ? 'grid' : 'none';
        document.getElementById('tableLapangan').style.display = tampilan == 'table' ? 'block' : 'none';
        document.getElementById('btnGrid').classList.toggle('active', tampilan == 'grid');
        document.getElementById('btnTable').classList.toggle('active', tampilan == 'table');
    }
    function filterLapangan() {
        let keyword = document.getElementById('searchLapangan').value.toLowerCase();
        let status = document.getElementById('filterStatus').value;
        document.querySelectorAll('.lapangan-item').forEach(item => {
            let cocokNama = item.innerText.toLowerCase().includes(keyword);
            let cocokStatus = status == '' || item.dataset.status == status;
            item.style.display = cocokNama && cocokStatus ? '' : 'none';
        });
    }
    document.getElementById('searchLapangan').addEventListener('input', filterLapangan);
    document.getElementById('filterStatus').addEventListener('change', filterLapangan);
</script>
@endsection
<Acr</Acr>
