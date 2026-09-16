<script setup>  

</script>


<template>
  <div class="dashboard">

    <!-- SIDEBAR -->
    <aside class="sidebar">
      <div class="sidebar-brand">
        <div class="brand-icon">📚</div>
        <div>
          <strong>PerpusKu</strong>
          <span>ADMIN PANEL</span>
        </div>
      </div>

      <nav class="sidebar-menu">
        <p class="menu-title">MENU UTAMA</p>

        <router-link to="/admin/Dashboard" class="menu-item active">
          <span class="menu-icon">▦</span>
          <span>Dashboard</span>
        </router-link>

        <router-link to="/admin/buku" class="menu-item">
          <span class="menu-icon">📚</span>
          <span>Data Buku</span>
        </router-link>

        <a href="#" class="menu-item" @click.prevent>
          <span class="menu-icon">👥</span>
          <span>Anggota</span>
        </a>

        <a href="#" class="menu-item" @click.prevent>
          <span class="menu-icon">📋</span>
          <span>Peminjaman</span>
        </a>

        <router-link to="/admin/kategori" class="menu-item">
          <span class="menu-icon">🏷️</span>
          <span>Kategori</span>
        </router-link>
      </nav>

      <div class="sidebar-bottom">
        <button class="library-btn" @click="goToLibrary">
          <span>↗</span>
          Tampilan Perpus
        </button>

        <button class="logout-btn" @click="logout">
          <span>⇥</span>
          Logout
        </button>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="main-content">

      <!-- TOPBAR -->
      <header class="topbar">
        <div>
          <p class="welcome">SELAMAT DATANG KEMBALI 👋</p>
          <h1>Dashboard Admin</h1>
          <p class="subtitle">
            Kelola dan pantau sistem perpustakaan dengan mudah.
          </p>
        </div>

        <div class="topbar-right">

          <button class="library-view-btn" @click="goToLibrary">
            <span>↗</span>
            Lihat Perpus
          </button>

          <div class="admin-profile">
            <div class="admin-avatar">
              {{ adminInitial }}
            </div>

            <div class="admin-info">
              <strong>{{ adminName }}</strong>
              <span>Administrator</span>
            </div>
          </div>

        </div>
      </header>

      <!-- STATS -->
      <section class="stats-grid">

        <div class="stat-card">
          <div class="stat-icon blue">📚</div>

          <div>
            <span>Total Buku</span>
            <h2>1,248</h2>
            <small>+12 bulan ini</small>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon green">👥</div>

          <div>
            <span>Total Anggota</span>
            <h2>856</h2>
            <small>+24 bulan ini</small>
          </div>
        </div>

        <!-- TOTAL KATEGORI DARI DATABASE -->
        <div class="stat-card">
          <div class="stat-icon purple">🏷️</div>

          <div>
            <span>Total Kategori</span>

            <h2 v-if="loadingKategori">
              ...
            </h2>

            <h2 v-else>
              {{ totalKategori }}
            </h2>

            <small>Data dari database</small>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon orange">📖</div>

          <div>
            <span>Sedang Dipinjam</span>
            <h2>127</h2>
            <small>Perlu dikembalikan</small>
          </div>
        </div>

      </section>

      <!-- CONTENT GRID -->
      <section class="content-grid">

        <!-- AKTIVITAS -->
        <div class="panel activity-panel">

          <div class="panel-header">
            <div>
              <span class="panel-label">AKTIVITAS</span>
              <h2>Aktivitas Terbaru</h2>
            </div>

            <button class="see-all">
              Lihat Semua →
            </button>
          </div>

          <div class="activity-list">

            <div class="activity-item">
              <div class="activity-avatar blue-avatar">
                AR
              </div>

              <div class="activity-info">
                <strong>Andi Ramadhan</strong>
                <span>Meminjam buku "Modern JavaScript"</span>
              </div>

              <time>5 menit lalu</time>
            </div>

            <div class="activity-item">
              <div class="activity-avatar purple-avatar">
                SP
              </div>

              <div class="activity-info">
                <strong>Siti Putri</strong>
                <span>Mengembalikan buku "Database Mastery"</span>
              </div>

              <time>20 menit lalu</time>
            </div>

            <div class="activity-item">
              <div class="activity-avatar green-avatar">
                BS
              </div>

              <div class="activity-info">
                <strong>Budi Santoso</strong>
                <span>Meminjam buku "Belajar Vue.js"</span>
              </div>

              <time>1 jam lalu</time>
            </div>

            <div class="activity-item">
              <div class="activity-avatar orange-avatar">
                FN
              </div>

              <div class="activity-info">
                <strong>Fajar Nugroho</strong>
                <span>Terdaftar sebagai anggota baru</span>
              </div>

              <time>2 jam lalu</time>
            </div>

          </div>
        </div>

        <!-- BUKU POPULER -->
        <div class="panel popular-panel">

          <div class="panel-header">
            <div>
              <span class="panel-label">KOLEKSI</span>
              <h2>Buku Populer</h2>
            </div>
          </div>

          <div class="popular-list">

            <div class="popular-item">
              <div class="book-cover cover-blue">
                JS
              </div>

              <div class="book-info">
                <strong>Modern JavaScript</strong>
                <span>Andi Pratama</span>
              </div>

              <div class="book-count">
                <strong>128</strong>
                <span>dipinjam</span>
              </div>
            </div>

            <div class="popular-item">
              <div class="book-cover cover-purple">
                VJ
              </div>

              <div class="book-info">
                <strong>Belajar Vue.js</strong>
                <span>Dimas Saputra</span>
              </div>

              <div class="book-count">
                <strong>96</strong>
                <span>dipinjam</span>
              </div>
            </div>

            <div class="popular-item">
              <div class="book-cover cover-green">
                DB
              </div>

              <div class="book-info">
                <strong>Database Mastery</strong>
                <span>Budi Santoso</span>
              </div>

              <div class="book-count">
                <strong>84</strong>
                <span>dipinjam</span>
              </div>
            </div>

            <div class="popular-item">
              <div class="book-cover cover-orange">
                LP
              </div>

              <div class="book-info">
                <strong>Laravel From Zero</strong>
                <span>Muhammad Rizky</span>
              </div>

              <div class="book-count">
                <strong>71</strong>
                <span>dipinjam</span>
              </div>
            </div>

          </div>
        </div>

      </section>

      <!-- QUICK ACTION -->
      <section class="quick-section">

        <div class="section-title">
          <div>
            <span class="panel-label">AKSES CEPAT</span>
            <h2>Aksi Cepat</h2>
          </div>
        </div>

        <div class="quick-grid">

          <router-link to="/admin/buku" class="quick-card">
            <div class="quick-icon blue">＋</div>
            <div>
              <strong>Tambah Buku</strong>
              <span>Tambahkan koleksi buku baru</span>
            </div>
            <b>→</b>
          </router-link>

          <div class="quick-card">
            <div class="quick-icon purple">👥</div>
            <div>
              <strong>Kelola Anggota</strong>
              <span>Lihat data anggota perpustakaan</span>
            </div>
            <b>→</b>
          </div>

          <div class="quick-card">
            <div class="quick-icon green">📋</div>
            <div>
              <strong>Data Peminjaman</strong>
              <span>Kelola transaksi peminjaman</span>
            </div>
            <b>→</b>
          </div>

        </div>
      </section>

    </main>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '../../utils/api'

