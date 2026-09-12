<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register - e-Maintain@FSDK</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background:
                radial-gradient(circle at 10% 20%, rgba(0,198,214,.18), transparent 30%),
                radial-gradient(circle at 90% 80%, rgba(220,38,38,.18), transparent 30%),
                linear-gradient(135deg, #07152f, #0b2448 50%, #062c3b);
        }

        /* Wrapper */
        .register-wrapper {
            width: 100%;
            height: 100vh;
            height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 15px;
            overflow: hidden;
        }

        /* Background */
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(2px);
            opacity: .5;
            pointer-events: none;
        }

        .bg-circle.one {
            width: 320px;
            height: 320px;
            background: rgba(0,201,218,.12);
            top: -100px;
            left: -80px;
        }

        .bg-circle.two {
            width: 400px;
            height: 400px;
            background: rgba(220,38,38,.10);
            bottom: -180px;
            right: -120px;
        }

        /* Register Card */
        .register-card {
            width: 100%;
            max-width: 560px;
            position: relative;
            z-index: 2;
            padding: 28px 38px;
            background: rgba(255,255,255,.97);
            border-radius: 22px;
            box-shadow:
                0 25px 70px rgba(0,0,0,.30);
            animation: cardAppear .5s ease;
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Brand */
        .login-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #0b2448;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
            text-decoration: none;
        }

        .login-brand i {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background:
                linear-gradient(
                    135deg,
                    #dc2626,
                    #087f9c
                );
            border-radius: 11px;
            font-size: 20px;
        }

        .login-subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 18px;
        }

        /* Alert */
        .alert {
            border-radius: 9px;
            font-size: 12px;
            padding: 9px 12px;
            margin-bottom: 12px;
        }

        .alert ul {
            padding-left: 18px;
        }

        /* Form Grid */
        .register-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 16px;
        }

        /* Form */
        .login-form-group {
            margin-bottom: 13px;
        }

        .login-form-label {
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
        }

        .login-input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #7b8794;
            font-size: 16px;
            z-index: 2;
        }

        .login-input {
            width: 100%;
            height: 44px;
            padding: 0 13px 0 41px;
            border: 1px solid #d9dee7;
            border-radius: 10px;
            background: #f8fafc;
            font-size: 13px;
            color: #1f2937;
            outline: none;
            transition: all .2s ease;
        }

        .login-input:focus {
            background: white;
            border-color: #08a6b8;
            box-shadow:
                0 0 0 4px rgba(8,166,184,.10);
        }

        .login-input::placeholder {
            color: #9ca3af;
        }

        /* Button */
        .btn-login {
            width: 100%;
            height: 47px;
            border: none;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            color: white;
            font-size: 13px;
            font-weight: 600;
            background:
                linear-gradient(
                    135deg,
                    #dc2626,
                    #087f9c
                );
            box-shadow: 0 8px 20px rgba(8,127,156,.25);
            transition: all .25s ease;
            margin-top: 5px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow:
                0 12px 25px rgba(8,127,156,.30);
        }

        .btn-login i {
            font-size: 17px;
        }

        /* Footer */
        .login-footer-text {
            text-align: center;
            margin-top: 15px;
            margin-bottom: 0;
            color: #6b7280;
            font-size: 12px;
        }

        .login-footer-text a {
            color: #087f9c;
            font-weight: 600;
            text-decoration: none;
        }

        .login-footer-text a:hover {
            color: #dc2626;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 600px) {
            html,
            body {
                overflow-y: auto;
            }

            .register-wrapper {
                min-height: 100vh;
                height: auto;
                overflow-y: auto;
                padding: 20px 15px;
            }

            .register-card {
                padding: 25px 22px;
                border-radius: 18px;
            }

            .register-form-row {
                grid-template-columns: 1fr;
            }

            .login-brand {
                font-size: 21px;
            }

            .login-brand i {
                width: 39px;
                height: 39px;
                font-size: 19px;
            }
        }
    </style>

</head>
<body>
<div class="register-wrapper">
    <!-- Background decoration -->
    <div class="bg-circle one"></div>
    <div class="bg-circle two"></div>
    <!-- Register Card -->
    <div class="register-card">
        <!-- Brand -->
        <a href="{{ url('/') }}"
            class="login-brand">
            <i class="bi bi-tools"></i>
            <span>
                e-Maintain@FSDK
            </span>
        </a>

        <p class="login-subtitle">
            Create an administrator account
        </p>
        <!-- Error -->
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle me-1"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Validation -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Register Form -->
        <form action="{{ route('admin.register.process') }}" method="POST">
            @csrf
            <div class="register-form-row">
                <!-- University ID -->
                <div class="login-form-group">
                    <label class="login-form-label">
                        University ID
                    </label>
                    <div class="login-input-group">
                        <i class="bi bi-person-badge input-icon"></i>
                        <input type="text" name="university_id" class="login-input"
                            placeholder="University ID"
                            value="{{ old('university_id') }}"
                            required>
                    </div>
                </div>

                <!-- Full Name -->
                <div class="login-form-group">
                    <label class="login-form-label">
                        Full Name
                    </label>
                    <div class="login-input-group">
                        <i class="bi bi-person input-icon"></i>
                        <input type="text" name="name" class="login-input"
                            placeholder="Full name" value="{{ old('name') }}" required>
                    </div>
                </div>


                <!-- Email -->
                <div class="login-form-group">
                    <label class="login-form-label">
                        Email Address
                    </label>
                    <div class="login-input-group">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" name="email" class="login-input"
                            placeholder="admin@example.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <!-- Phone -->
                <div class="login-form-group">
                    <label class="login-form-label">
                        Phone Number
                    </label>
                    <div class="login-input-group">
                        <i class="bi bi-telephone input-icon"></i>
                        <input type="text" name="phone" class="login-input"
                            placeholder="Phone number" value="{{ old('phone') }}">
                    </div>
                </div>

                <!-- Password -->
                <div class="login-form-group">
                    <label class="login-form-label">
                        Password
                    </label>
                    <div class="login-input-group">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" name="password" class="login-input" placeholder="Enter password" required>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="login-form-group">
                    <label class="login-form-label">
                        Confirm Password
                    </label>
                    <div class="login-input-group">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password" name="password_confirmation" class="login-input"
                            placeholder="Confirm password" required>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-login">
                <span>
                    Create Admin Account
                </span>
                <i class="bi bi-arrow-right"></i>
            </button>
        </form>

        <!-- Login -->
        <p class="login-footer-text">
            Already have an account?
            <a href="{{ route('admin.login') }}">
                Sign In
            </a>
        </p>
    </div>
</div>

<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}">
</script>

</body>
</html>