<script setup>
import { ref } from 'vue'

const stats = ref([
    {
        title: 'Total Buku',
        value: 125,
        icon: '📚'
    },
    {
        title: 'Total Anggota',
        value: 48,
        icon: '👥'
    },
    {
        title: 'Buku Dipinjam',
        value: 32,
        icon: '📖'
    },
    {
        title: 'Terlambat',
        value: 7,
        icon: '⚠️'
    }
])

const peminjaman = ref([
    {
        id: 1,
        anggota: 'Andi Saputra',
        buku: 'Pemrograman Laravel',
        tanggal: '04 September 2026',
        status: 'Dipinjam'
    },
    {
        id: 2,
        anggota: 'Budi Santoso',
        buku: 'Belajar Vue.js',
        tanggal: '03 September 2026',
        status: 'Dipinjam'
    },
    {
        id: 3,
        anggota: 'Citra Dewi',
        buku: 'Dasar-Dasar PHP',
        tanggal: '02 September 2026',
        status: 'Dikembalikan'
    },
    {
        id: 4,
        anggota: 'Deni Kurniawan',
        buku: 'Database MySQL',
        tanggal: '01 September 2026',
        status: 'Terlambat'
    }
])

const bukuTerbaru = ref([
    {
        judul: 'Pemrograman Laravel',
        kategori: 'Pemrograman',
        stok: 12
    },
    {
        judul: 'Belajar Vue.js',
        kategori: 'Web Development',
        stok: 8
    },
    {
        judul: 'Dasar-Dasar PHP',
        kategori: 'Pemrograman',
        stok: 15
    },
    {
        judul: 'Database MySQL',
        kategori: 'Database',
        stok: 6
    }
])
</script>

