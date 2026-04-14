@extends('layouts.app')

@section('title', 'Penerbit - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>
            <i class="fas fa-building"></i> Daftar Penerbit
        </h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('penerbit.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Penerbit
        </a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('penerbit.index') }}" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau alamat penerbit..." value="{{ $search }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-primary w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if($search)
                    <a href="{{ route('penerbit.index') }}" class="btn btn-sm btn-secondary w-100 mt-2">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($penerbits->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Penerbit</th>
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penerbits as $penerbit)
                            <tr>
                                <td>{{ $penerbit->kodePenerbit }}</td>
                                <td>{{ $penerbit->nama }}</td>
                                <td>{{ Str::words($penerbit->alamat, 5) }}</td>
                                <td>{{ $penerbit->telp }}</td>
                                <td>{{ $penerbit->email }}</td>
                                <td>
                                    <a href="{{ route('penerbit.edit', $penerbit->kodePenerbit) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('penerbit.destroy', $penerbit->kodePenerbit) }}" 
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
                <i class="fas fa-info-circle"></i> Belum ada data penerbit
            </div>
        @endif
    </div>
</div>
@endsection
