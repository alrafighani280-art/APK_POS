<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POS Berkah Utama</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* Reset margin & padding browser agar full-screen 100% */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Latar belakang full viewport */
        .login-wrapper {
            min-height: 100vh;
            width: 100vw;
            background-color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        /* Bulatan pudar warna Teal di kiri atas */
        .login-wrapper::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(11, 100, 119, 0.18) 0%, rgba(255, 255, 255, 0) 70%);
            top: -150px;
            left: -150px;
            filter: blur(60px);
            pointer-events: none;
        }

        /* Bulatan pudar warna pendukung di kanan bawah */
        .login-wrapper::after {
            content: '';
            position: absolute;
            width: 700px;
            height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(11, 100, 119, 0.12) 0%, rgba(255, 255, 255, 0) 70%);
            bottom: -200px;
            right: -200px;
            filter: blur(70px);
            pointer-events: none;
        }

        /* Kartu Login Bersih dengan Soft Shadow */
        .login-card {
            background: #ffffff;
            border-radius: 1.25rem;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 20px 40px -15px rgba(11, 100, 119, 0.1), 0 10px 20px -10px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
        }

        .login-brand-icon {
            background: rgba(11, 100, 119, 0.08);
            color: #0B6477;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-login-custom {
            background-color: #0B6477;
            border: none;
            color: #ffffff;
            padding: 0.75rem 1rem;
            font-weight: 600;
            border-radius: 0.6rem;
            transition: all 0.2s ease;
        }

        .btn-login-custom:hover {
            background-color: #095161;
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(11, 100, 119, 0.25);
        }

        .form-control {
            background-color: #f8fafc;
            border-color: #e2e8f0;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #0B6477;
            box-shadow: 0 0 0 0.2rem rgba(11, 100, 119, 0.12);
        }

        .btn-back-landing {
            color: #64748b;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s ease;
            position: relative;
            z-index: 1;
        }

        .btn-back-landing:hover {
            color: #0B6477;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="d-flex flex-column align-items-center w-100">
        
        <div class="card login-card p-4">
            <div class="card-body p-2">
                <div class="text-center mb-4">````
                    <div class="login-brand-icon mb-3">
                        <i class="bi bi-basket2-fill fs-3"></i>
                    </div>
                    <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">BERKAH UTAMA</h4>
                    <p class="text-muted small">Silakan login menggunakan akun Anda.</p>
                </div>

                <form action="{{ route('auth') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold text-secondary">EMAIL</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="form-control form-control-lg border-start-0 fs-6 @error('email') is-invalid @enderror" 
                                   id="email" 
                                   placeholder="admin@gmail.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label small fw-semibold text-secondary">KATA SANDI</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" 
                                   name="password" 
                                   class="form-control form-control-lg border-start-0 border-end-0 fs-6 @error('password') is-invalid @enderror" 
                                   id="password" 
                                   placeholder="••••••••"
                                   required>
                            <button class="input-group-text bg-light border-start-0 text-muted" type="button" id="togglePassword" style="cursor: pointer;">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login-custom btn-lg w-100 fs-6">
                        Masuk
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-4 text-center text-muted small position-relative" style="z-index: 1;">
            POS Berkah Utama &copy; {{ date('Y') }}
        </div>

    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    });
</script>
</body>
</html>