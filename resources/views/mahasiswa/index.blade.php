@extends('layouts.app')

@section('title', 'Mahasiswa - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>
            <i class="fas fa-graduation-cap"></i> Manajemen Mahasiswa
        </h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Mahasiswa
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('mahasiswa.index') }}" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama, username, email, atau jurusan..." value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-primary w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if(isset($search) && $search)
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-secondary w-100 mt-2">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($mahasiswas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $mahasiswa)
                            <tr>
                                <td><strong>{{ $mahasiswa->kodeMhs }}</strong></td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $mahasiswa->username }}</td>
                                <td>{{ $mahasiswa->email ?? '-' }}</td>
                                <td>{{ $mahasiswa->jurusan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('mahasiswa.edit', $mahasiswa->kodeMhs) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('mahasiswa.destroy', $mahasiswa->kodeMhs) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $mahasiswas->links() }}
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle"></i> Belum ada data mahasiswa
            </div>
        @endif
    </div>
</div>
@endsection
