<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - e-Maintain@FSDK</title>
    <!-- Favicons -->
  <link href="../user-template/assets/img/fsdk.png" rel="icon">
  <link href="../user-template/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin-template/assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('admin-template/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
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

        .login-wrapper {
            width: 100%;
            height: 100vh;
            height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 20px;
            overflow: hidden;
        }

        /* Background Shapes */
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(2px);
            opacity: .5;
        }
        .bg-circle.one {
            width: 320px;
            height: 320px;
            background: rgba(0, 201, 218, .12);
            top: -100px;
            left: -80px;
        }
        .bg-circle.two {
            width: 400px;
            height: 400px;
            background: rgba(220, 38, 38, .10);
            bottom: -180px;
            right: -120px;
        }

        /* Login Card */
        .login-card {
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 2;
            padding: 35px 40px;
            background: rgba(255, 255, 255, .97);
            border-radius: 22px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, .30);
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
            font-size: 25px;
            font-weight: 700;

            margin-bottom: 8px;
        }

        .login-brand i {
            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;
            background: linear-gradient(
                135deg,
                #dc2626,
                #087f9c
            );

            border-radius: 12px;
            font-size: 22px;
        }

        .login-subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* Alert */

        .alert {
            border-radius: 10px;
            font-size: 13px;
        }

        .alert ul {
            padding-left: 18px;
        }

        /* Form */

        .login-form-group {
            margin-bottom: 20px;
        }

        .login-form-label {
            display: block;
            margin-bottom: 8px;

            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        .login-input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;

            left: 15px;
            top: 50%;

            transform: translateY(-50%);

            color: #7b8794;
            font-size: 18px;

            z-index: 2;
        }

        .login-input {
            width: 100%;
            height: 52px;

            padding: 0 15px 0 46px;

            border: 1px solid #d9dee7;
            border-radius: 11px;

            background: #f8fafc;

            font-size: 14px;
            color: #1f2937;

            outline: none;

            transition: all .2s ease;
        }

        .login-input:focus {
            background: white;

            border-color: #08a6b8;

            box-shadow:
                0 0 0 4px rgba(8, 166, 184, .10);
        }

        /* Button */

        .btn-login {
            width: 100%;
            height: 53px;

            border: none;
            border-radius: 11px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 10px;

            color: white;

            font-size: 14px;
            font-weight: 600;

            background: linear-gradient(
                135deg,
                #dc2626,
                #087f9c
            );

            box-shadow:
                0 8px 20px rgba(8, 127, 156, .25);

            transition: all .25s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 25px rgba(8, 127, 156, .30);
        }

        .btn-login i {
            font-size: 18px;
        }

        /* Register */

        .login-footer-text {
            text-align: center;

            margin-top: 25px;
            margin-bottom: 0;

            color: #6b7280;
            font-size: 13px;
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

        @media (max-width: 576px) {
        .login-wrapper {
            padding: 15px;
        }

        .login-card {
            padding: 28px 22px;
            border-radius: 18px;
        }

        .login-brand {
            font-size: 21px;
        }

        .login-brand i {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }

        .login-form-group {
            margin-bottom: 16px;
        }
    }
    </style>

</head>

<body>

<div class="login-wrapper">
    <!-- Background decoration -->
    <div class="bg-circle one"></div>
    <div class="bg-circle two"></div>
    <!-- Login Card -->
    <div class="login-card">
        <!-- Brand -->
        <a href="{{ url('/') }}" class="login-brand text-decoration-none">            
            <span>
                e-Maintain@FSDK
            </span>
        </a>
        <p class="login-subtitle">
            Administrator Login
        </p>
        <!-- Error -->
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle me-1"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Success -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
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

        <!-- Login Form -->
        <form action="{{ route('admin.login.process') }}"
            method="POST">
            @csrf
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

            <!-- Password -->
            <div class="login-form-group">
                <label class="login-form-label">
                    Password
                </label>
                <div class="login-input-group">
                    <i class="bi bi-shield-lock input-icon"></i>
                    <input type="password" name="password" class="login-input"
                        placeholder="Enter your password" required>
                </div>
            </div>


            <!-- Submit -->
            <button type="submit"
                class="btn-login">
                <span>
                    Sign In to Dashboard
                </span>
                <i class="bi bi-arrow-right"></i>
            </button>
        </form>

        <!-- Register -->
        <!-- <p class="login-footer-text">
            Don't have an admin account?
            <a href="{{ route('admin.register') }}">
                Register Now
            </a>
        </p> -->
    </div>
</div>


<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}">
</script>
</body>

</html>