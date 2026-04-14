@extends('layouts.app')

@section('title', 'Dosen - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>
            <i class="fas fa-chalkboard-user"></i> Manajemen Dosen
        </h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('dosen.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Dosen
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
        <form method="GET" action="{{ route('dosen.index') }}" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama, username, atau email dosen..." value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-primary w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if(isset($search) && $search)
                    <a href="{{ route('dosen.index') }}" class="btn btn-sm btn-secondary w-100 mt-2">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($dosens->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Tempat Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dosens as $dosen)
                            <tr>
                                <td><strong>{{ $dosen->kodeDosen }}</strong></td>
                                <td>{{ $dosen->nama }}</td>
                                <td>{{ $dosen->username }}</td>
                                <td>{{ $dosen->email ?? '-' }}</td>
                                <td>{{ $dosen->tempatLahir ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('dosen.edit', $dosen->kodeDosen) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dosen.destroy', $dosen->kodeDosen) }}" method="POST" style="display:inline;">
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
                {{ $dosens->links() }}
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle"></i> Belum ada data dosen
            </div>
        @endif
    </div>
</div>
@endsection
