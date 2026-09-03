@extends('layouts.app')

@section('content')

<style>
    .category-page {
        padding: 20px 0 50px;
    }

    .category-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .category-header h1 {
        font-size: 32px;
        font-weight: 800;
        color: #172033;
    }

    .category-header p {
        color: #7b8497;
    }

    .category-card {
        position: relative;
        overflow: hidden;
        background: rgba(255,255,255,.85);
        border: 1px solid rgba(220,228,240,.8);
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        height: 100%;
        box-shadow: 0 10px 30px rgba(30,50,90,.07);
        transition: .3s;
    }

    .category-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 18px 40px rgba(30,50,90,.13);
    }

    .category-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 18px;
        border-radius: 18px;
        background: linear-gradient(135deg, #edf3ff, #dce8ff);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .category-icon i {
        font-size: 28px;
        color: #4f6edb;
    }

    .category-card h3 {
        font-size: 18px;
        font-weight: 800;
        color: #172033;
    }

    .category-card p {
        color: #7b8497;
        font-size: 13px;
        margin-bottom: 18px;
    }

    .category-link {
        text-decoration: none;
        color: #4f6edb;
        font-weight: 700;
        font-size: 13px;
    }
</style>

<div class="container category-page">

    <div class="category-header">

        <h1>Kategori Buku</h1>

        <p>
            Jelajahi koleksi buku berdasarkan kategori yang kamu sukai.
        </p>

    </div>


    <div class="row g-4">

        <div class="col-md-6 col-lg-3">
            <div class="category-card">

                <div class="category-icon">
                    <i class="bi bi-code-slash"></i>
                </div>

                <h3>Programming</h3>

                <p>
                    Buku tentang pemrograman dan bahasa pemrograman.
                </p>

                <a href="{{ route('koleksi') }}" class="category-link">
                    Lihat Buku →
                </a>

            </div>
        </div>


        <div class="col-md-6 col-lg-3">
            <div class="category-card">

                <div class="category-icon">
                    <i class="bi bi-database"></i>
                </div>

                <h3>Database</h3>

                <p>
                    Buku mengenai database dan pengelolaan data.
                </p>

                <a href="{{ route('koleksi') }}" class="category-link">
                    Lihat Buku →
                </a>

            </div>
        </div>


        <div class="col-md-6 col-lg-3">
            <div class="category-card">

                <div class="category-icon">
                    <i class="bi bi-globe"></i>
                </div>

                <h3>Web Development</h3>

                <p>
                    Buku tentang pembuatan website dan teknologi web.
                </p>

                <a href="{{ route('koleksi') }}" class="category-link">
                    Lihat Buku →
                </a>

            </div>
        </div>


        <div class="col-md-6 col-lg-3">
            <div class="category-card">

                <div class="category-icon">
                    <i class="bi bi-mortarboard"></i>
                </div>

                <h3>Pendidikan</h3>

                <p>
                    Buku untuk pembelajaran dan pengembangan pengetahuan.
                </p>

                <a href="{{ route('koleksi') }}" class="category-link">
                    Lihat Buku →
                </a>

            </div>
        </div>


        <div class="col-md-6 col-lg-3">
            <div class="category-card">

                <div class="category-icon">
                    <i class="bi bi-diagram-3"></i>
                </div>

                <h3>Algoritma</h3>

                <p>
                    Buku tentang logika dan algoritma pemrograman.
                </p>

                <a href="{{ route('koleksi') }}" class="category-link">
                    Lihat Buku →
                </a>

            </div>
        </div>


        <div class="col-md-6 col-lg-3">
            <div class="category-card">

                <div class="category-icon">
                    <i class="bi bi-cpu"></i>
                </div>

                <h3>Teknologi</h3>

                <p>
                    Berbagai buku tentang perkembangan teknologi.
                </p>

                <a href="{{ route('koleksi') }}" class="category-link">
                    Lihat Buku →
                </a>

            </div>
        </div>


        <div class="col-md-6 col-lg-3">
            <div class="category-card">

                <div class="category-icon">
                    <i class="bi bi-book"></i>
                </div>

                <h3>Novel</h3>

                <p>
                    Koleksi novel dan buku cerita untuk dibaca.
                </p>

                <a href="{{ route('koleksi') }}" class="category-link">
                    Lihat Buku →
                </a>

            </div>
        </div>

    </div>

</div>

@endsection