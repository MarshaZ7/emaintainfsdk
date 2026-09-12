@extends('layouts.user.app')

@section('title', 'Login User')

@section('content')

<section class="login-section section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="login-card" data-aos="fade-up">
                    <div class="text-center mb-4">
                        <div class="login-icon mb-3">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <h2>Welcome</h2>
                        <p class="mb-0">
                            Login to access your e-Maintain@FSDK account
                        </p>
                    </div>

                    
                    <form action="{{ route('user.login.process') }}" method="POST">
                        @csrf
                        {{-- University ID --}}
                        <div class="mb-3">
                            <label for="university_id" class="form-label">
                                University ID
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" class="form-control" id="university_id"
                                    name="university_id" placeholder="Enter your University ID"
                                    value="{{ old('university_id') }}" required>
                            </div>
                            @error('university_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" class="form-control" id="password"
                                    name="password" placeholder="Enter your password" required>
                            </div>
                            @error('password')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    
                        <div class="login-options mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <div class="forgot-password-info">
                                <i class="bi bi-info-circle me-1"></i>
                                Forgot your password?
                                <span>Please contact the administrator.</span>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Login
                            </button>
                        </div>
                    </form>

                    <div class="login-account-info text-center mt-4">
                        <p class="mb-1">
                            Don't have an account?
                        </p>
                        <small class="text-muted">
                            Please contact the administrator to create an account.
                        </small>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ url('/') }}#hero" class="back-home">
                            <i class="bi bi-arrow-left me-1"></i>
                            Back to Home
                        </a>

                    </div>

                </div>

            </div>
        </div>

    </div>
</section>

<style>

    /* Login options */
    .login-options {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
    }

    .login-options .form-check {
        flex-shrink: 0;
    }

    .forgot-password-info {
        color: #6c757d;
        font-size: 12px;
        line-height: 1.5;
        text-align: right;
        max-width: 230px;
    }

    .forgot-password-info i {
        color: #3351f8;
    }

    .forgot-password-info span {
        display: block;
        margin-top: 2px;
    }

    .login-account-info {
        padding-top: 18px;
        border-top: 1px solid #eeeeee;
    }

    .login-account-info p {
        font-size: 14px;
        font-weight: 600;
        color: #212529;
    }

    .login-account-info small {
        font-size: 12px;
    }

    .back-home {
        font-size: 14px;
        text-decoration: none;
    }

    .back-home:hover {
        text-decoration: underline;
    }

    @media (max-width: 576px) {

        .login-options {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .forgot-password-info {
            text-align: left;
            max-width: 100%;
        }

    }
</style>
@endsection