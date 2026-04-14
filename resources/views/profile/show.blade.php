@extends('layouts.app')

@section('title', 'Profile - DigiLib')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>
            <i class="fas fa-user-circle"></i> Profile
        </h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Profile
        </a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle"></i> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                @if($user->gambar_profil)
                    <img src="{{ asset('storage/' . $user->gambar_profil) }}" 
                         class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                @else
                    <div class="rounded-circle mb-3 d-inline-flex align-items-center justify-content-center" 
                         style="width: 150px; height: 150px; background-color: #e9ecef;">
                        <i class="fas fa-user fa-4x text-muted"></i>
                    </div>
                @endif
                <h5 class="card-title">{{ $user->nama }}</h5>
                <p class="text-muted mb-0">
                    @if(session('user_type') === 'dosen')
                        Dosen
                    @elseif(session('user_type') === 'mahasiswa')
                        Mahasiswa
                    @elseif(session('user_type') === 'petugas')
                        Petugas
                    @endif
                </p>
                <hr>
                <small class="text-muted d-block">ID: {{ $user->uuid }}</small>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Username:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $user->username }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Nama Lengkap:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $user->nama }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tempat Lahir:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $user->tempatLahir ?? '-' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tanggal Lahir:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $user->tanggalLahir ?? '-' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Alamat:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $user->alamat ?? '-' }}
                    </div>
                </div>

                @if(session('user_type') === 'mahasiswa')
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Jurusan:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $user->jurusan ?? '-' }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
