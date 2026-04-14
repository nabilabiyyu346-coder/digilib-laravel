@extends('layouts.app')

@section('title', 'Petugas - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>
            <i class="fas fa-user-tie"></i> Manajemen Petugas
        </h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('petugas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Petugas
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
        <form method="GET" action="{{ route('petugas.index') }}" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama, username, atau email petugas..." value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-primary w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if(isset($search) && $search)
                    <a href="{{ route('petugas.index') }}" class="btn btn-sm btn-secondary w-100 mt-2">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($petugas_list->count() > 0)
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
                        @foreach($petugas_list as $p)
                            <tr>
                                <td><strong>{{ $p->kodePetugas }}</strong></td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->username }}</td>
                                <td>{{ $p->email ?? '-' }}</td>
                                <td>{{ $p->tempatLahir ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('petugas.edit', $p->kodePetugas) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('petugas.destroy', $p->kodePetugas) }}" method="POST" style="display:inline;">
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
                {{ $petugas_list->links() }}
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle"></i> Belum ada data petugas
            </div>
        @endif
    </div>
</div>
@endsection
