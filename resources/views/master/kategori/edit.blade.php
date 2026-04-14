@extends('layouts.app')

@section('title', 'Edit Kategori - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="fas fa-edit"></i> Edit Kategori
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kategori.update', $kategori->kodeKategori) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="namaKategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control @error('namaKategori') is-invalid @enderror"
                               id="namaKategori" name="namaKategori" placeholder="Masukkan nama kategori"
                               value="{{ old('namaKategori', $kategori->namaKategori) }}" required>
                        @error('namaKategori')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('kategori.index') }}" class="btn btn-light">
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
