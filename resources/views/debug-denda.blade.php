@extends('layouts.app')

@section('title', 'Debug Denda - DigiLib')

@section('content')
<div class="container">
    <h2>Debug Denda Calculation</h2>
    
    <div class="alert alert-info">
        <strong>Waktu Sekarang:</strong> {{ now()->format('Y-m-d H:i:s') }}
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5>SEMUA Pinjam (Tanpa Filter Status)</h5>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Terlambat?</th>
                        <th>Denda (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $all_pinjams = \App\Models\Pinjam::all();
                        $sekarang = now();
                    @endphp
                    @if($all_pinjams->count() > 0)
                        @foreach($all_pinjams as $pinjam)
                            @php
                                $tgl_kembali = \Carbon\Carbon::parse($pinjam->tglKembali);
                                $is_terlambat = $tgl_kembali < $sekarang;
                                $hari_terlambat = $is_terlambat ? $sekarang->diffInDays($tgl_kembali) : 0;
                                $denda = $is_terlambat ? $hari_terlambat * 500 : 0;
                            @endphp
                            <tr class="{{ $is_terlambat ? 'table-danger' : 'table-light' }}">
                                <td><strong>{{ $pinjam->kodePinjam }}</strong></td>
                                <td>{{ \Carbon\Carbon::parse($pinjam->tglPinjam)->format('Y-m-d H:i') }}</td>
                                <td>{{ $tgl_kembali->format('Y-m-d H:i') }}</td>
                                <td>
                                    <span class="badge bg-{{ $pinjam->status == 1 ? 'primary' : ($pinjam->status == 2 ? 'warning' : 'secondary') }}">
                                        {{ $pinjam->status }}
                                    </span>
                                </td>
                                <td class="{{ $is_terlambat ? 'fw-bold text-danger' : 'text-success' }}">
                                    {{ $is_terlambat ? '✓ YA (' . $hari_terlambat . ' hari)' : '✗ TIDAK' }}
                                </td>
                                <td class="fw-bold">
                                    {{ $denda > 0 ? 'Rp ' . number_format($denda, 0, ',', '.') : '-' }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                <strong>❌ TIDAK ADA DATA PINJAM DI DATABASE!</strong>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Pinjam dengan Status 1 atau 2 SAJA</h5>
        </div>
        <div class="card-body">
            @php
                $pinjams_status_12 = \App\Models\Pinjam::whereIn('status', [1, 2])->get();
            @endphp
            <p><strong>Total ditemukan: {{ $pinjams_status_12->count() }} pinjam</strong></p>
            
            @if($pinjams_status_12->count() > 0)
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Terlambat?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pinjams_status_12 as $p)
                            @php
                                $tk = \Carbon\Carbon::parse($p->tglKembali);
                                $late = $tk < $sekarang;
                            @endphp
                            <tr class="{{ $late ? 'table-danger' : '' }}">
                                <td>{{ $p->kodePinjam }}</td>
                                <td>{{ $tk->format('Y-m-d H:i') }}</td>
                                <td>{{ $p->status }}</td>
                                <td>{{ $late ? '✓ YA' : '✗ TIDAK' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-warning"><strong>⚠️ TIDAK ADA PINJAM DENGAN STATUS 1 ATAU 2</strong></p>
            @endif
        </div>
    </div>
</div>
@endsection
