<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background: #ffffff;
            min-height: 100vh;
            display: flex;
        }

        .auth-container {
            display: flex;
            flex: 1;
            height: 100vh;
        }

        .auth-image {
            flex: 2;
            background: url('/images/background.jpeg') no-repeat center center;
            background-size: cover;
        }

        .auth-form-section {
            flex: 1;
            background: #ffffff;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding: 2rem 2rem 2rem 3rem;
        }

        .auth-card {
            width: 100%;
            max-width: 360px;
            background: #ffffff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .auth-title {
            font-size: 2rem;
            color: #333;
            font-weight: 600;
        }

        .auth-subtitle {
            font-size: 0.95rem;
            color: #666;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.4rem;
        }

        .form-input {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-input.is-invalid {
            border-color: red;
        }

        .invalid-feedback {
            color: red;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .password-input-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 0.75rem;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
        }

        .btn {
            background: #6C5CE7;
            color: white;
            padding: 0.75rem;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn:hover {
            background: #5c4edb;
        }

        .auth-links {
            text-align: center;
            margin-top: 1rem;
        }

        .forgot-password,
        .register-link a {
            color: #6C5CE7;
            font-weight: 500;
            text-decoration: none;
        }

        .forgot-password:hover,
        .register-link a:hover {
            text-decoration: underline;
        }

        .form-label-inline {
            display: inline-block;
            margin-left: 0.5rem;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .auth-image {
                display: none;
            }

            .auth-container {
                flex-direction: column;
            }

            .auth-form-section {
                border-radius: 0;
            }
        }
    </style>
</head>
<body>

<div class="auth-container">
    <div class="auth-image"></div>

    <div class="auth-form-section">
        <div class="auth-card">
            <div class="auth-header">
                <h1 class="auth-title">Login</h1>
                <p class="auth-subtitle">Selamat datang kembali!</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           class="form-input @error('email') is-invalid @enderror" required autofocus>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-input-group">
                        <input id="password" type="password" name="password"
                               class="form-input @error('password') is-invalid @enderror" required>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="checkbox" id="remember" name="remember" class="form-checkbox" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="form-label-inline">Ingat saya</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">Login</button>
                </div>

                <div class="auth-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">Lupa password?</a>
                    @endif
                    <p class="register-link">
                        Belum punya akun?
                        <a href="{{ route('register') }}">Daftar sekarang</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.querySelector('.password-toggle i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>

</body>
</html>
