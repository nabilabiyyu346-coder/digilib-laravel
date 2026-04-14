@extends('layouts.app')

@section('title', 'Proses Peminjaman - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="fas fa-plus"></i> Proses Peminjaman Buku
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pinjam.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="tipePeminjam" class="form-label">Pilih Peminjam</label>
                        <select class="form-select @error('kodePeminjam') is-invalid @enderror"
                                id="kodePeminjam" name="kodePeminjam" required>
                            <option value="">-- Pilih Peminjam --</option>
                            @if($dosens->count() > 0)
                                <optgroup label="Dosen">
                                    @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->kodeDosen }}" data-type="1"
                                                {{ old('kodePeminjam') == $dosen->kodeDosen ? 'selected' : '' }}>
                                            {{ $dosen->nama }} ({{ $dosen->kodeDosen }})
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endif
                            @if($mahasiswas->count() > 0)
                                <optgroup label="Mahasiswa">
                                    @foreach($mahasiswas as $mahasiswa)
                                        <option value="{{ $mahasiswa->kodeMhs }}" data-type="2"
                                                {{ old('kodePeminjam') == $mahasiswa->kodeMhs ? 'selected' : '' }}>
                                            {{ $mahasiswa->nama }} ({{ $mahasiswa->kodeMhs }})
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endif
                        </select>
                        @error('kodePeminjam')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" id="tipePeminjam" name="tipePeminjam" value="">

                    <script>
                        document.getElementById('kodePeminjam').addEventListener('change', function() {
                            const selected = this.options[this.selectedIndex];
                            const tipePeminjam = selected.getAttribute('data-type') || '';
                            document.getElementById('tipePeminjam').value = tipePeminjam;
                        });
                    </script>

                    <div class="mb-3">
                        <label for="buku_ids" class="form-label">Pilih Buku (Max 2 Buku)</label>
                        <div class="border p-3" style="max-height: 300px; overflow-y: auto;">
                            @if($bukus->count() > 0)
                                @foreach($bukus as $buku)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="buku_ids[]"
                                               value="{{ $buku->kodeBuku }}" id="buku_{{ $buku->kodeBuku }}"
                                               {{ in_array($buku->kodeBuku, old('buku_ids', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="buku_{{ $buku->kodeBuku }}">
                                            <strong>{{ $buku->judul }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                {{ $buku->pengarang?->nama ?? '-' }} | {{ $buku->penerbit?->nama ?? '-' }}
                                            </small>
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning mb-0">
                                    Tidak ada buku yang tersedia untuk dipinjam
                                </div>
                            @endif
                        </div>
                        @error('buku_ids')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('pinjam.index') }}" class="btn btn-light">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Proses Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
