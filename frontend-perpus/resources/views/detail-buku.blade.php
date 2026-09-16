@extends('layouts.app')

@section('content')

<style>
    .detail-page {
        padding: 35px 0 70px;
    }

    .detail-wrapper {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 25px;
        padding: 35px;
        box-shadow: 0 20px 60px rgba(23, 32, 51, 0.10);
    }

    /* COVER */
    .detail-cover {
        height: 450px;
        border-radius: 20px;
        background: linear-gradient(135deg, #dbeafe, #eff6ff);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3b82f6;
        font-size: 100px;
        box-shadow: 0 15px 35px rgba(23, 32, 51, 0.12);
    }

    /* INFO */
    .detail-info {
        padding: 10px 10px 10px 35px;
    }

    .detail-category {
        display: inline-block;
        background: #eff6ff;
        color: #3b82f6;
        padding: 7px 14px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .detail-title {
        font-size: 35px;
        font-weight: 800;
        color: #172033;
        margin-bottom: 10px;
    }

    .detail-author {
        color: #8b95a7;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .detail-description {
        color: #64748b;
        font-size: 13px;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    /* DATA BUKU */
    .book-data {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 25px;
    }

    .data-box {
        background: rgba(255,255,255,.65);
        border: 1px solid #e9edf3;
        border-radius: 12px;
        padding: 13px 15px;
    }

    .data-box small {
        display: block;
        color: #9aa3b1;
        font-size: 10px;
        margin-bottom: 4px;
    }

    .data-box strong {
        color: #172033;
        font-size: 13px;
    }

    /* STATUS */
    .available {
        color: #15803d !important;
    }

    .borrowed {
        color: #b45309 !important;
    }

    /* BUTTON */
    .detail-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-back {
        text-decoration: none;
        border: 1px solid #dbe3ef;
        background: white;
        color: #475569;
        padding: 11px 20px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-back:hover {
        color: #172033;
        background: #f8fafc;
    }

    .btn-pinjam {
        text-decoration: none;
        background: #3b82f6;
        color: white;
        padding: 11px 20px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-pinjam:hover {
        background: #2563eb;
        color: white;
        transform: translateY(-2px);
    }

    /* RESPONSIVE */
    @media(max-width: 768px) {

        .detail-wrapper {
            padding: 20px;
        }

        .detail-cover {
            height: 350px;
        }

        .detail-info {
            padding: 25px 5px 5px;
        }

        .detail-title {
            font-size: 28px;
        }

        .book-data {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="detail-page">

    <div class="container">

        <div class="detail-wrapper">

            <div class="row align-items-center">

                {{-- COVER BUKU --}}
                <div class="col-lg-5 mb-4 mb-lg-0">

                    <div class="detail-cover">

                        <i class="bi bi-book"></i>

                    </div>

                </div>


                {{-- DETAIL BUKU --}}
                <div class="col-lg-7">

                    <div class="detail-info">

                        <div class="detail-category">
                            PROGRAMMING
                        </div>

                        <h1 class="detail-title">
                            Belajar Laravel untuk Pemula
                        </h1>

                        <div class="detail-author">
                            <i class="bi bi-person"></i>
                            Ahmad Fauzan
                        </div>


                        <p class="detail-description">
                            Buku ini membahas dasar-dasar Laravel untuk
                            pemula. Mulai dari pengenalan Laravel,
                            routing, controller, model, migration,
                            hingga pembuatan aplikasi web sederhana.
                        </p>


                        {{-- INFORMASI BUKU --}}
                        <div class="book-data">

                            <div class="data-box">
                                <small>Penerbit</small>
                                <strong>Informatika</strong>
                            </div>

                            <div class="data-box">
                                <small>Tahun Terbit</small>
                                <strong>2025</strong>
                            </div>

                            <div class="data-box">
                                <small>Jumlah Halaman</small>
                                <strong>280 Halaman</strong>
                            </div>

                            <div class="data-box">
                                <small>Status</small>
                                <strong class="available">
                                    Tersedia
                                </strong>
                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="detail-actions">

                            <a href="{{ url('/koleksi-buku') }}" class="btn-back">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>

                            <a href="#" class="btn-pinjam">
                                <i class="bi bi-bookmark-plus"></i>
                                Pinjam Buku
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection