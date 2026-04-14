@extends('layouts.app')

@section('title', 'Dashboard - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="mb-0">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </h2>
        <small class="text-muted">Selamat datang, {{ session('user_name') }} ({{ ucfirst(session('user_type')) }})</small>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Buku</h6>
                        <h3 class="mb-0">{{ $totalBuku }}</h3>
                    </div>
                    <i class="fas fa-book fa-3x text-primary opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Peminjaman Aktif</h6>
                        <h3 class="mb-0">{{ $peminjamanAktif }}</h3>
                    </div>
                    <i class="fas fa-arrow-right-arrow-left fa-3x text-success opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Peminjaman</h6>
                        <h3 class="mb-0">{{ $totalPeminjaman }}</h3>
                    </div>
                    <i class="fas fa-list fa-3x text-info opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Tipe User</h6>
                        <h3 class="mb-0">{{ ucfirst($userType) }}</h3>
                    </div>
                    <i class="fas fa-user-circle fa-3x text-warning opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('user_type') === 'petugas')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-clock"></i> Peminjaman Terbaru
                </h5>
            </div>
            <div class="card-body">
                @if($recentPinjams->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode Pinjam</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Peminjam</th>
                                    <th>Jumlah Buku</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPinjams as $pinjam)
                                    <tr>
                                        <td>
                                            <a href="{{ route('pinjam.show', $pinjam->kodePinjam) }}">
                                                {{ $pinjam->kodePinjam }}
                                            </a>
                                        </td>
                                        <td>{{ $pinjam->tglPinjam->format('d-m-Y H:i') }}</td>
                                        <td>Peminjam #{{ $pinjam->kodePeminjam }}</td>
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
    </div>
</div>
@endif
@endsection
