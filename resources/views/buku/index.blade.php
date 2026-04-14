@extends('layouts.app')

@section('title', 'Buku - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>
            <i class="fas fa-book"></i> Daftar Buku
        </h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Buku
        </a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('buku.index') }}" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari judul, pengarang, atau penerbit..." value="{{ $search }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-primary w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if($search)
                    <a href="{{ route('buku.index') }}" class="btn btn-sm btn-secondary w-100 mt-2">
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
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('buku.edit', $buku->kodeBuku) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('buku.destroy', $buku->kodeBuku) }}" 
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle"></i> Belum ada data buku
            </div>
        @endif
    </div>
</div>
@endsection