<template>
    <div class="dashboard">

        <!-- SIDEBAR -->
        <aside class="sidebar">

            <div class="logo">
                📚
                <span>Perpustakaan</span>
            </div>

            <nav>
                <RouterLink to="/admin" class="menu active">
                    <span>📊</span>
                    Dashboard
                </RouterLink>

                <RouterLink to="/buku" class="menu">
                    <span>📚</span>
                    Data Buku
                </RouterLink>

                <RouterLink to="/kategori" class="menu">
                    <span>📂</span>
                    Kategori
                </RouterLink>

                <RouterLink to="/anggota" class="menu">
                    <span>👥</span>
                    Anggota
                </RouterLink>

                <RouterLink to="/peminjaman" class="menu">
                    <span>📋</span>
                    Peminjaman
                </RouterLink>

                <RouterLink to="/pengembalian" class="menu">
                    <span>↩️</span>
                    Pengembalian
                </RouterLink>
            </nav>

            <div class="logout">
                🚪 Logout
            </div>

        </aside>


        <!-- MAIN -->
        <main class="main">

            <!-- NAVBAR -->
            <header class="navbar">

                <div>
                    <h2>Dashboard</h2>
                    <p>Selamat datang kembali, Admin 👋</p>
                </div>

                <div class="admin">
                    <div class="avatar">
                        A
                    </div>

                    <div>
                        <strong>Admin</strong>
                        <small>Administrator</small>
                    </div>
                </div>

            </header>


            <!-- CONTENT -->
            <section class="content">

                <div class="page-title">
                    <div>
                        <h1>Dashboard Perpustakaan</h1>
                        <p>Ringkasan aktivitas perpustakaan hari ini.</p>
                    </div>
                </div>


                <!-- STATISTICS -->
                <div class="stats">

                    <div
                        v-for="stat in stats"
                        :key="stat.title"
                        class="stat-card"
                    >
                        <div class="stat-icon">
                            {{ stat.icon }}
                        </div>

                        <div>
                            <p>{{ stat.title }}</p>
                            <h2>{{ stat.value }}</h2>
                        </div>
                    </div>

                </div>


                <!-- CONTENT GRID -->
                <div class="grid">

                    <!-- PEMINJAMAN -->
                    <div class="card large">

                        <div class="card-header">
                            <div>
                                <h3>Peminjaman Terbaru</h3>
                                <p>Aktivitas peminjaman buku terbaru</p>
                            </div>

                            <button>Lihat Semua</button>
                        </div>

                        <div class="table-wrapper">

                            <table>

                                <thead>
                                    <tr>
                                        <th>Anggota</th>
                                        <th>Buku</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr
                                        v-for="item in peminjaman"
                                        :key="item.id"
                                    >
                                        <td>{{ item.anggota }}</td>
                                        <td>{{ item.buku }}</td>
                                        <td>{{ item.tanggal }}</td>

                                        <td>
                                            <span
                                                class="status"
                                                :class="item.status.toLowerCase()"
                                            >
                                                {{ item.status }}
                                            </span>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>


                    <!-- BUKU TERBARU -->
                    <div class="card">

                        <div class="card-header">
                            <div>
                                <h3>Buku Terbaru</h3>
                                <p>Koleksi yang baru ditambahkan</p>
                            </div>
                        </div>

                        <div class="book-list">

                            <div
                                v-for="buku in bukuTerbaru"
                                :key="buku.judul"
                                class="book"
                            >

                                <div class="book-icon">
                                    📖
                                </div>

                                <div class="book-info">
                                    <strong>{{ buku.judul }}</strong>
                                    <small>{{ buku.kategori }}</small>
                                </div>

                                <span class="stock">
                                    {{ buku.stok }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </main>

    </div>
</template>


<style scoped>

* {
    box-sizing: border-box;
}

.dashboard {
    min-height: 100vh;
    display: flex;
    background: #f5f6fa;
    color: #172033;
}


/* SIDEBAR */

.sidebar {
    width: 250px;
    min-height: 100vh;
    background: #172033;
    color: white;
    padding: 25px 15px;
    display: flex;
    flex-direction: column;
}

.logo {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 19px;
    font-weight: 700;
    padding: 10px 15px 30px;
}

.logo:first-letter {
    font-size: 25px;
}

nav {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.menu {
    color: #b9c1d0;
    text-decoration: none;
    padding: 13px 15px;
    border-radius: 10px;
    display: flex;
    gap: 12px;
    align-items: center;
    font-size: 14px;
    transition: .2s;
}

.menu:hover,
.menu.active {
    background: #31558f;
    color: white;
}

.logout {
    margin-top: auto;
    padding: 14px 15px;
    color: #b9c1d0;
    cursor: pointer;
}


/* MAIN */

.main {
    flex: 1;
    min-width: 0;
}

.navbar {
    height: 82px;
    background: white;
    border-bottom: 1px solid #e8eaf0;
    padding: 0 35px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.navbar h2 {
    margin: 0;
    font-size: 20px;
}

.navbar p {
    margin: 4px 0 0;
    color: #8a92a3;
    font-size: 13px;
}

.admin {
    display: flex;
    align-items: center;
    gap: 10px;
}

.admin small {
    display: block;
    color: #8a92a3;
    font-size: 11px;
}

.avatar {
    width: 40px;
    height: 40px;
    background: #31558f;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}


/* CONTENT */

.content {
    padding: 35px;
}

.page-title h1 {
    margin: 0;
    font-size: 26px;
}

.page-title p {
    margin-top: 7px;
    color: #8a92a3;
}


/* STATS */

.stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-top: 28px;
}

.stat-card {
    background: white;
    padding: 22px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    gap: 16px;
    border: 1px solid #e8eaf0;
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 13px;
    background: #edf2fb;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.stat-card p {
    margin: 0;
    color: #8a92a3;
    font-size: 13px;
}

.stat-card h2 {
    margin: 5px 0 0;
    font-size: 25px;
}


/* GRID */

.grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    margin-top: 20px;
}

.card {
    background: white;
    border: 1px solid #e8eaf0;
    border-radius: 16px;
    padding: 22px;
    min-width: 0;
}

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.card-header h3 {
    margin: 0;
    font-size: 17px;
}

.card-header p {
    margin: 5px 0 0;
    color: #8a92a3;
    font-size: 12px;
}

.card-header button {
    border: 0;
    background: transparent;
    color: #31558f;
    cursor: pointer;
    font-size: 12px;
}


/* TABLE */

.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    text-align: left;
    font-size: 12px;
    color: #8a92a3;
    padding: 12px;
    border-bottom: 1px solid #eee;
}

td {
    padding: 15px 12px;
    font-size: 13px;
    border-bottom: 1px solid #f0f1f4;
}

.status {
    padding: 5px 9px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}

.status.dipinjam {
    background: #edf2fb;
    color: #31558f;
}

.status.dikembalikan {
    background: #eaf8ef;
    color: #27834b;
}

.status.terlambat {
    background: #fff0f0;
    color: #d13b3b;
}


/* BOOK */

.book-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.book {
    display: flex;
    align-items: center;
    gap: 12px;
}

.book-icon {
    width: 40px;
    height: 48px;
    background: #edf2fb;
    border-radius: 7px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.book-info {
    flex: 1;
}

.book-info strong {
    display: block;
    font-size: 13px;
}

.book-info small {
    color: #8a92a3;
    font-size: 11px;
}

.stock {
    background: #f0f2f6;
    padding: 5px 9px;
    border-radius: 6px;
    font-size: 11px;
}


/* RESPONSIVE */

@media (max-width: 1000px) {

    .stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .grid {
        grid-template-columns: 1fr;
    }

}

@media (max-width: 700px) {

    .sidebar {
        width: 70px;
    }

    .logo span,
    .menu:not(.active)::after,
    .menu {
        font-size: 0;
    }

    .menu span {
        font-size: 20px;
    }

    .content {
        padding: 20px;
    }

    .stats {
        grid-template-columns: 1fr;
    }

}

</style>