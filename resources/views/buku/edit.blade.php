@extends('layouts.app')

@section('title', 'Edit Buku - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="fas fa-edit"></i> Edit Buku
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('buku.update', $buku->kodeBuku) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                               id="judul" name="judul" placeholder="Masukkan judul buku"
                               value="{{ old('judul', $buku->judul) }}" required>
                        @error('judul')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kodeKategori" class="form-label">Kategori</label>
                                <select class="form-select @error('kodeKategori') is-invalid @enderror"
                                        id="kodeKategori" name="kodeKategori" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->kodeKategori }}"
                                            {{ (old('kodeKategori') ?? $buku->kodeKategori) == $kategori->kodeKategori ? 'selected' : '' }}>
                                            {{ $kategori->namaKategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kodeKategori')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kodePengarang" class="form-label">
                                    <i class="fas fa-pen-fancy"></i> Pengarang
                                </label>
                                <div class="input-group mb-2">
                                    <select class="form-select @error('kodePengarang') is-invalid @enderror"
                                            id="kodePengarang" name="kodePengarang">
                                        <option value="">-- Pilih Pengarang --</option>
                                        @foreach($pengarangs as $pengarang)
                                            <option value="{{ $pengarang->kodePengarang }}"
                                                {{ (old('kodePengarang') ?? $buku->kodePengarang) == $pengarang->kodePengarang ? 'selected' : '' }}>
                                                {{ $pengarang->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('kodePengarang')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                                <div class="input-group">
                                    <span class="input-group-text">Baru</span>
                                    <input type="text" class="form-control @error('nama_pengarang_baru') is-invalid @enderror"
                                           id="nama_pengarang_baru" name="nama_pengarang_baru" placeholder="Ketik nama baru..."
                                           value="{{ old('nama_pengarang_baru') }}">
                                </div>
                                @error('nama_pengarang_baru')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kodePenerbit" class="form-label">
                                    <i class="fas fa-building"></i> Penerbit
                                </label>
                                <div class="input-group mb-2">
                                    <select class="form-select @error('kodePenerbit') is-invalid @enderror"
                                            id="kodePenerbit" name="kodePenerbit">
                                        <option value="">-- Pilih Penerbit --</option>
                                        @foreach($penerbits as $penerbit)
                                            <option value="{{ $penerbit->kodePenerbit }}"
                                                {{ (old('kodePenerbit') ?? $buku->kodePenerbit) == $penerbit->kodePenerbit ? 'selected' : '' }}>
                                                {{ $penerbit->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('kodePenerbit')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                                <div class="input-group">
                                    <span class="input-group-text">Baru</span>
                                    <input type="text" class="form-control @error('nama_penerbit_baru') is-invalid @enderror"
                                           id="nama_penerbit_baru" name="nama_penerbit_baru" placeholder="Ketik nama baru..."
                                           value="{{ old('nama_penerbit_baru') }}">
                                </div>
                                @error('nama_penerbit_baru')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun Terbit</label>
                                <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                                       id="tahun" name="tahun" placeholder="YYYY"
                                       value="{{ old('tahun', $buku->tahun) }}" required>
                                @error('tahun')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="edisi" class="form-label">Edisi</label>
                                <input type="text" class="form-control @error('edisi') is-invalid @enderror"
                                       id="edisi" name="edisi" placeholder="Edisi"
                                       value="{{ old('edisi', $buku->edisi) }}" required>
                                @error('edisi')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="seri" class="form-label">Seri</label>
                                <input type="text" class="form-control @error('seri') is-invalid @enderror"
                                       id="seri" name="seri" placeholder="Seri (opsional)"
                                       value="{{ old('seri', $buku->seri) }}">
                                @error('seri')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="issn_isbn" class="form-label">ISBN/ISSN</label>
                                <input type="text" class="form-control @error('issn_isbn') is-invalid @enderror"
                                       id="issn_isbn" name="issn_isbn" placeholder="ISBN/ISSN (opsional)"
                                       value="{{ old('issn_isbn', $buku->issn_isbn) }}">
                                @error('issn_isbn')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="abstraksi" class="form-label">Abstraksi/Sinopsis</label>
                        <textarea class="form-control @error('abstraksi') is-invalid @enderror"
                                  id="abstraksi" name="abstraksi" placeholder="Deskripsi buku (opsional)"
                                  rows="4">{{ old('abstraksi', $buku->abstraksi) }}</textarea>
                        @error('abstraksi')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control @error('stok') is-invalid @enderror"
                               id="stok" name="stok" placeholder="Jumlah stok buku"
                               value="{{ old('stok', $buku->stok) }}" required>
                        @error('stok')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('buku.index') }}" class="btn btn-light">
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
