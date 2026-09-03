@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f8fafc;
        color: #172033;
    }

    .library-home {
        padding-bottom: 60px;
    }

    /* HERO */
    .hero {
        background: linear-gradient(135deg, #172033, #31558f);
        border-radius: 24px;
        padding: 70px 60px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 45px;
    }

    .hero::before {
        content: "";
        position: absolute;
        width: 350px;
        height: 350px;
        border-radius: 50%;
        background: rgba(255,255,255,.05);
        right: -100px;
        top: -150px;
    }

    .hero::after {
        content: "";
        position: absolute;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(96,165,250,.12);
        right: 200px;
        bottom: -130px;
    }

    .hero-content {
        max-width: 700px;
        position: relative;
        z-index: 2;
    }

    .hero-label {
        display: inline-block;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.15);
        padding: 7px 14px;
        border-radius: 30px;
        font-size: 12px;
        margin-bottom: 18px;
    }

    .hero h1 {
        font-size: 43px;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 15px;
    }

    .hero h1 span {
        color: #60a5fa;
    }

    .hero p {
        color: #d3dbea;
        font-size: 14px;
        line-height: 1.8;
        max-width: 600px;
        margin-bottom: 28px;
    }

    /* SEARCH */
    .search-box {
        background: white;
        border-radius: 12px;
        padding: 7px;
        display: flex;
        max-width: 600px;
    }

    .search-box i {
        color: #9aa4b2;
        font-size: 18px;
        margin: auto 12px;
    }

    .search-box input {
        border: none;
        outline: none;
        flex: 1;
        font-size: 13px;
        color: #374151;
    }

    .search-box button {
        border: none;
        background: #3b82f6;
        color: white;
        padding: 11px 20px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
    }

    .search-box button:hover {
        background: #2563eb;
    }


    /* SECTION */
    .section-title {
        margin-bottom: 22px;
    }

    .section-title h3 {
        font-size: 21px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .section-title p {
        color: #8b95a7;
        font-size: 12px;
        margin: 0;
    }

    .see-more {
        float: right;
        color: #3b82f6;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
    }


    /* CATEGORY */
    .category-card {
        background: white;
        border: 1px solid #e9edf3;
        border-radius: 15px;
        padding: 22px;
        text-align: center;
        text-decoration: none;
        color: #172033;
        transition: .2s;
        display: block;
    }

    .category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(20,35,60,.07);
        color: #172033;
    }

    .category-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: #eff6ff;
        color: #3b82f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        margin: auto auto 13px;
    }

    .category-card h6 {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .category-card small {
        color: #9aa3b1;
        font-size: 10px;
    }


    /* BOOK */
    .book-card {
        background: white;
        border: 1px solid #e9edf3;
        border-radius: 15px;
        overflow: hidden;
        height: 100%;
        transition: .2s;
    }

    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(20,35,60,.08);
    }

    .book-cover {
        height: 210px;
        background: linear-gradient(135deg,#dbeafe,#eff6ff);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3b82f6;
        font-size: 60px;
        position: relative;
    }

    .book-status {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #dcfce7;
        color: #15803d;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 600;
    }

    .book-info {
        padding: 18px;
    }

    .book-category {
        color: #3b82f6;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .book-info h5 {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .book-author {
        color: #8b95a7;
        font-size: 11px;
        margin-bottom: 15px;
    }

    .book-button {
        width: 100%;
        border: 1px solid #dbe3ef;
        background: white;
        color: #3b82f6;
        border-radius: 8px;
        padding: 9px;
        font-size: 11px;
        font-weight: 600;
    
        display: block;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }
    
    .book-button:hover {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }


    /* PROMO */
    .member-box {
        background: #eef6ff;
        border: 1px solid #dbeafe;
        border-radius: 18px;
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .member-box h4 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .member-box p {
        color: #64748b;
        font-size: 12px;
        margin: 0;
    }

    .member-button {
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 11px 20px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .member-button:hover {
        background: #2563eb;
        color: white;
    }


    @media(max-width:768px) {

        .hero {
            padding: 40px 25px;
        }

        .hero h1 {
            font-size: 30px;
        }

        .search-box {
            display: block;
            padding: 10px;
        }

        .search-box input {
            width: 100%;
            height: 40px;
        }

        .search-box button {
            width: 100%;
            margin-top: 5px;
        }

        .member-box {
            display: block;
        }

        .member-button {
            display: inline-block;
            margin-top: 18px;
        }

    }

</style>


<div class="library-home">

    <div class="container">


        <!-- =========================
             HERO
        ========================== -->

        <section class="hero">

            <div class="hero-content">

                <div class="hero-label">

                    <i class="bi bi-book me-1"></i>

                    Perpustakaan Digital

                </div>


                <h1>

                    Temukan Buku.
                    <br>

                    <span>Temukan Pengetahuan.</span>

                </h1>


                <p>

                    Jelajahi berbagai koleksi buku yang tersedia
                    di perpustakaan kami. Cari buku favoritmu,
                    baca informasinya, dan pinjam dengan mudah.

                </p>


                <!-- SEARCH -->

                <div class="search-box">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        placeholder="Cari judul buku atau nama penulis..."
                    >

                    <button>

                        Cari Buku

                    </button>

                </div>

            </div>

        </section>



        <!-- =========================
             KATEGORI
        ========================== -->

        <div class="section-title">

            <a href="#" class="see-more">
                Lihat Semua →
            </a>

            <h3>
                Jelajahi Kategori
            </h3>

            <p>
                Temukan buku berdasarkan kategori yang kamu sukai.
            </p>

        </div>


        <div class="row g-3 mb-5">


            <div class="col-lg-3 col-md-6">

                <a href="#" class="category-card">

                    <div class="category-icon">
                        <i class="bi bi-code-slash"></i>
                    </div>

                    <h6>
                        Teknologi
                    </h6>

                    <small>
                        248 koleksi buku
                    </small>

                </a>

            </div>


            <div class="col-lg-3 col-md-6">

                <a href="#" class="category-card">

                    <div class="category-icon">
                        <i class="bi bi-flask"></i>
                    </div>

                    <h6>
                        Sains
                    </h6>

                    <small>
                        185 koleksi buku
                    </small>

                </a>

            </div>


            <div class="col-lg-3 col-md-6">

                <a href="#" class="category-card">

                    <div class="category-icon">
                        <i class="bi bi-calculator"></i>
                    </div>

                    <h6>
                        Matematika
                    </h6>

                    <small>
                        126 koleksi buku
                    </small>

                </a>

            </div>


            <div class="col-lg-3 col-md-6">

                <a href="#" class="category-card">

                    <div class="category-icon">
                        <i class="bi bi-palette"></i>
                    </div>

                    <h6>
                        Seni & Sastra
                    </h6>

                    <small>
                        214 koleksi buku
                    </small>

                </a>

            </div>

        </div>



       {{-- =========================
            BUKU POPULER
       ========================== --}}
       
       <div class="section-title">
           <a href="#" class="see-more">
               Lihat Semua →
           </a>
       
           <h3>
               Buku Populer
           </h3>
       
           <p>
               Koleksi buku yang sedang banyak diminati.
           </p>
       </div>
       
       
       <div class="row g-4 mb-5">
       
           {{-- BOOK 1 --}}
           <div class="col-lg-3 col-md-6">
       
               <div class="book-card">
       
                   <div class="book-cover">
       
                       <span class="book-status">
                           Tersedia
                       </span>
       
                       <i class="bi bi-book"></i>
       
                   </div>
       
       
                   <div class="book-info">
       
                       <div class="book-category">
                           Programming
                       </div>
       
                       <h5>
                           Belajar Laravel untuk Pemula
                       </h5>
       
                       <div class="book-author">
                           Ahmad Fauzan
                       </div>
       
                       <a href="{{ route('buku.detail', 1) }}"
                          class="book-button">
       
                           Lihat Detail
       
                       </a>
       
                   </div>
       
               </div>
       
           </div>
       
       
           {{-- BOOK 2 --}}
           <div class="col-lg-3 col-md-6">
       
               <div class="book-card">
       
                   <div class="book-cover"
                        style="background:linear-gradient(135deg,#dcfce7,#f0fdf4);color:#16a34a;">
       
                       <span class="book-status">
                           Tersedia
                       </span>
       
                       <i class="bi bi-database"></i>
       
                   </div>
       
       
                   <div class="book-info">
       
                       <div class="book-category">
                           Database
                       </div>
       
                       <h5>
                           Dasar-Dasar Basis Data
                       </h5>
       
                       <div class="book-author">
                           Budi Raharjo
                       </div>
       
                       <a href="{{ route('buku.detail', 2) }}"
                          class="book-button">
       
                           Lihat Detail
       
                       </a>
       
                   </div>
       
               </div>
       
           </div>
       
       
           {{-- BOOK 3 --}}
           <div class="col-lg-3 col-md-6">
       
               <div class="book-card">
       
                   <div class="book-cover"
                        style="background:linear-gradient(135deg,#fef3c7,#fffbeb);color:#d97706;">
       
                       <span class="book-status">
                           Tersedia
                       </span>
       
                       <i class="bi bi-laptop"></i>
       
                   </div>
       
       
                   <div class="book-info">
       
                       <div class="book-category">
                           Web Development
                       </div>
       
                       <h5>
                           HTML, CSS & JavaScript
                       </h5>
       
                       <div class="book-author">
                           Wahana Komputer
                       </div>
       
                       <a href="{{ route('buku.detail', 3) }}"
                          class="book-button">
       
                           Lihat Detail
       
                       </a>
       
                   </div>
       
               </div>
       
           </div>
       
       
           {{-- BOOK 4 --}}
           <div class="col-lg-3 col-md-6">
       
               <div class="book-card">
       
                   <div class="book-cover"
                        style="background:linear-gradient(135deg,#f3e8ff,#faf5ff);color:#9333ea;">
       
                       <span class="book-status"
                             style="background:#fef3c7;color:#b45309;">
       
                           Dipinjam
       
                       </span>
       
                       <i class="bi bi-braces"></i>
       
                   </div>
       
       
                   <div class="book-info">
       
                       <div class="book-category">
                           Algoritma
                       </div>
       
                       <h5>
                           Logika dan Algoritma
                       </h5>
       
                       <div class="book-author">
                           Rinaldi Munir
                       </div>
       
                       <a href="{{ route('buku.detail', 4) }}"
                          class="book-button">
       
                           Lihat Detail
       
                       </a>
       
                   </div>
       
               </div>
       
           </div>
       
       </div>



        {{-- =========================
             BUKU TERBARU
        ========================== --}}
        
        <div class="section-title">
        
            <h3>
                Buku Terbaru
            </h3>
        
            <p>
                Koleksi terbaru yang baru saja ditambahkan.
            </p>
        
        </div>
        
        
        <div class="row g-4 mb-5">
        
        
            {{-- BOOK 5 --}}
            <div class="col-lg-4">
        
                <div class="book-card">
        
                    <div class="book-info">
        
                        <div class="book-category">
                            Teknologi
                        </div>
        
                        <h5>
                            Pemrograman Web Modern
                        </h5>
        
                        <div class="book-author">
                            Dicoding Indonesia
                        </div>
        
                        <p class="text-muted"
                           style="font-size:11px;">
        
                            Pelajari konsep pengembangan
                            website modern dari dasar hingga
                            tingkat lanjut.
        
                        </p>
        
                        <a href="{{ route('buku.detail', 5) }}"
                           class="book-button">
        
                            Lihat Detail
        
                        </a>
        
                    </div>
        
                </div>
        
            </div>
        
        
            {{-- BOOK 6 --}}
            <div class="col-lg-4">
        
                <div class="book-card">
        
                    <div class="book-info">
        
                        <div class="book-category">
                            Pendidikan
                        </div>
        
                        <h5>
                            Belajar Efektif di Era Digital
                        </h5>
        
                        <div class="book-author">
                            Siti Nurhaliza
                        </div>
        
                        <p class="text-muted"
                           style="font-size:11px;">
        
                            Panduan belajar dan mengembangkan
                            kemampuan di era teknologi digital.
        
                        </p>
        
                        <a href="{{ route('buku.detail', 6) }}"
                           class="book-button">
        
                            Lihat Detail
        
                        </a>
        
                    </div>
        
                </div>
        
            </div>
        
        
            {{-- BOOK 7 --}}
            <div class="col-lg-4">
        
                <div class="book-card">
        
                    <div class="book-info">
        
                        <div class="book-category">
                            Novel
                        </div>
        
                        <h5>
                            Senja di Perpustakaan
                        </h5>
        
                        <div class="book-author">
                            Dewi Lestari
                        </div>
        
                        <p class="text-muted"
                           style="font-size:11px;">
        
                            Sebuah cerita tentang persahabatan,
                            mimpi, dan perjalanan kehidupan.
        
                        </p>
        
                        <a href="{{ route('buku.detail', 7) }}"
                           class="book-button">
        
                            Lihat Detail
        
                        </a>
        
                    </div>
        
                </div>
        
            </div>
        
        </div>



        <!-- =========================
             MEMBER CTA
        ========================== -->

        <div class="member-box">

            <div>

                <h4>
                    Ingin mulai meminjam buku?
                </h4>

                <p>
                    Daftar sebagai anggota dan nikmati kemudahan
                    mengakses koleksi perpustakaan.
                </p>

            </div>


            <a href="{{ Route::has('register') ? route('register') : '#' }}"
               class="member-button">

                <i class="bi bi-person-plus me-1"></i>

                Daftar Sekarang

            </a>

        </div>


    </div>

</div>

@endsection