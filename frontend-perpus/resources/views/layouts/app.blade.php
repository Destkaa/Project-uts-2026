<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Library') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=Nunito:300,400,500,600,700,800,900"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>


    <style>

        /* =====================================================
           GLOBAL
        ===================================================== */

        :root {

            --primary: #4f7cff;
            --primary-light: #6ea8ff;
            --purple: #8b5cf6;

            --text: #172033;
            --muted: #718096;

            --glass: rgba(255, 255, 255, 0.72);
            --glass-border: rgba(255, 255, 255, 0.65);

        }


        body {

            margin: 0;

            font-family: 'Nunito', sans-serif;

            background:

                radial-gradient(
                    circle at 10% 20%,
                    rgba(79, 124, 255, .08),
                    transparent 30%
                ),

                radial-gradient(
                    circle at 90% 80%,
                    rgba(139, 92, 246, .07),
                    transparent 30%
                ),

                #f7f9fc;

            color: var(--text);

        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .future-navbar {

            position: sticky;

            top: 12px;

            /* DIPERBESAR AGAR DROPDOWN DI ATAS KONTEN */
            z-index: 9999;

            width: calc(100% - 32px);

            margin: 12px auto 0;

            border-radius: 20px;

            background: var(--glass);

            backdrop-filter: blur(22px);

            -webkit-backdrop-filter: blur(22px);

            border: 1px solid var(--glass-border);

            box-shadow:

                0 10px 35px rgba(30, 60, 100, .08),

                inset 0 1px 0 rgba(255,255,255,.8);

            transition: all .35s ease;

            /*
             * PENTING:
             * Jangan gunakan overflow:hidden
             * karena akan memotong dropdown.
             */
            overflow: visible !important;

        }


        /* garis cahaya */

        .future-navbar::before {

            content: "";

            position: absolute;

            top: 0;

            left: 10%;

            width: 80%;

            height: 1px;

            background: linear-gradient(

                90deg,

                transparent,

                rgba(79,124,255,.8),

                rgba(139,92,246,.8),

                transparent

            );

            filter: blur(.5px);

            opacity: .8;

            pointer-events: none;

        }


        /* efek glow bawah */

        .future-navbar::after {

            content: "";

            position: absolute;

            width: 220px;

            height: 80px;

            left: 50%;

            bottom: -70px;

            transform: translateX(-50%);

            background: rgba(79,124,255,.16);

            filter: blur(35px);

            pointer-events: none;

            z-index: -1;

        }


        .future-navbar:hover {

            box-shadow:

                0 15px 45px rgba(30,60,100,.12),

                0 0 30px rgba(79,124,255,.06),

                inset 0 1px 0 rgba(255,255,255,.9);

        }


        .future-navbar .container {

            position: relative;

            z-index: 2;

            padding: 0 8px;

        }


        /* =====================================================
           BRAND
        ===================================================== */

        .future-brand {

            display: flex;

            align-items: center;

            gap: 11px;

            text-decoration: none;

            color: var(--text) !important;

            font-size: 20px;

            font-weight: 800;

            letter-spacing: -.5px;

            transition: .3s ease;

        }


        .future-brand:hover {

            transform: translateY(-1px);

            color: var(--primary) !important;

        }


        /* logo */

        .future-logo {

            position: relative;

            width: 43px;

            height: 43px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 14px;

            color: white;

            font-size: 20px;

            background:

                linear-gradient(

                    135deg,

                    #4f7cff,

                    #7657ff

                );

            box-shadow:

                0 8px 20px rgba(79,124,255,.28),

                inset 0 1px 0 rgba(255,255,255,.4);

            transition: .35s ease;

        }


        .future-logo::before {

            content: "";

            position: absolute;

            inset: -3px;

            border-radius: 17px;

            border: 1px solid rgba(79,124,255,.25);

            opacity: 0;

            transform: scale(.8);

            transition: .35s ease;

        }


        .future-brand:hover .future-logo {

            transform: rotate(-5deg) scale(1.05);

            box-shadow:

                0 10px 30px rgba(79,124,255,.4),

                0 0 20px rgba(79,124,255,.18);

        }


        .future-brand:hover .future-logo::before {

            opacity: 1;

            transform: scale(1.1);

        }


        /* =====================================================
           NAV MENU
        ===================================================== */

        .future-menu {

            margin-left: 35px;

            gap: 5px;

        }


        .future-menu .nav-link {

            position: relative;

            display: flex;

            align-items: center;

            gap: 6px;

            padding: 9px 13px !important;

            border-radius: 11px;

            color: #667085 !important;

            font-size: 13px;

            font-weight: 600;

            transition:

                color .25s ease,

                background .25s ease,

                transform .25s ease;

        }


        .future-menu .nav-link i {

            font-size: 14px;

            transition: .25s ease;

        }


        /* hover */

        .future-menu .nav-link:hover {

            color: var(--primary) !important;

            background:

                rgba(255,255,255,.65);

            transform: translateY(-1px);

            box-shadow:

                0 5px 15px rgba(50,80,130,.05);

        }


        .future-menu .nav-link:hover i {

            transform: translateY(-2px);

            filter:

                drop-shadow(

                    0 0 5px

                    rgba(79,124,255,.45)

                );

        }


        /* garis aktif */

        .future-menu .nav-link.active {

            color: var(--primary) !important;

            background:

                rgba(79,124,255,.08);

        }


        .future-menu .nav-link.active::after {

            content: "";

            position: absolute;

            left: 18%;

            right: 18%;

            bottom: 3px;

            height: 2px;

            border-radius: 20px;

            background:

                linear-gradient(

                    90deg,

                    var(--primary),

                    var(--purple)

                );

            box-shadow:

                0 0 8px rgba(79,124,255,.5);

        }


        /* =====================================================
           LOGIN
        ===================================================== */

        .future-login {

            display: flex;

            align-items: center;

            gap: 6px;

            padding: 9px 14px !important;

            border-radius: 11px;

            color: #667085 !important;

            font-size: 13px;

            font-weight: 600;

            transition: .25s ease;

        }


        .future-login:hover {

            color: var(--primary) !important;

            background:

                rgba(255,255,255,.7);

            transform: translateY(-1px);

        }


        /* =====================================================
           REGISTER
        ===================================================== */

        .future-register {

            position: relative;

            display: flex;

            align-items: center;

            gap: 7px;

            padding: 9px 17px;

            border: 0;

            border-radius: 11px;

            color: white !important;

            font-size: 13px;

            font-weight: 700;

            text-decoration: none;

            background:

                linear-gradient(

                    135deg,

                    #4f7cff,

                    #7657ff

                );

            box-shadow:

                0 7px 18px rgba(79,124,255,.25);

            overflow: hidden;

            transition: .3s ease;

        }


        /* efek cahaya lewat */

        .future-register::before {

            content: "";

            position: absolute;

            top: 0;

            left: -100%;

            width: 70%;

            height: 100%;

            background:

                linear-gradient(

                    90deg,

                    transparent,

                    rgba(255,255,255,.35),

                    transparent

                );

            transform: skewX(-20deg);

            transition: .6s ease;

        }


        .future-register:hover::before {

            left: 140%;

        }


        .future-register:hover {

            transform: translateY(-2px);

            box-shadow:

                0 10px 25px rgba(79,124,255,.35),

                0 0 20px rgba(79,124,255,.12);

            color: white !important;

        }


        /* =====================================================
           USER PROFILE
        ===================================================== */

        .future-user {

            display: flex;

            align-items: center;

            gap: 8px;

            padding: 5px 9px 5px 6px !important;

            border-radius: 30px;

            color: #3d4655 !important;

            font-size: 13px;

            font-weight: 700;

            background:

                rgba(255,255,255,.75);

            border:

                1px solid rgba(255,255,255,.9);

            box-shadow:

                0 4px 15px rgba(30,50,80,.08);

            transition: .3s ease;

        }


        .future-user:hover {

            color: var(--primary) !important;

            background:

                rgba(255,255,255,.95);

            transform: translateY(-1px);

            box-shadow:

                0 7px 20px rgba(30,50,80,.12);

        }


        .user-avatar {

            width: 34px;

            height: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            color: white;

            background:

                linear-gradient(

                    135deg,

                    #4f7cff,

                    #8b5cf6

                );

            box-shadow:

                0 4px 12px rgba(79,124,255,.25);

        }


        /* =====================================================
           DROPDOWN
        ===================================================== */

        /*
         * Ini bagian yang diperbaiki.
         */

        .future-navbar .dropdown {

            position: relative !important;

            z-index: 10000 !important;

        }


        .future-dropdown {

            position: absolute !important;

            top: calc(100% + 12px) !important;

            right: 0 !important;

            left: auto !important;

            margin: 0 !important;

            min-width: 230px;

            padding: 8px !important;

            border: 1px solid rgba(255,255,255,.85) !important;

            border-radius: 17px !important;

            background:

                rgba(255,255,255,.94) !important;

            backdrop-filter: blur(20px);

            -webkit-backdrop-filter: blur(20px);

            box-shadow:

                0 20px 45px rgba(30,50,80,.18),

                0 5px 20px rgba(79,124,255,.08),

                inset 0 1px 0 rgba(255,255,255,.9);

            z-index: 99999 !important;

            transform-origin: top right;

            animation:

                dropdownIn .25s ease;

        }


        @keyframes dropdownIn {

            from {

                opacity: 0;

                transform:

                    translateY(-8px)

                    scale(.97);

            }

            to {

                opacity: 1;

                transform:

                    translateY(0)

                    scale(1);

            }

        }


        .future-dropdown .dropdown-header {

            padding: 10px 12px;

            display: flex;

            flex-direction: column;

        }


        .future-dropdown .dropdown-header small {

            color: #98a2b3;

            font-size: 10px;

            letter-spacing: .5px;

        }


        .future-dropdown .dropdown-header strong {

            margin-top: 2px;

            color: #293241;

            font-size: 13px;

        }


        .future-dropdown .dropdown-divider {

            border-color: rgba(100,120,150,.12);

        }


        .future-dropdown .dropdown-item {

            display: flex;

            align-items: center;

            gap: 8px;

            padding: 10px 12px;

            border-radius: 10px;

            color: #596273;

            font-size: 13px;

            font-weight: 600;

            transition: .2s ease;

        }


        .future-dropdown .dropdown-item i {

            width: 20px;

            font-size: 15px;

        }


        .future-dropdown .dropdown-item:hover {

            color: var(--primary);

            background:

                rgba(79,124,255,.08);

            transform: translateX(3px);

        }


        .future-dropdown .logout-item:hover {

            color: #ef4444;

            background:

                rgba(239,68,68,.07);

        }


        /* =====================================================
           CONTENT
        ===================================================== */

        main {

            min-height:

                calc(100vh - 100px);

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 768px) {

            .future-navbar {

                top: 7px;

                width:

                    calc(100% - 14px);

                margin-top: 7px;

                border-radius: 16px;

            }


            .future-menu {

                margin-left: 0;

                margin-top: 15px;

                padding: 5px;

                border-radius: 13px;

                background:

                    rgba(255,255,255,.45);

            }


            .future-menu .nav-link {

                padding: 11px 13px !important;

            }


            .future-login {

                margin-top: 10px;

            }


            .future-register {

                margin-top: 7px;

                width: fit-content;

            }


            .future-user {

                margin-top: 10px;

            }


            /*
             * Dropdown mobile
             */

            .future-dropdown {

                position: absolute !important;

                top: calc(100% + 8px) !important;

                right: 0 !important;

                left: auto !important;

                min-width: 220px;

            }

        }

    </style>

</head>


<body>

    <div id="app">


        <!-- =====================================================
             FUTURISTIC NAVBAR
        ===================================================== -->

        <nav class="navbar navbar-expand-md future-navbar">

            <div class="container">


                <!-- BRAND -->

                <a
                    class="navbar-brand future-brand"
                    href="{{ url('/home') }}"
                >

                    <span class="future-logo">

                        <i class="bi bi-book-half"></i>

                    </span>

                    <span>

                        {{ config('app.name', 'Library') }}

                    </span>

                </a>


                <!-- MOBILE BUTTON -->

                <button
                    class="navbar-toggler border-0 shadow-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}"
                >

                    <span class="navbar-toggler-icon"></span>

                </button>


                <!-- MENU -->

                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >


                    <!-- LEFT MENU -->

                    <ul class="navbar-nav me-auto future-menu">


                        <!-- BERANDA -->

                        <li class="nav-item">

                            <a
                                href="{{ url('/home') }}"
                                class="nav-link {{ request()->is('home') ? 'active' : '' }}"
                            >

                                <i class="bi bi-house-door"></i>

                                Beranda

                            </a>

                        </li>


                        <!-- KOLEKSI -->

                        <li class="nav-item">

                            <a
                                href="{{ route('koleksi') }}"
                                class="nav-link {{ request()->is('koleksi-buku') ? 'active' : '' }}"
                            >

                                <i class="bi bi-book"></i>

                                Koleksi Buku

                            </a>

                        </li>


                        <!-- KATEGORI -->

                        <li class="nav-item">

                            <a
                                href="{{ route('kategori') }}"
                                class="nav-link {{ request()->is('kategori') ? 'active' : '' }}"
                            >

                                <i class="bi bi-grid"></i>

                                Kategori

                            </a>

                        </li>


                        <!-- TENTANG -->

                        <li class="nav-item">

                            <a
                                href="{{ route('tentang') }}"
                                class="nav-link {{ request()->is('tentang') ? 'active' : '' }}"
                            >

                                <i class="bi bi-info-circle"></i>

                                Tentang

                            </a>

                        </li>


                    </ul>


                    <!-- RIGHT MENU -->

                    <ul class="navbar-nav ms-auto align-items-md-center">


                        @guest


                            <!-- LOGIN -->

                            @if (Route::has('login'))

                                <li class="nav-item">

                                    <a
                                        class="nav-link future-login"
                                        href="{{ route('login') }}"
                                    >

                                        <i class="bi bi-box-arrow-in-right"></i>

                                        <span>Login</span>

                                    </a>

                                </li>

                            @endif


                            <!-- REGISTER -->

                            @if (Route::has('register'))

                                <li class="nav-item ms-md-2">

                                    <a
                                        class="future-register"
                                        href="{{ route('register') }}"
                                    >

                                        <i class="bi bi-person-plus"></i>

                                        <span>Daftar</span>

                                    </a>

                                </li>

                            @endif


                        @else


                            <!-- USER -->

                            <li class="nav-item dropdown">

                                <a
                                    id="navbarDropdown"
                                    class="nav-link dropdown-toggle future-user"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    v-pre
                                >

                                    <span class="user-avatar">

                                        <i class="bi bi-person"></i>

                                    </span>


                                    <span>

                                        {{ Auth::user()->name }}

                                    </span>

                                </a>


                                <!-- DROPDOWN -->

                                <div
                                    class="dropdown-menu dropdown-menu-end future-dropdown"
                                    aria-labelledby="navbarDropdown"
                                >


                                    <div class="dropdown-header">

                                        <small>

                                            AKUN PERPUSTAKAAN

                                        </small>

                                        <strong>

                                            {{ Auth::user()->name }}

                                        </strong>

                                    </div>


                                    <div class="dropdown-divider"></div>


                                    <!-- PROFIL -->

                                    <a
                                        class="dropdown-item"
                                        href="#"
                                    >

                                        <i class="bi bi-person-circle"></i>

                                        Profil

                                    </a>


                                    <!-- BUKU SAYA -->

                                    <a
                                        class="dropdown-item"
                                        href="#"
                                    >

                                        <i class="bi bi-journal-bookmark"></i>

                                        Buku Saya

                                    </a>


                                    <div class="dropdown-divider"></div>


                                    <!-- LOGOUT -->

                                    <a
                                        class="dropdown-item logout-item"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                    >

                                        <i class="bi bi-box-arrow-right"></i>

                                        Logout

                                    </a>


                                    <form
                                        id="logout-form"
                                        action="{{ route('logout') }}"
                                        method="POST"
                                        class="d-none"
                                    >

                                        @csrf

                                    </form>


                                </div>

                            </li>


                        @endguest


                    </ul>


                </div>

            </div>

        </nav>


        <!-- CONTENT -->

        <main class="py-4">

            @yield('content')

        </main>


    </div>

</body>

</html>