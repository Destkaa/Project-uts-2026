@extends('layouts.app')

@section('title', 'Dashboard - LibraSpace')

@section('content')

    <!-- PAGE TITLE -->
    <div class="page-title">

        <div>
            <h2>Dashboard</h2>

            <p>
                Selamat datang kembali, Admin 👋
                Berikut ringkasan perpustakaan hari ini.
            </p>
        </div>

        <a href="#" class="btn-primary-custom">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Buku
        </a>

    </div>


    <!-- STATISTIK -->
    <div class="row g-4 mb-4">

        <!-- TOTAL BUKU -->
        <div class="col-lg-3 col-md-6">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon blue">
                        <i class="bi bi-book"></i>
                    </div>

                    <i class="bi bi-three-dots text-muted"></i>

                </div>

                <p>Total Buku</p>

                <h3>1.248</h3>

                <div class="stat-footer">
                    <i class="bi bi-arrow-up"></i>
                    12% dari bulan lalu
                </div>

            </div>

        </div>


        <!-- ANGGOTA -->
        <div class="col-lg-3 col-md-6">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon green">
                        <i class="bi bi-people"></i>
                    </div>

                    <i class="bi bi-three-dots text-muted"></i>

                </div>

                <p>Total Anggota</p>

                <h3>356</h3>

                <div class="stat-footer">
                    <i class="bi bi-arrow-up"></i>
                    8% dari bulan lalu
                </div>

            </div>

        </div>


        <!-- DIPINJAM -->
        <div class="col-lg-3 col-md-6">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon orange">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>

                    <i class="bi bi-three-dots text-muted"></i>

                </div>

                <p>Sedang Dipinjam</p>

                <h3>87</h3>

                <div class="stat-footer">
                    <i class="bi bi-arrow-up"></i>
                    5% dari bulan lalu
                </div>

            </div>

        </div>


        <!-- TERLAMBAT -->
        <div class="col-lg-3 col-md-6">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-icon red">
                        <i class="bi bi-clock-history"></i>
                    </div>

                    <i class="bi bi-three-dots text-muted"></i>

                </div>

                <p>Pengembalian Terlambat</p>

                <h3>12</h3>

                <div class="stat-footer" style="color:#ef4444;">
                    <i class="bi bi-arrow-down"></i>
                    3% dari bulan lalu
                </div>

            </div>

        </div>

    </div>


    <!-- TABLE -->
    <div class="row g-4">

        <div class="col-lg-8">

            <div class="content-card">

                <div class="card-header-custom">

                    <h5>Peminjaman Terbaru</h5>

                    <a href="#" class="view-all">
                        Lihat semua
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>


                <div class="table-responsive">

                    <table class="table">

                        <thead>

                            <tr>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>
                                    <strong>Andi Saputra</strong>
                                </td>

                                <td>

                                    <div class="book-info">

                                        <div class="book-cover">
                                            <i class="bi bi-book"></i>
                                        </div>

                                        <div>
                                            <strong>Belajar Laravel</strong>
                                            <small>Programming</small>
                                        </div>

                                    </div>

                                </td>

                                <td>
                                    02 Sep 2026
                                </td>

                                <td>
                                    <span class="badge-status status-dipinjam">
                                        Dipinjam
                                    </span>
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>Siti Aisyah</strong>
                                </td>

                                <td>

                                    <div class="book-info">

                                        <div class="book-cover">
                                            <i class="bi bi-book"></i>
                                        </div>

                                        <div>
                                            <strong>Dasar Pemrograman</strong>
                                            <small>Teknologi</small>
                                        </div>

                                    </div>

                                </td>

                                <td>
                                    01 Sep 2026
                                </td>

                                <td>
                                    <span class="badge-status status-dipinjam">
                                        Dipinjam
                                    </span>
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>Budi Setiawan</strong>
                                </td>

                                <td>

                                    <div class="book-info">

                                        <div class="book-cover">
                                            <i class="bi bi-book"></i>
                                        </div>

                                        <div>
                                            <strong>Basis Data MySQL</strong>
                                            <small>Database</small>
                                        </div>

                                    </div>

                                </td>

                                <td>
                                    28 Agu 2026
                                </td>

                                <td>
                                    <span class="badge-status status-terlambat">
                                        Terlambat
                                    </span>

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>Dewi Lestari</strong>
                                </td>

                                <td>

                                    <div class="book-info">

                                        <div class="book-cover">
                                            <i class="bi bi-book"></i>
                                        </div>

                                        <div>
                                            <strong>HTML & CSS</strong>
                                            <small>Web Development</small>
                                        </div>

                                    </div>

                                </td>

                                <td>
                                    27 Agu 2026
                                </td>

                                <td>
                                    <span class="badge-status status-kembali">
                                        Dikembalikan
                                    </span>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <!-- BUKU POPULER -->
        <div class="col-lg-4">

            <div class="content-card">

                <div class="card-header-custom">

                    <h5>Buku Populer</h5>

                    <a href="#" class="view-all">
                        Lihat semua
                    </a>

                </div>


                <div class="px-3 pb-3">

                    <!-- BOOK 1 -->

                    <div class="d-flex align-items-center p-2">

                        <div class="book-cover me-3">
                            <i class="bi bi-book"></i>
                        </div>

                        <div class="flex-grow-1">

                            <strong style="font-size:13px;">
                                Belajar Laravel
                            </strong>

                            <small class="d-block text-muted">
                                32 kali dipinjam
                            </small>

                        </div>

                        <span class="badge bg-light text-primary">
                            #1
                        </span>

                    </div>


                    <!-- BOOK 2 -->

                    <div class="d-flex align-items-center p-2">

                        <div class="book-cover me-3">
                            <i class="bi bi-book"></i>
                        </div>

                        <div class="flex-grow-1">

                            <strong style="font-size:13px;">
                                Dasar Pemrograman
                            </strong>

                            <small class="d-block text-muted">
                                27 kali dipinjam
                            </small>

                        </div>

                        <span class="badge bg-light text-primary">
                            #2
                        </span>

                    </div>


                    <!-- BOOK 3 -->

                    <div class="d-flex align-items-center p-2">

                        <div class="book-cover me-3">
                            <i class="bi bi-book"></i>
                        </div>

                        <div class="flex-grow-1">

                            <strong style="font-size:13px;">
                                Basis Data MySQL
                            </strong>

                            <small class="d-block text-muted">
                                24 kali dipinjam
                            </small>

                        </div>

                        <span class="badge bg-light text-primary">
                            #3
                        </span>

                    </div>


                    <!-- BOOK 4 -->

                    <div class="d-flex align-items-center p-2">

                        <div class="book-cover me-3">
                            <i class="bi bi-book"></i>
                        </div>

                        <div class="flex-grow-1">

                            <strong style="font-size:13px;">
                                HTML & CSS
                            </strong>

                            <small class="d-block text-muted">
                                21 kali dipinjam
                            </small>

                        </div>

                        <span class="badge bg-light text-primary">
                            #4
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection