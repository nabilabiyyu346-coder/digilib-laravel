@extends('layouts.app')

@section('title', 'Laporan Denda - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="fas fa-file-alt"></i> Laporan Denda Keterlambatan
        </h2>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('laporan.denda') }}" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kode pinjam atau kode peminjam..." value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-primary w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if(isset($search) && $search)
                    <a href="{{ route('laporan.denda') }}" class="btn btn-sm btn-secondary w-100 mt-2">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($daftar_denda)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Pinjam</th>
                            <th>Peminjam</th>
                            <th>Tgl Seharusnya Kembali</th>
                            <th>Status</th>
                            <th>Denda (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($daftar_denda as $denda)
                            <tr>
                                <td>{{ $denda['kodePinjam'] }}</td>
                                <td>{{ $denda['peminjam'] }}</td>
                                <td>
                                    @if($denda['tglKembali'] instanceof \Carbon\Carbon)
                                        {{ $denda['tglKembali']->format('d-m-Y H:i') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($denda['tglKembali'])->format('d-m-Y H:i') }}
                                    @endif
                                </td>
                                <td>
                                    <span>{{ $denda['statusPinjam'] ?? 'Terlambat' }}</span>
                                </td>
                                <td><strong>Rp {{ number_format($denda['denda'], 0, ',', '.') }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle"></i> Tidak ada denda keterlambatan
            </div>
        @endif
    </div>
</div>
@endsection
