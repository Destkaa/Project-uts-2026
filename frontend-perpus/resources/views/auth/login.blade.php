@extends('layouts.app')

@section('content')

<style>
    .login-page {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 15px;
        background: #f6f8fc;
    }

    .login-card {
        width: 100%;
        max-width: 430px;
        background: #ffffff;
        border: none;
        border-radius: 18px;
        padding: 35px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.07);
    }

    .login-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 20px;
        border-radius: 16px;
        background: #e8f1ff;
        color: #3b82f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

    .login-title {
        text-align: center;
        margin-bottom: 30px;
    }

    .login-title h3 {
        color: #172033;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .login-title p {
        color: #8a94a6;
        font-size: 14px;
        margin: 0;
    }

    .form-label {
        color: #374151;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control {
        height: 46px;
        border-radius: 10px;
        border: 1px solid #dfe5ed;
        background: #f9fafc;
        padding: 10px 14px;
        font-size: 13px;
    }

    .form-control:focus {
        border-color: #3b82f6;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.10);
    }

    .form-check-label {
        color: #6b7280;
        font-size: 13px;
    }

    .forgot-password {
        color: #3b82f6;
        text-decoration: none;
        font-size: 13px;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    .login-button {
        width: 100%;
        height: 46px;
        border: none;
        border-radius: 10px;
        background: #3b82f6;
        color: white;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s;
    }

    .login-button:hover {
        background: #2563eb;
        transform: translateY(-1px);
    }

    .login-footer {
        text-align: center;
        margin-top: 25px;
        color: #8a94a6;
        font-size: 13px;
    }

    .login-footer a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }

    .login-alert {
        border-radius: 10px;
        font-size: 13px;
        border: none;
        background: #fff1f2;
        color: #dc2626;
    }
</style>


<div class="login-page">

    <div class="login-card">

        <!-- ICON -->
        <div class="login-icon">
            <i class="bi bi-book-half"></i>
        </div>


        <!-- TITLE -->
        <div class="login-title">

            <h3>Selamat Datang 👋</h3>

            <p>
                Masuk ke sistem perpustakaan
            </p>

        </div>


        <!-- ERROR -->
        @if ($errors->any())

            <div class="alert login-alert mb-4">

                <i class="bi bi-exclamation-circle me-2"></i>

                Email atau password yang dimasukkan salah.

            </div>

        @endif


        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">

            @csrf


            <!-- EMAIL -->
            <div class="mb-3">

                <label
                    for="email"
                    class="form-label"
                >
                    Email Address
                </label>

                <input
                    id="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email kamu"
                    required
                    autocomplete="email"
                    autofocus
                >

                @error('email')

                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>

                @enderror

            </div>


            <!-- PASSWORD -->
            <div class="mb-3">

                <label
                    for="password"
                    class="form-label"
                >
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    placeholder="Masukkan password"
                    required
                    autocomplete="current-password"
                >

                @error('password')

                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>

                @enderror

            </div>


            <!-- REMEMBER & FORGOT -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        id="remember"
                        {{ old('remember') ? 'checked' : '' }}
                    >

                    <label
                        class="form-check-label"
                        for="remember"
                    >
                        Remember Me
                    </label>

                </div>


                @if (Route::has('password.request'))

                    <a
                        class="forgot-password"
                        href="{{ route('password.request') }}"
                    >
                        Forgot Password?
                    </a>

                @endif

            </div>


            <!-- LOGIN BUTTON -->
            <button
                type="submit"
                class="login-button"
            >

                <i class="bi bi-box-arrow-in-right me-2"></i>

                Login

            </button>


        </form>


        <!-- REGISTER -->
        @if (Route::has('register'))

            <div class="login-footer">

                Belum memiliki akun?

                <a href="{{ route('register') }}">
                    Register sekarang
                </a>

            </div>

        @endif

    </div>

</div>

@endsection