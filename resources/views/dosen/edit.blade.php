@extends('layouts.app')

@section('title', 'Edit Dosen - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="fas fa-edit"></i> Edit Dosen
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('dosen.update', $dosen->kodeDosen) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                               id="nama" name="nama" placeholder="Nama dosen"
                               value="{{ old('nama', $dosen->nama) }}" required>
                        @error('nama')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                       id="username" name="username" placeholder="Username"
                                       value="{{ old('username', $dosen->username) }}" required>
                                @error('username')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password" placeholder="Password baru">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" placeholder="Email"
                                       value="{{ old('email', $dosen->email) }}">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempatLahir') is-invalid @enderror"
                                       id="tempatLahir" name="tempatLahir" placeholder="Tempat lahir"
                                       value="{{ old('tempatLahir', $dosen->tempatLahir) }}">
                                @error('tempatLahir')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggalLahir') is-invalid @enderror"
                                       id="tanggalLahir" name="tanggalLahir"
                                       value="{{ old('tanggalLahir', $dosen->tanggalLahir) }}">
                                @error('tanggalLahir')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror"
                                  id="alamat" name="alamat" placeholder="Alamat" rows="3">{{ old('alamat', $dosen->alamat) }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('dosen.index') }}" class="btn btn-light">
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
