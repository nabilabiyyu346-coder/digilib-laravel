@extends('layouts.app')

@section('title', 'Edit Peminjaman - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="fas fa-edit"></i> Edit Peminjaman
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pinjam.update', $pinjam->kodePinjam) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="tglKembali" class="form-label">Tanggal Kembali</label>
                        <input type="datetime-local" class="form-control @error('tglKembali') is-invalid @enderror"
                               id="tglKembali" name="tglKembali"
                               value="{{ old('tglKembali', $pinjam->tglKembali instanceof \Carbon\Carbon ? $pinjam->tglKembali->format('Y-m-d\TH:i') : \Carbon\Carbon::parse($pinjam->tglKembali)->format('Y-m-d\TH:i')) }}" 
                               required>
                        @error('tglKembali')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror"
                                id="status" name="status" required>
                            @if($pinjam->status == 1)
                                <option value="1" selected>Aktif</option>
                                <option value="2">Terlambat</option>
                                <option value="3">Selesai</option>
                            @elseif($pinjam->status == 2)
                                <option value="2" selected>Terlambat</option>
                                <option value="3">Selesai</option>
                            @else
                                <option value="3" selected disabled>Selesai (Tidak bisa diubah)</option>
                            @endif
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('pinjam.index') }}" class="btn btn-light">
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
