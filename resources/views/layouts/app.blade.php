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
            --bs-body-bg: #f6f7fc;
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --accent-color: #4facfe;
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        * {
            transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f6f7fc 0%, #e9ecef 100%);
            min-height: 100vh;
        }
        
        /* Navbar Styling */
        .navbar {
            background: linear-gradient(180deg, #344aa5 0%, #7857ee 100%) !important;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
            border: none !important;
        }
        
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
            color: white !important;
            font-size: 1.3rem;
        }
        
        .navbar-brand i {
            margin-right: 0.5rem;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover, .navbar-light .navbar-nav .show > .nav-link {
            color: white !important;
            transform: translateY(-2px);
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #667eea;
        }
        
        /* Sidebar Styling */
        .sidebar {
            background: linear-gradient(180deg, #2e3e81 0%, #334c8b 100%);
            border-right: 1px solid #245d96;
            min-height: 100vh;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
        }
        
        .nav-link {
            color: #3d3d5c;
            border-left: 4px solid transparent;
            padding: 0.75rem 1rem;
            border-radius: 0 8px 8px 0;
            margin-bottom: 0.25rem;
            font-weight: 600;
            position: relative;
            font-size: 0.95rem;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.02);
        }
        
        .nav-link i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }
        
        .nav-link:hover {
            color: #667eea;
            background-color: rgba(102, 126, 234, 0.08);
            border-left-color: #667eea;
            transform: translateX(4px);
        }
        
        .nav-link.active {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.1), rgba(102, 126, 234, 0.05));
            color: #667eea;
            border-left-color: #667eea;
            font-weight: 600;
            box-shadow: inset -2px 0 0 #667eea;
        }
        
        .sidebar h6 {
            color: #2d2d3d;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            margin-top: 1.5rem;
            margin-bottom: 0.8rem;
            padding-left: 1rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            border-bottom: 2px solid #667eea;
            padding-bottom: 0.5rem;
        }
        
        .sidebar h6:first-child {
            margin-top: 0;
        }
        
        /* Card Styling */
        .card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }
        
        .card:hover {
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.12);
            transform: translateY(-4px);
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .card-header {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.05), rgba(79, 172, 254, 0.05));
            border-bottom: 2px solid #e9ecef;
            font-weight: 600;
            color: #667eea;
        }
        
        /* Stat Cards */
        .stat-card {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(79, 172, 254, 0.05) 100%);
            border-left: 4px solid #667eea;
        }
        
        .stat-card:nth-child(2) {
            border-left-color: #4facfe;
        }
        
        .stat-card:nth-child(3) {
            border-left-color: #00f2fe;
        }
        
        .stat-card:nth-child(4) {
            border-left-color: #f093fb;
        }
        
        .stat-card h6 {
            color: #a0a0b8;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-card h3 {
            color: #667eea;
            font-weight: 700;
            font-size: 2rem;
        }
        
        .stat-card i {
            opacity: 0.3;
            color: #667eea;
        }
        
        .stat-card:nth-child(2) i {
            color: #4facfe;
        }
        
        .stat-card:nth-child(3) i {
            color: #00f2fe;
        }
        
        .stat-card:nth-child(4) i {
            color: #f093fb;
        }
        
        /* Button Styling */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.6rem 1.2rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }
        
        .btn-primary:hover {
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            transform: translateY(-2px);
        }
        
        .btn-outline-primary {
            color: #667eea;
            border: 2px solid #667eea;
        }
        
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
        }
        
        /* Page Header */
        h2 {
            color: #2d2d3d;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        h2 i {
            color: #667eea;
            margin-right: 0.5rem;
        }
        
        .text-muted {
            color: #a0a0b8 !important;
        }
        
        /* Table Styling */
        .table {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.08), rgba(79, 172, 254, 0.08));
            border-bottom: 2px solid #e9ecef;
            color: #667eea;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            padding: 1rem;
        }
        
        .table tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.05);
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