const router = useRouter()

// ==============================
// DATA ADMIN
// ==============================

const user = ref(
  JSON.parse(localStorage.getItem('user') || '{}')
)

const adminName = computed(() => {
  return user.value?.name || 'Administrator'
})

const adminInitial = computed(() => {
  return adminName.value.charAt(0).toUpperCase()
})

// ==============================
// TOTAL KATEGORI
// ==============================

const totalKategori = ref(0)
const loadingKategori = ref(true)

async function getTotalKategori() {
  try {
    loadingKategori.value = true

    const response = await api.get('/kategori')

    /*
      Backend:
      {
        message: "...",
        data: [...]
      }
    */

    const data = response.data?.data

    if (Array.isArray(data)) {
      totalKategori.value = data.length
    } else {
      totalKategori.value = 0
    }

  } catch (error) {
    console.error('Gagal mengambil data kategori:', error)

    totalKategori.value = 0

  } finally {
    loadingKategori.value = false
  }
}

// ==============================
// KE HALAMAN PERPUSTAKAAN
// ==============================

function goToLibrary() {
  router.push('/')
}

// ==============================
// LOGOUT
// ==============================

async function logout() {
  try {
    await api.post('/logout')
  } catch (error) {
    console.error('Logout API gagal:', error)
  }

  localStorage.removeItem('token')
  localStorage.removeItem('user')

  router.push('/login')
}

// ==============================
// LOAD DATA
// ==============================

