@extends('layouts.app')

@section('title', 'Laporan Buku - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="fas fa-file-alt"></i> Laporan Buku
        </h2>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($bukus->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>ISBN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bukus as $buku)
                            <tr>
                                <td>{{ $buku->kodeBuku }}</td>
                                <td>{{ Str::words($buku->judul, 5) }}</td>
                                <td>{{ $buku->kategori?->namaKategori ?? '-' }}</td>
                                <td>{{ $buku->pengarang?->nama ?? '-' }}</td>
                                <td>{{ $buku->penerbit?->nama ?? '-' }}</td>
                                <td>{{ $buku->tahun }}</td>
                                <td>{{ $buku->issn_isbn ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle"></i> Belum ada data buku
            </div>
        @endif
    </div>
</div>
@endsection
