<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DigiLib - Digital Library System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-body-bg: #f8f9fa;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .sidebar {
            background: #fff;
            border-right: 1px solid #dee2e6;
            min-height: 100vh;
        }
        .nav-link {
            color: #6c757d;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: #0d6efd;
            background-color: #f8f9fa;
            border-left-color: #0d6efd;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-book"></i> DigiLib
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ session('user_name') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <nav class="nav flex-column p-3">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>

                    @if(session('user_type') === 'petugas')
                        <hr>
                        <h6 class="text-muted px-3 mb-3">Master Data</h6>
                        <a class="nav-link" href="{{ route('kategori.index') }}">
                            <i class="fas fa-tags"></i> Kategori
                        </a>
                        <a class="nav-link" href="{{ route('pengarang.index') }}">
                            <i class="fas fa-pen-fancy"></i> Pengarang
                        </a>
                        <a class="nav-link" href="{{ route('penerbit.index') }}">
                            <i class="fas fa-building"></i> Penerbit
                        </a>
                        <hr>
                        <h6 class="text-muted px-3 mb-3">User Management</h6>
                        <a class="nav-link" href="{{ route('dosen.index') }}">
                            <i class="fas fa-chalkboard-user"></i> Dosen
                        </a>
                        <a class="nav-link" href="{{ route('mahasiswa.index') }}">
                            <i class="fas fa-graduation-cap"></i> Mahasiswa
                        </a>
                        <a class="nav-link" href="{{ route('petugas.index') }}">
                            <i class="fas fa-user-tie"></i> Petugas
                        </a>
                        <hr>
                        <h6 class="text-muted px-3 mb-3">Kelola</h6>
                        <a class="nav-link" href="{{ route('buku.index') }}">
                            <i class="fas fa-book"></i> Buku
                        </a>
                        <a class="nav-link" href="{{ route('pinjam.index') }}">
                            <i class="fas fa-arrow-right-arrow-left"></i> Peminjaman
                        </a>
                        <hr>
                        <h6 class="text-muted px-3 mb-3">Laporan</h6>
                        <a class="nav-link" href="{{ route('laporan.peminjaman') }}">
                            <i class="fas fa-file-pdf"></i> Laporan Peminjaman
                        </a>
                        <a class="nav-link" href="{{ route('laporan.denda') }}">
                            <i class="fas fa-file-pdf"></i> Laporan Denda
                        </a>
                    @else
                        <hr>
                        <h6 class="text-muted px-3 mb-3">Koleksi</h6>
                        <a class="nav-link" href="{{ route('katalog.index') }}">
                            <i class="fas fa-book"></i> Katalog Buku
                        </a>
                    @endif

                    @if(session('user_type') === 'dosen')
                        <hr>
                        <h6 class="text-muted px-3 mb-3">Peminjaman</h6>
                        <a class="nav-link" href="{{ route('pinjam.index') }}">
                            <i class="fas fa-list"></i> Pinjaman Saya
                        </a>
                        <a class="nav-link" href="{{ route('riwayat.dosen') }}">
                            <i class="fas fa-history"></i> Riwayat
                        </a>
                    @elseif(session('user_type') === 'mahasiswa')
                        <hr>
                        <h6 class="text-muted px-3 mb-3">Peminjaman</h6>
                        <a class="nav-link" href="{{ route('pinjam.index') }}">
                            <i class="fas fa-list"></i> Pinjaman Saya
                        </a>
                        <a class="nav-link" href="{{ route('riwayat.mahasiswa') }}">
                            <i class="fas fa-history"></i> Riwayat
                        </a>
                    @endif
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