onMounted(() => {
  getTotalKategori()
})
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.dashboard {
  min-height: 100vh;
  background:
    radial-gradient(
      circle at 80% 10%,
      rgba(59, 130, 246, 0.12),
      transparent 28%
    ),
    radial-gradient(
      circle at 20% 90%,
      rgba(139, 92, 246, 0.08),
      transparent 28%
    ),
    #080d18;

  color: #f8fafc;
  display: flex;
  font-family:
    Inter,
    ui-sans-serif,
    system-ui,
    -apple-system,
    BlinkMacSystemFont,
    "Segoe UI",
    sans-serif;
}

/* =========================
   SIDEBAR
========================= */

.sidebar {
  width: 230px;
  min-width: 230px;
  min-height: 100vh;

  padding: 22px 14px;

  background: rgba(10, 16, 29, 0.94);
  border-right: 1px solid rgba(255, 255, 255, 0.07);

  display: flex;
  flex-direction: column;

  position: sticky;
  top: 0;
  height: 100vh;
}

.sidebar-brand {
  display: flex;
  align-items: center;
  gap: 11px;

  padding: 6px 10px 25px;
}

.brand-icon {
  width: 40px;
  height: 40px;

  border-radius: 12px;

  display: flex;
  align-items: center;
  justify-content: center;

  background: linear-gradient(
    135deg,
    #2563eb,
    #7c3aed
  );

  font-size: 20px;

  box-shadow:
    0 8px 22px rgba(37, 99, 235, 0.25);
}

.sidebar-brand strong {
  display: block;
  font-size: 17px;
  letter-spacing: -0.4px;
}

.sidebar-brand span {
  display: block;
  margin-top: 2px;

  font-size: 8px;
  font-weight: 800;
  letter-spacing: 1.5px;

  color: #64748b;
}

.menu-title {
  margin: 4px 10px 9px;

  font-size: 9px;
  font-weight: 800;
  letter-spacing: 1.5px;

  color: #475569;
}

.sidebar-menu {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.menu-item {
  height: 43px;

  padding: 0 12px;

  display: flex;
  align-items: center;
  gap: 12px;

  color: #8190a7;
  text-decoration: none;

  border-radius: 11px;

  font-size: 13px;
  font-weight: 600;

  transition: 0.2s ease;
}

.menu-item:hover {
  color: #fff;
  background: rgba(255, 255, 255, 0.045);
}

.menu-item.active {
  color: #fff;

  background:
    linear-gradient(
      135deg,
      rgba(37, 99, 235, 0.24),
      rgba(124, 58, 237, 0.14)
    );

  border: 1px solid rgba(96, 165, 250, 0.1);
}

.menu-icon {
  width: 22px;
  text-align: center;
  font-size: 15px;
}

.sidebar-bottom {
  margin-top: auto;

  display: flex;
  flex-direction: column;
  gap: 7px;
}

.library-btn,
.logout-btn {
  width: 100%;
  height: 40px;

  border-radius: 10px;

  background: transparent;

  border: 1px solid rgba(255, 255, 255, 0.07);

  color: #94a3b8;

  cursor: pointer;

  font-size: 12px;
  font-weight: 700;

  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;

  transition: 0.2s ease;
}

.library-btn:hover {
  background: rgba(59, 130, 246, 0.1);
  color: #93c5fd;
  border-color: rgba(59, 130, 246, 0.25);
}

.logout-btn:hover {
  background: rgba(239, 68, 68, 0.08);
  color: #fca5a5;
  border-color: rgba(239, 68, 68, 0.2);
}

/* =========================
   MAIN
========================= */

.main-content {
  flex: 1;
  min-width: 0;

  padding: 28px 32px 45px;
}

.topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;

  margin-bottom: 27px;
}

.welcome {
  margin: 0 0 5px;

  color: #64748b;

  font-size: 9px;
  font-weight: 800;

  letter-spacing: 1.7px;
}

.topbar h1 {
  margin: 0;

  font-size: 27px;
  line-height: 1.2;

  letter-spacing: -1px;
}

.subtitle {
  margin: 6px 0 0;

  color: #64748b;

  font-size: 12px;
}

.topbar-right {
  display: flex;
  align-items: center;
  gap: 18px;
}

.library-view-btn {
  padding: 10px 14px;

  border-radius: 10px;

  border: 1px solid rgba(96, 165, 250, 0.18);

  background: rgba(59, 130, 246, 0.08);

  color: #93c5fd;

  font-size: 11px;
  font-weight: 700;

  cursor: pointer;

  transition: 0.2s ease;
}

