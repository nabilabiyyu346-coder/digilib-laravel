@extends('layouts.app')

@section('title', 'Riwayat Peminjaman - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="fas fa-history"></i> Riwayat Peminjaman Saya
        </h2>
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
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Jumlah Buku</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pinjams as $pinjam)
                            <tr>
                                <td>{{ $pinjam->kodePinjam }}</td>
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
                                <td>
                                    <a href="{{ route('pinjam.show', $pinjam->kodePinjam) }}" 
                                       class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle"></i> Belum ada riwayat peminjaman
            </div>
        @endif
    </div>
</div>
@endsection
