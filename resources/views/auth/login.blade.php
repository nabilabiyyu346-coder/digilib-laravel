<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiLib - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .login-wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* LEFT SIDE - INFO/BRANDING */
        .login-info-section {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-info-section::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }

        .login-info-section::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(20px); }
        }

        .login-info-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 400px;
        }

        .login-logo {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .login-info-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-info-content p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2.5rem;
        }

        .info-features {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            align-items: flex-start;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            opacity: 0.9;
        }

        .feature-item i {
            font-size: 1.5rem;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
        }

        /* RIGHT SIDE - FORM */
        .login-form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            background: #f8f9fa;
        }

        .login-form-container {
            width: 100%;
            max-width: 450px;
        }

        .login-form-header {
            margin-bottom: 2rem;
        }

        .login-form-header h1 {
            font-size: 1.8rem;
            color: #1a1a1a;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-form-header p {
            color: #666;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #1a1a1a;
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 0.5rem;
            font-size: 0.95rem;
            color: #1a1a1a;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            background: white;
            color: #1a1a1a;
        }

        .form-control::placeholder {
            color: #999;
        }

        .input-group-text {
            background: transparent;
            border: 2px solid #e0e0e0;
            border-right: none;
            color: #667eea;
            font-size: 1.1rem;
        }

        .input-group .form-control {
            border-left: none;
            border: 2px solid #e0e0e0;
        }

        .input-group .form-control:focus {
            border-color: #667eea;
        }

        .input-group:focus-within .input-group-text {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }

        .btn-login {
            width: 100%;
            padding: 0.95rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            border: 2px solid #f8d7da;
            border-radius: 0.5rem;
            background: #fff5f7;
            color: #842029;
            margin-bottom: 1.5rem;
            padding: 1rem;
        }

        .alert i {
            margin-right: 0.5rem;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-info-section {
                flex: none;
                min-height: 200px;
                padding: 2rem;
            }

            .login-info-section::before,
            .login-info-section::after {
                width: 200px;
                height: 200px;
            }

            .login-info-content h2 {
                font-size: 1.8rem;
            }

            .login-form-section {
                flex: 1;
                padding: 2rem 1.5rem;
            }

            .info-features {
                flex-direction: row;
                justify-content: center;
                gap: 1.5rem;
            }

            .feature-item {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .login-form-container {
                max-width: 100%;
            }

            .login-form-header h1 {
                font-size: 1.5rem;
            }

            .btn-login {
                padding: 0.85rem;
                font-size: 0.95rem;
            }

            .info-features {
                flex-direction: row;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- LEFT SIDE -->
        <div class="login-info-section d-none d-lg-flex">
            <div class="login-info-content">
                <div class="login-logo">
                    <i class="fas fa-book"></i>
                </div>
                <h2>DigiLib</h2>
                <p>Perpustakaan Digital Modern</p>
                
                <div class="info-features">
                    <div class="feature-item">
                        <i class="fas fa-database"></i>
                        <span>Koleksi Lengkap</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-search"></i>
                        <span>Pencarian Mudah</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-arrow-right-arrow-left"></i>
                        <span>Peminjaman Cepat</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="login-form-section">
            <div class="login-form-container">
                <div class="login-form-header">
                    <h1>Masuk</h1>
                    <p>Silakan login ke akun Anda</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="username" class="form-label">
                            <i class="fas fa-user"></i> Username
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('username') is-invalid @enderror"
                                   id="username" name="username" placeholder="Masukkan username"
                                   value="{{ old('username') }}" required>
                        </div>
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt"></i> Login Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