.library-view-btn:hover {
  background: rgba(59, 130, 246, 0.15);
}

.admin-profile {
  display: flex;
  align-items: center;
  gap: 9px;
}

.admin-avatar {
  width: 37px;
  height: 37px;

  border-radius: 50%;

  display: flex;
  align-items: center;
  justify-content: center;

  background:
    linear-gradient(
      135deg,
      #2563eb,
      #7c3aed
    );

  font-weight: 800;
  font-size: 13px;
}

.admin-info strong {
  display: block;

  font-size: 11px;
}

.admin-info span {
  display: block;

  margin-top: 2px;

  color: #64748b;

  font-size: 9px;
}

/* =========================
   STATS
========================= */

.stats-grid {
  display: grid;

  grid-template-columns:
    repeat(4, minmax(0, 1fr));

  gap: 14px;

  margin-bottom: 18px;
}

.stat-card {
  min-height: 112px;

  padding: 18px;

  border-radius: 15px;

  background: rgba(17, 25, 40, 0.72);

  border: 1px solid rgba(255, 255, 255, 0.06);

  display: flex;
  align-items: center;
  gap: 14px;

  transition: 0.2s ease;
}

.stat-card:hover {
  transform: translateY(-2px);

  border-color: rgba(255, 255, 255, 0.1);

  background: rgba(20, 29, 46, 0.8);
}

.stat-icon {
  width: 45px;
  height: 45px;

  flex-shrink: 0;

  border-radius: 12px;

  display: flex;
  align-items: center;
  justify-content: center;

  font-size: 18px;
}

.stat-icon.blue {
  background: rgba(59, 130, 246, 0.13);
}

.stat-icon.green {
  background: rgba(34, 197, 94, 0.12);
}

.stat-icon.purple {
  background: rgba(168, 85, 247, 0.13);
}

.stat-icon.orange {
  background: rgba(249, 115, 22, 0.12);
}

.stat-card span {
  display: block;

  color: #718096;

  font-size: 10px;
  font-weight: 600;
}

.stat-card h2 {
  margin: 3px 0 2px;

  font-size: 24px;

  letter-spacing: -0.7px;
}

.stat-card small {
  color: #475569;

  font-size: 9px;
}

/* =========================
   PANELS
========================= */

.content-grid {
  display: grid;

  grid-template-columns:
    minmax(0, 1.35fr)
    minmax(300px, 1fr);

  gap: 17px;

  margin-bottom: 20px;
}

.panel {
  padding: 20px;

  border-radius: 16px;

  background: rgba(14, 22, 36, 0.78);

  border: 1px solid rgba(255, 255, 255, 0.055);
}

.panel-header {
  display: flex;
  justify-content: space-between;
  align-items: center;

  margin-bottom: 16px;
}

.panel-label {
  display: block;

  margin-bottom: 4px;

  color: #475569;

  font-size: 8px;
  font-weight: 800;

  letter-spacing: 1.5px;
}

.panel h2 {
  margin: 0;

  font-size: 16px;
  letter-spacing: -0.3px;
}

.see-all {
  border: none;
  background: transparent;

  color: #60a5fa;

  font-size: 10px;
  font-weight: 700;

  cursor: pointer;
}

/* =========================
   ACTIVITY
========================= */

.activity-list {
  display: flex;
  flex-direction: column;
}

.activity-item {
  display: flex;
  align-items: center;

  gap: 11px;

  padding: 11px 0;

  border-bottom:
    1px solid rgba(255, 255, 255, 0.045);
}

.activity-item:last-child {
  border-bottom: none;
}

.activity-avatar {
  width: 34px;
  height: 34px;

  border-radius: 10px;

  display: flex;
  align-items: center;
  justify-content: center;

  font-size: 9px;
  font-weight: 800;
}

.blue-avatar {
  background: rgba(59, 130, 246, 0.13);
  color: #60a5fa;
}

.purple-avatar {
  background: rgba(168, 85, 247, 0.13);
  color: #c084fc;
}

.green-avatar {
  background: rgba(34, 197, 94, 0.12);
  color: #4ade80;
}

.orange-avatar {
  background: rgba(249, 115, 22, 0.12);
  color: #fb923c;
}

.activity-info {
  flex: 1;
  min-width: 0;
}

