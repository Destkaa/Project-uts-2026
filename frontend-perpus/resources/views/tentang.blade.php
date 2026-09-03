@extends('layouts.app')

@section('content')

<style>
    .about-page {
        padding: 20px 0 60px;
    }

    .about-hero {
        background: linear-gradient(135deg, #172033, #31558f);
        color: white;
        border-radius: 25px;
        padding: 55px 40px;
        text-align: center;
        margin-bottom: 35px;
    }

    .about-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        border-radius: 24px;
        background: rgba(255,255,255,.15);
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }

    .about-icon i {
        font-size: 38px;
    }

    .about-hero h1 {
        font-size: 35px;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .about-hero p {
        max-width: 650px;
        margin: auto;
        opacity: .8;
        line-height: 1.7;
    }

    .about-card {
        background: rgba(255,255,255,.85);
        border: 1px solid #e5eaf2;
        border-radius: 20px;
        padding: 30px;
        height: 100%;
        box-shadow: 0 10px 30px rgba(30,50,90,.07);
    }

    .about-card h3 {
        font-size: 20px;
        font-weight: 800;
        color: #172033;
        margin-bottom: 15px;
    }

    .about-card p {
        color: #687386;
        line-height: 1.8;
        font-size: 14px;
    }

    .feature {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .feature-icon {
        min-width: 45px;
        height: 45px;
        border-radius: 13px;
        background: #edf3ff;
        color: #4f6edb;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .feature h5 {
        font-size: 15px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .feature p {
        margin: 0;
        font-size: 13px;
    }
</style>

<div class="container about-page">

    <div class="about-hero">

        <div class="about-icon">
            <i class="bi bi-book-half"></i>
        </div>

        <h1>Tentang Perpustakaan</h1>

        <p>
            Platform perpustakaan digital yang membantu pengguna
            menemukan dan menjelajahi berbagai koleksi buku dengan
            lebih mudah dan nyaman.
        </p>

    </div>


    <div class="row g-4">

        <div class="col-lg-6">

            <div class="about-card">

                <h3>
                    <i class="bi bi-stars"></i>
                    Tentang Website
                </h3>

                <p>
                    Website perpustakaan ini dibuat untuk memberikan
                    pengalaman yang sederhana, modern, dan nyaman dalam
                    mencari informasi mengenai koleksi buku.
                </p>

                <p>
                    Pengguna dapat melihat koleksi buku, mencari buku,
                    melihat kategori, serta mengetahui informasi detail
                    dari setiap buku.
                </p>

            </div>

        </div>


        <div class="col-lg-6">

            <div class="about-card">

                <h3>
                    <i class="bi bi-lightning-charge"></i>
                    Fitur Utama
                </h3>


                <div class="feature">

                    <div class="feature-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <div>
                        <h5>Pencarian Buku</h5>
                        <p>
                            Memudahkan pengguna menemukan buku.
                        </p>
                    </div>

                </div>


                <div class="feature">

                    <div class="feature-icon">
                        <i class="bi bi-grid"></i>
                    </div>

                    <div>
                        <h5>Kategori Buku</h5>
                        <p>
                            Koleksi buku dikelompokkan berdasarkan kategori.
                        </p>
                    </div>

                </div>


                <div class="feature">

                    <div class="feature-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>

                    <div>
                        <h5>Detail Buku</h5>
                        <p>
                            Pengguna dapat melihat informasi lengkap buku.
                        </p>
                    </div>

                </div>


                <div class="feature">

                    <div class="feature-icon">
                        <i class="bi bi-person-check"></i>
                    </div>

                    <div>
                        <h5>Member</h5>
                        <p>
                            Pengguna dapat menggunakan fitur perpustakaan
                            setelah login.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection