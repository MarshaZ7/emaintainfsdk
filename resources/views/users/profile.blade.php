@extends('layouts.fsdk-user.app')

@section('title', 'My Profile')

@section('content')

<style>
    .user-profile {
        min-height: 100vh;
        padding-top: 120px;
        padding-bottom: 80px;

        background:
            linear-gradient(
                rgba(14, 22, 55, 0.88),
                rgba(14, 22, 55, 0.92)
            ),
            url("{{ asset('user-template/assets/img/hero-bg-2.jpg') }}");

        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }    

    .profile-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
    }

    .profile-cover {
        height: 150px;
        background: linear-gradient(135deg, #0e1637, #3351f8);
        position: relative;
    }

    .profile-avatar {
        position: absolute;
        left: 40px;
        bottom: -45px;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: #fff;
        border: 5px solid #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3351f8;
        font-size: 42px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
    }

    .profile-body {
        padding: 60px 40px 35px;
    }

    .profile-name {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .profile-role {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 30px;
    }

    .profile-section-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #212529;
    }

    .profile-info-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .profile-info-item:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #eef2ff;
        color: #3351f8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .info-label {
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 3px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 600;
        color: #212529;
    }

    .profile-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        background: #e8f7ee;
        color: #198754;
        font-size: 13px;
        font-weight: 600;
    }

    .profile-status i {
        font-size: 8px;
    }

    .account-card {
        border: none;
        border-radius: 14px;
    }

    .account-action {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 20px;
        border: 1px solid #eee;
        border-radius: 10px;
        margin-bottom: 12px;
        text-decoration: none;
        color: #212529;
        transition: all 0.2s ease;
    }
    h2{
        color: white;
    }

    .account-action:hover {
        border-color: #3351f8;
        background: #f8f9ff;
        color: #3351f8;
    }

    .account-action-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .account-action-left i {
        font-size: 19px;
        color: #3351f8;
    }

    .account-action-title {
        font-weight: 600;
        font-size: 14px;
    }

    .account-action-description {
        display: block;
        font-size: 12px;
        color: #6c757d;
        margin-top: 2px;
    }

    @media (max-width: 576px) {
        .profile-body {
            padding: 60px 20px 25px;
        }

        .profile-avatar {
            left: 20px;
        }
    }
</style>

<section class="user-profile section" style="padding-top: 120px;">
    <div class="container">

        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold mb-1">My Profile</h2>
                <p class="text-white mb-0">
                    View your account information and profile details.
                </p>
            </div>
        </div>

        <div class="row gy-4">

            <!-- Profile Information -->
            <div class="col-lg-8">
                <div class="card profile-card shadow-sm">

                    <div class="profile-cover">
                        <div class="profile-avatar">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>

                    <div class="profile-body">

                        <h3 class="profile-name">
                            {{ session('fsdk_user_name') }}
                        </h3>

                        <p class="profile-role">
                            {{ session('fsdk_user_role') }}
                        </p>

                        <h4 class="profile-section-title">
                            Account Information
                        </h4>

                        <!-- University ID -->
                        <div class="profile-info-item">
                            <div class="info-icon">
                                <i class="bi bi-person-badge"></i>
                            </div>

                            <div>
                                <div class="info-label">
                                    University ID
                                </div>

                                <div class="info-value">
                                    {{ session('fsdk_user_university_id') }}
                                </div>
                            </div>
                        </div>

                        <!-- Full Name -->
                        <div class="profile-info-item">
                            <div class="info-icon">
                                <i class="bi bi-person"></i>
                            </div>

                            <div>
                                <div class="info-label">
                                    Full Name
                                </div>

                                <div class="info-value">
                                    {{ session('fsdk_user_name') }}
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="profile-info-item">
                            <div class="info-icon">
                                <i class="bi bi-envelope"></i>
                            </div>

                            <div>
                                <div class="info-label">
                                    Email Address
                                </div>

                                <div class="info-value">
                                    {{ session('fsdk_user_email') ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="profile-info-item">
                            <div class="info-icon">
                                <i class="bi bi-person-gear"></i>
                            </div>

                            <div>
                                <div class="info-label">
                                    Account Role
                                </div>

                                <div class="info-value">
                                    {{ session('fsdk_user_role') }}
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="profile-info-item">
                            <div class="info-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>

                            <div>
                                <div class="info-label">
                                    Account Status
                                </div>

                                <div class="profile-status">
                                    <i class="bi bi-circle-fill"></i>
                                    Active
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Account Actions -->
            <div class="col-lg-4">
                <div class="card account-card shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-1">
                            Account
                        </h4>

                        <p class="text-muted small mb-4">
                            Manage your account settings.
                        </p>                                                

                        <!-- Change Password -->
                        <div class="account-action" style="cursor: not-allowed; opacity: 0.7;">
                            <div class="account-action-left">
                                <i class="bi bi-lock"></i>
                                <div>
                                    <span class="account-action-title">
                                        Change Password
                                    </span>

                                    <span class="account-action-description">
                                        Password is managed by administrator
                                    </span>
                                </div>
                            </div>

                            <i class="bi bi-lock-fill text-muted"></i>
                        </div>

                        <!-- Logout -->
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="account-action w-100 bg-white text-start">
                                <div class="account-action-left">
                                    <i class="bi bi-box-arrow-right text-danger"></i>
                                    <div>
                                        <span class="account-action-title">
                                            Logout
                                        </span>

                                        <span class="account-action-description">
                                            Sign out from your account
                                        </span>
                                    </div>
                                </div>

                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection