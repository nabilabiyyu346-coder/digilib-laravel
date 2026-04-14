@extends('layouts.app')

@section('title', 'Tambah Pengarang - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="fas fa-plus"></i> Tambah Pengarang
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pengarang.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pengarang</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                               id="nama" name="nama" placeholder="Masukkan nama pengarang"
                               value="{{ old('nama') }}" required>
                        @error('nama')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('pengarang.index') }}" class="btn btn-light">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
