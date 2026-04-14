@extends('layouts.app')

@section('title', 'Katalog Buku - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="fas fa-book"></i> Katalog Buku
        </h2>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('katalog.index') }}" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari judul, pengarang, atau penerbit..." value="{{ $search }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-primary w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if($search)
                    <a href="{{ route('katalog.index') }}" class="btn btn-sm btn-secondary w-100 mt-2">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($bukus->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bukus as $buku)
                            <tr>
                                <td>{{ $buku->kodeBuku }}</td>
                                <td>{{ Str::words($buku->judul, 5) }}</td>
                                <td>{{ $buku->kategori?->namaKategori ?? '-' }}</td>
                                <td>{{ $buku->pengarang?->nama ?? '-' }}</td>
                                <td>{{ $buku->penerbit?->nama ?? '-' }}</td>
                                <td>{{ $buku->tahun }}</td>
                                <td>
                                    <span class="badge {{ $buku->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $buku->stok }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('buku.show', $buku->kodeBuku) }}" 
                                       class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $bukus->links() }}
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle"></i> Belum ada data buku
            </div>
        @endif
    </div>
</div>
@endsection
