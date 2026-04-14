@extends('layouts.app')

@section('title', $buku->judul . ' - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-9">
        <h2>
            <i class="fas fa-book"></i> Detail Buku
        </h2>
    </div>
    <div class="col-md-3 text-end">
        @if(session('user_type') === 'petugas')
            <a href="{{ route('buku.edit', $buku->kodeBuku) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('buku.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        @else
            <a href="{{ route('katalog.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Judul:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $buku->judul }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Kategori:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $buku->kategori?->namaKategori ?? '-' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Pengarang:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $buku->pengarang?->nama ?? '-' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Penerbit:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $buku->penerbit?->nama ?? '-' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tahun Terbit:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $buku->tahun }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Edisi:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $buku->edisi }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Stok:</strong>
                    </div>
                    <div class="col-md-8">
                        <span class="badge {{ $buku->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                            {{ $buku->stok }} buku
                        </span>
                    </div>
                </div>

                @if($buku->seri)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Seri:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $buku->seri }}
                        </div>
                    </div>
                @endif

                @if($buku->issn_isbn)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>ISBN/ISSN:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $buku->issn_isbn }}
                        </div>
                    </div>
                @endif

                @if($buku->abstraksi)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Abstraksi:</strong>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $buku->abstraksi }}</p>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <strong>Tanggal Input:</strong>
                    </div>
                    <div class="col-md-8">
                        @if($buku->tglInput)
                            {{ $buku->tglInput instanceof \Carbon\Carbon ? $buku->tglInput->format('d-m-Y H:i') : \Carbon\Carbon::parse($buku->tglInput)->format('d-m-Y H:i') }}
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
