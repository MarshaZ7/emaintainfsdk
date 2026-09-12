<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Technician Login - e-Maintain@FSDK
    </title>
    <meta name="description" content="Technician Login - e-Maintain@FSDK">
    <meta name="author" content="e-Maintain@FSDK">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('tech-template/assets/images/favicon.ico') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('tech-template/assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('tech-template/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('tech-template/assets/css/main.css') }}">
</head>

<body>
    <!-- Login Wrapper -->
    <div class="login-wrapper">
        <!-- Background Shapes -->
        <div class="login-bg-shape login-bg-shape-1"></div>
        <div class="login-bg-shape login-bg-shape-2"></div>
        <!-- Login Card -->
        <div class="login-card">
            <!-- Brand -->
            <a href="{{ url('/') }}"
                class="login-brand text-decoration-none">
                <i class="bi bi-tools"></i>
                <span>
                    e-Maintain@FSDK
                </span>
            </a>

            <!-- Subtitle -->
            <p class="login-subtitle">
                Technician Portal
                <br>
                Sign in to manage your maintenance assignments.
            </p>
            @if(session('error'))
                <div class="alert alert-danger mb-3">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success mb-3">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Login Form -->
            <form action="{{ route('technician.authenticate') }}" method="POST" id="loginForm">
                @csrf

                <!-- Email -->
                <div class="login-form-group">
                    <label for="email" class="login-form-label">
                        Email Address
                    </label>

                    <div class="login-input-group">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="login-input"
                        placeholder="technician@umk.edu.my" value="{{ old('email') }}" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="login-form-group">
                    <label for="password" class="login-form-label">
                        Password
                    </label>

                    <div class="login-input-group">
                        <i class="bi bi-shield-lock input-icon"></i>

                        <input type="password" id="password" name="password" class="login-input login-input-password" 
                        placeholder="Enter your password" required>
                        <button type="button" class="password-toggle-btn" id="toggle-password"
                                aria-label="Show password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Options -->
                <div class="login-options">
                    <label class="custom-control-label">
                        <input type="checkbox" class="custom-checkbox-input" id="rememberMe" name="remember">
                        <span>
                            Remember Me
                        </span>
                    </label>

                    <a href="#" class="forgot-password-link">
                        Forgot Password?
                    </a>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-login" id="btn-submit">
                    <span>
                        Sign In
                    </span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

                        <!-- Login Information -->
                        <div class="mt-4 text-center">
                            <small class="text-muted">
                                Authorized technician access only.
                            </small>
                        </div>

                        <!-- Back to Main Website -->
                        <p class="login-footer-text">
                            <a href="{{ url('/') }}" id="back-home">
                                <i class="bi bi-arrow-left"></i>
                                Back to e-Maintain@FSDK
                            </a>
                        </p>
                    </div>
                </div>
    <!-- Bootstrap -->
    <script src="{{ asset('tech-template/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Authentication JS -->
    <script src="{{ asset('tech-template/assets/js/auth.js') }}"></script>

    <!-- Password Toggle -->
    <script>
        document
            .getElementById('toggle-password')
            .addEventListener('click', function () {
                const password =
                    document.getElementById('password');
                const icon =
                    this.querySelector('i');
                if (password.type === 'password') {
                    password.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                    this.setAttribute(
                        'aria-label',
                        'Hide password'
                    );
                } else {
                    password.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                    this.setAttribute(
                        'aria-label',
                        'Show password'
                    );
                }
            });
    </script>
</body>
</html>