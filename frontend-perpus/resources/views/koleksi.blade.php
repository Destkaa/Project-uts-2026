@extends('layouts.app')

@section('content')

<style>
    .collection-page {
        padding: 20px 0 50px;
    }

    .page-header {
        background: linear-gradient(135deg, #172033, #31558f);
        border-radius: 24px;
        padding: 40px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .page-header::after {
        content: '';
        position: absolute;
        width: 250px;
        height: 250px;
        background: rgba(255,255,255,.08);
        border-radius: 50%;
        right: -80px;
        top: -100px;
    }

    .page-header h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .page-header p {
        margin: 0;
        opacity: .8;
    }

    .search-box {
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 14px;
        padding: 5px;
        margin-top: 25px;
        max-width: 600px;
        display: flex;
    }

    .search-box input {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        color: white;
        padding: 12px 15px;
    }

    .search-box input::placeholder {
        color: rgba(255,255,255,.65);
    }

    .search-box button {
        border: none;
        border-radius: 10px;
        background: white;
        color: #31558f;
        padding: 0 20px;
        font-weight: 700;
    }

    .book-card {
        background: rgba(255,255,255,.85);
        border: 1px solid rgba(255,255,255,.7);
        border-radius: 18px;
        padding: 18px;
        height: 100%;
        box-shadow: 0 10px 30px rgba(30,50,90,.08);
        transition: .3s;
    }

    .book-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(30,50,90,.15);
    }

    .book-cover {
        height: 180px;
        border-radius: 14px;
        background: linear-gradient(135deg, #eef4ff, #dbe8ff);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
    }

    .book-cover i {
        font-size: 60px;
        color: #4f6edb;
    }

    .book-category {
        font-size: 12px;
        color: #5574d8;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .book-title {
        font-size: 17px;
        font-weight: 800;
        color: #172033;
        margin-bottom: 5px;
    }

    .book-author {
        font-size: 13px;
        color: #7b8497;
        margin-bottom: 15px;
    }

    .detail-button {
        display: block;
        width: 100%;
        text-align: center;
        text-decoration: none;
        border: 1px solid #dbe3ef;
        border-radius: 10px;
        padding: 9px;
        color: #3b82f6;
        background: white;
        font-size: 13px;
        font-weight: 700;
        transition: .2s;
    }

    .detail-button:hover {
        background: #3b82f6;
        color: white;
    }
</style>

<div class="container collection-page">

    <div class="page-header">

        <h1>Koleksi Buku</h1>

        <p>
            Temukan berbagai buku menarik untuk menambah wawasan dan pengetahuanmu.
        </p>

        <form class="search-box">
            <input
                type="text"
                placeholder="Cari judul buku, penulis, atau kategori..."
            >

            <button type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

    </div>


    <div class="row g-4">

        {{-- Buku 1 --}}
        <div class="col-md-6 col-lg-3">
            <div class="book-card">

                <div class="book-cover">
                    <i class="bi bi-book"></i>
                </div>

                <div class="book-category">
                    PROGRAMMING
                </div>

                <div class="book-title">
                    Belajar Laravel untuk Pemula
                </div>

                <div class="book-author">
                    Ahmad Fauzan
                </div>

                <a href="{{ route('buku.detail', 1) }}"
                   class="detail-button">
                    Lihat Detail
                </a>

            </div>
        </div>


        {{-- Buku 2 --}}
        <div class="col-md-6 col-lg-3">
            <div class="book-card">

                <div class="book-cover">
                    <i class="bi bi-database"></i>
                </div>

                <div class="book-category">
                    DATABASE
                </div>

                <div class="book-title">
                    Dasar-Dasar Basis Data
                </div>

                <div class="book-author">
                    Budi Raharjo
                </div>

                <a href="{{ route('buku.detail', 2) }}"
                   class="detail-button">
                    Lihat Detail
                </a>

            </div>
        </div>


        {{-- Buku 3 --}}
        <div class="col-md-6 col-lg-3">
            <div class="book-card">

                <div class="book-cover">
                    <i class="bi bi-code-slash"></i>
                </div>

                <div class="book-category">
                    WEB DEVELOPMENT
                </div>

                <div class="book-title">
                    HTML, CSS & JavaScript
                </div>

                <div class="book-author">
                    Wahana Komputer
                </div>

                <a href="{{ route('buku.detail', 3) }}"
                   class="detail-button">
                    Lihat Detail
                </a>

            </div>
        </div>


        {{-- Buku 4 --}}
        <div class="col-md-6 col-lg-3">
            <div class="book-card">

                <div class="book-cover">
                    <i class="bi bi-diagram-3"></i>
                </div>

                <div class="book-category">
                    ALGORITMA
                </div>

                <div class="book-title">
                    Logika dan Algoritma
                </div>

                <div class="book-author">
                    Rinaldi Munir
                </div>

                <a href="{{ route('buku.detail', 4) }}"
                   class="detail-button">
                    Lihat Detail
                </a>

            </div>
        </div>


        {{-- Buku 5 --}}
        <div class="col-md-6 col-lg-3">
            <div class="book-card">

                <div class="book-cover">
                    <i class="bi bi-globe"></i>
                </div>

                <div class="book-category">
                    TEKNOLOGI
                </div>

                <div class="book-title">
                    Pemrograman Web Modern
                </div>

                <div class="book-author">
                    Dicoding Indonesia
                </div>

                <a href="{{ route('buku.detail', 5) }}"
                   class="detail-button">
                    Lihat Detail
                </a>

            </div>
        </div>


        {{-- Buku 6 --}}
        <div class="col-md-6 col-lg-3">
            <div class="book-card">

                <div class="book-cover">
                    <i class="bi bi-lightbulb"></i>
                </div>

                <div class="book-category">
                    PENDIDIKAN
                </div>

                <div class="book-title">
                    Belajar Efektif di Era Digital
                </div>

                <div class="book-author">
                    Siti Nurhaliza
                </div>

                <a href="{{ route('buku.detail', 6) }}"
                   class="detail-button">
                    Lihat Detail
                </a>

            </div>
        </div>


        {{-- Buku 7 --}}
        <div class="col-md-6 col-lg-3">
            <div class="book-card">

                <div class="book-cover">
                    <i class="bi bi-bookmark-heart"></i>
                </div>

                <div class="book-category">
                    NOVEL
                </div>

                <div class="book-title">
                    Senja di Perpustakaan
                </div>

                <div class="book-author">
                    Dewi Lestari
                </div>

                <a href="{{ route('buku.detail', 7) }}"
                   class="detail-button">
                    Lihat Detail
                </a>

            </div>
        </div>

    </div>

</div>

@endsection