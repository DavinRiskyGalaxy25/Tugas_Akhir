<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}</title>
    <link rel="icon" type="image/png" href="{{ $pengaturan['logo_url'] ?? asset('assets/img/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-green: #176b3a;
            --primary-green-dark: #0f4d29;
            --primary-green-light: #228b4d;
            --accent-green: #4caf50;
            --bg-tint: #f4fbf6;
            --text-dark: #1f2937;
            --text-muted: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #092c17 0%, #13552e 50%, #176b3a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            position: relative;
            overflow-x: hidden;
        }

        /* Subtle glowing background orbs */
        body::before {
            content: '';
            position: absolute;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(76, 175, 80, 0.25) 0%, rgba(76, 175, 80, 0) 70%);
            top: -100px;
            left: -100px;
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: absolute;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(23, 107, 58, 0.3) 0%, rgba(23, 107, 58, 0) 70%);
            bottom: -80px;
            right: -80px;
            border-radius: 50%;
            pointer-events: none;
        }

        .login-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 440px;
        }

        .login-card {
            background: #ffffff;
            border: none;
            border-radius: 8px;
            box-shadow: 0 25px 60px -15px rgba(5, 30, 15, 0.35);
            padding: 42px 34px 34px;
            transition: transform 0.3s ease;
        }

        .logo-badge {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: #ffffff;
            border: none;
            box-shadow: 0 10px 25px rgba(23, 107, 58, 0.12);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            padding: 8px;
        }

        .logo-badge img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .login-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--primary-green-dark);
            margin-bottom: 4px;
            letter-spacing: -0.01em;
        }

        .login-subtitle {
            font-size: 0.86rem;
            color: var(--text-muted);
            margin-bottom: 24px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .input-group-text {
            background-color: #f8fafc;
            border: none;
            color: var(--primary-green);
            font-size: 0.95rem;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            padding: 12px 14px;
        }

        .form-control {
            border: none;
            background-color: #f8fafc;
            font-size: 0.92rem;
            padding: 12px 14px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: transparent;
            box-shadow: 0 0 0 3px rgba(23, 107, 58, 0.16), 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .btn-toggle-password {
            background-color: #f8fafc;
            border: none;
            color: #64748b;
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
            padding: 0 14px;
        }

        .btn-toggle-password:hover {
            color: var(--primary-green);
            background-color: #f1f5f9;
        }

        .form-check-input:checked {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-light) 100%);
            border: none;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.96rem;
            padding: 13px 20px;
            border-radius: 6px;
            width: 100%;
            transition: all 0.25s ease;
            box-shadow: 0 8px 20px rgba(23, 107, 58, 0.28);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--primary-green-dark) 0%, var(--primary-green) 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(23, 107, 58, 0.38);
            color: #ffffff;
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-back {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.88rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 18px;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            color: #ffffff;
            transform: translateX(-3px);
        }

        .alert-custom {
            border-radius: 6px;
            font-size: 0.86rem;
            padding: 12px 14px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }

        .footer-note {
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.78rem;
            margin-top: 24px;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="text-center">
                <div class="logo-badge d-inline-flex align-items-center justify-content-center" style="width: 72px; height: 72px; border-radius: 18px; background: #ffffff; box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08); margin: 0 auto 16px; padding: 6px;">
                    <img src="{{ $pengaturan['logo_url'] ?? asset('assets/img/logo.png') }}" alt="Logo {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
                <h1 class="login-title">{{ $pengaturan['nama_sekolah'] ?? 'SMP AL AHMAD KRIAN' }}</h1>
                <p class="login-subtitle">Panel Masuk Administrator Sekolah</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-custom" role="alert">
                    <i class="fa-solid fa-circle-check fs-5 text-success"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-custom" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fs-5 text-danger"></i>
                    <div>
                        <strong>Terjadi Kesalahan:</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.attempt') }}" id="loginForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="email">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.sch.id" required autofocus value="{{ old('email') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
                        <button class="btn btn-toggle-password" type="button" id="togglePassword" aria-label="Tampilkan atau sembunyikan kata sandi">
                            <i class="fa-regular fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check mb-0">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" value="1">
                        <label class="form-check-label text-muted small" for="remember">Ingat Saya</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-submit">
                    <span>Masuk ke Panel Admin</span>
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>
            </form>
        </div>

        <div class="text-center">
            <a href="{{ route('home') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Halaman Website</span>
            </a>
            <p class="footer-note">&copy; {{ date('Y') }} {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Toggle Show / Hide Password
        document.getElementById('togglePassword')?.addEventListener('click', function () {
            const passInput = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');
            if (!passInput || !icon) return;

            if (passInput.type === 'password') {
                passInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>
