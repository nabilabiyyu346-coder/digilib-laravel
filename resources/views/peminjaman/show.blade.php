@extends('layouts.app')

@section('title', 'Detail Peminjaman - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-9">
        <h2>
            <i class="fas fa-info-circle"></i> Detail Peminjaman
        </h2>
    </div>
    <div class="col-md-3 text-end">
        <a href="{{ route('pinjam.edit', $pinjam->kodePinjam) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('pinjam.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">Informasi Peminjaman</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Kode Pinjam:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $pinjam->kodePinjam }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Peminjam:</strong>
                    </div>
                    <div class="col-md-8">
                        Peminjam #{{ $pinjam->kodePeminjam }} ({{ ['','Dosen','Mahasiswa','Umum'][$pinjam->tipePeminjam] ?? '-' }})
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Petugas:</strong>
                    </div>
                    <div class="col-md-8">
                        Petugas #{{ $pinjam->kodePetugas }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tanggal Pinjam:</strong>
                    </div>
                    <div class="col-md-8">
                        @if($pinjam->tglPinjam instanceof \Carbon\Carbon)
                            {{ $pinjam->tglPinjam->format('d-m-Y H:i') }}
                        @else
                            {{ \Carbon\Carbon::parse($pinjam->tglPinjam)->format('d-m-Y H:i') }}
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tanggal Kembali:</strong>
                    </div>
                    <div class="col-md-8">
                        @if($pinjam->tglKembali instanceof \Carbon\Carbon)
                            {{ $pinjam->tglKembali->format('d-m-Y H:i') }}
                        @else
                            {{ \Carbon\Carbon::parse($pinjam->tglKembali)->format('d-m-Y H:i') }}
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Status:</strong>
                    </div>
                    <div class="col-md-8">
                        @if($pinjam->status == 1)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Selesai</span>
                        @endif
                    </div>
                </div>

                @if($pinjam->keterangan)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Keterangan:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $pinjam->keterangan }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Detail Buku yang Dipinjam</h5>
            </div>
            <div class="card-body">
                @if($pinjam->pinjamDetails->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pinjam->pinjamDetails as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->buku?->judul ?? '-' }}</td>
                                        <td>{{ $detail->buku?->pengarang?->nama ?? '-' }}</td>
                                        <td>{{ $detail->buku?->penerbit?->nama ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle"></i> Tidak ada detail buku
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
