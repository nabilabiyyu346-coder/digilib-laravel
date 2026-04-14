@extends('layouts.app')

@section('title', 'Laporan Peminjaman - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="fas fa-file-alt"></i> Laporan Peminjaman
        </h2>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('laporan.peminjaman') }}" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kode pinjam atau kode peminjam..." value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-primary w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if(isset($search) && $search)
                    <a href="{{ route('laporan.peminjaman') }}" class="btn btn-sm btn-secondary w-100 mt-2">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($pinjams->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Pinjam</th>
                            <th>Peminjam</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Jumlah Buku</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pinjams as $pinjam)
                            <tr>
                                <td>{{ $pinjam->kodePinjam }}</td>
                                <td>{{ ['', 'Dosen', 'Mahasiswa', 'Umum'][$pinjam->tipePeminjam] ?? '-' }} #{{ $pinjam->kodePeminjam }}</td>
                                <td>
                                    @if($pinjam->tglPinjam instanceof \Carbon\Carbon)
                                        {{ $pinjam->tglPinjam->format('d-m-Y H:i') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($pinjam->tglPinjam)->format('d-m-Y H:i') }}
                                    @endif
                                </td>
                                <td>
                                    @if($pinjam->tglKembali instanceof \Carbon\Carbon)
                                        {{ $pinjam->tglKembali->format('d-m-Y H:i') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($pinjam->tglKembali)->format('d-m-Y H:i') }}
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $pinjam->pinjamDetails->count() }} buku
                                    </span>
                                </td>
                                <td>
                                    @if($pinjam->status == 1)
                                        @if($pinjam->tglKembali < now())
                                            <span class="badge bg-danger">Terlambat</span>
                                        @else
                                            <span class="badge bg-success">Aktif</span>
                                        @endif
                                    @elseif($pinjam->status == 2)
                                        <span class="badge bg-warning">Terlambat</span>
                                    @else
                                        <span class="badge bg-secondary">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle"></i> Belum ada data peminjaman
            </div>
        @endif
    </div>
</div>
@endsection
