<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiLib - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            border: none;
        }
        .login-card .card-body {
            padding: 2.5rem;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
        }
        .login-header i {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 0.5rem;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            transition: transform 0.2s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
        }
        .login-info {
            background: rgba(255,255,255,0.9);
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #666;
        }
        .login-info strong {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card login-card">
            <div class="card-body">
                <div class="login-header">
                    <i class="fas fa-book"></i>
                    <h3 class="mb-0">DigiLib</h3>
                    <small class="text-muted">Digital Library System</small>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle"></i>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   id="username" name="username" placeholder="Masukkan username"
                                   value="{{ old('username') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-login w-100 mb-3">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