.activity-info strong {
  display: block;

  font-size: 11px;
}

.activity-info span {
  display: block;

  margin-top: 3px;

  color: #64748b;

  font-size: 9px;

  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.activity-item time {
  color: #475569;

  font-size: 8px;

  white-space: nowrap;
}

/* =========================
   POPULAR
========================= */

.popular-list {
  display: flex;
  flex-direction: column;
}

.popular-item {
  display: flex;
  align-items: center;

  gap: 11px;

  padding: 9px 0;

  border-bottom:
    1px solid rgba(255, 255, 255, 0.045);
}

.popular-item:last-child {
  border-bottom: none;
}

.book-cover {
  width: 37px;
  height: 47px;

  border-radius: 6px;

  display: flex;
  align-items: center;
  justify-content: center;

  font-size: 9px;
  font-weight: 900;

  color: white;
}

.cover-blue {
  background: linear-gradient(
    145deg,
    #2563eb,
    #172554
  );
}

.cover-purple {
  background: linear-gradient(
    145deg,
    #7c3aed,
    #3b0764
  );
}

.cover-green {
  background: linear-gradient(
    145deg,
    #16a34a,
    #14532d
  );
}

.cover-orange {
  background: linear-gradient(
    145deg,
    #ea580c,
    #431407
  );
}

.book-info {
  flex: 1;
}

.book-info strong {
  display: block;

  font-size: 10px;
}

.book-info span {
  display: block;

  margin-top: 3px;

  color: #64748b;

  font-size: 8px;
}

.book-count {
  text-align: right;
}

.book-count strong {
  display: block;

  font-size: 11px;
}

.book-count span {
  color: #475569;

  font-size: 8px;
}

/* =========================
   QUICK ACTION
========================= */

.quick-section {
  margin-top: 3px;
}

.section-title {
  margin-bottom: 12px;
}

.quick-grid {
  display: grid;

  grid-template-columns:
    repeat(3, minmax(0, 1fr));

  gap: 13px;
}

.quick-card {
  min-height: 75px;

  padding: 13px;

  border-radius: 13px;

  background: rgba(14, 22, 36, 0.7);

  border: 1px solid rgba(255, 255, 255, 0.055);

  text-decoration: none;

  color: white;

  display: flex;
  align-items: center;

  gap: 11px;

  transition: 0.2s ease;
}

.quick-card:hover {
  transform: translateY(-2px);

  background: rgba(20, 30, 47, 0.85);

  border-color: rgba(96, 165, 250, 0.12);
}

.quick-icon {
  width: 38px;
  height: 38px;

  border-radius: 10px;

  display: flex;
  align-items: center;
  justify-content: center;

  font-size: 15px;
}

.quick-icon.blue {
  background: rgba(59, 130, 246, 0.12);
}

.quick-icon.purple {
  background: rgba(168, 85, 247, 0.12);
}

.quick-icon.green {
  background: rgba(34, 197, 94, 0.12);
}

.quick-card > div:nth-child(2) {
  flex: 1;
}

.quick-card strong {
  display: block;

  font-size: 10px;
}

.quick-card span {
  display: block;

  margin-top: 3px;

  color: #64748b;

  font-size: 8px;
}

.quick-card b {
  color: #475569;

  font-size: 14px;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 1100px) {
  .stats-grid {
    grid-template-columns:
      repeat(2, minmax(0, 1fr));
  }

  .content-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 850px) {
  .sidebar {
    width: 190px;
    min-width: 190px;
  }

  .main-content {
    padding: 22px;
  }

  .topbar-right {
    gap: 10px;
  }

  .admin-info {
    display: none;
  }

  .quick-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 650px) {
  .dashboard {
    display: block;
  }

  .sidebar {
    width: 100%;
    min-width: 0;
    height: auto;
    min-height: auto;

    position: relative;

    border-right: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.07);
  }

  .sidebar-brand {
    padding-bottom: 15px;
  }

  .sidebar-menu {
    flex-direction: row;
    overflow-x: auto;
  }

  .menu-title {
    display: none;
  }

  .menu-item {
    min-width: max-content;
  }

  .sidebar-bottom {
    display: none;
  }

  .main-content {
    padding: 20px 15px;
  }

  .topbar {
    align-items: flex-start;
  }

  .topbar h1 {
    font-size: 22px;
  }

  .library-view-btn {
    display: none;
  }

  .stats-grid {
    grid-template-columns: 1fr;
  }
}
</style>